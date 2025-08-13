<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Payment;
use App\Helper\Upload;
use Validator;
use MailHelper;
use LiveCart;
use ModelHelper;
use Helper;
use PDF;

class BookingRequestController extends Controller{
    
    public function __construct(BookingRequest $model){
        $this->model=$model;
        $this->admin_base_url="booking-enquiries.index";
        $this->admin_view="admin.booking-enquiries";
    }
    
    public function getCheckinCheckoutDataGaurav(Request $request){
        //dd($request->all());
        $new_data_blocked=LiveCart::iCalDataCheckInCheckOut($request->id);
        $checkin=$new_data_blocked['checkin'];
        $checkout=$new_data_blocked['checkout'];
        //dd($new_data_blocked);
        return response()->json($new_data_blocked);
    }

    public function index(){
        $data=$this->model::where("status_data","active")->orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }

    public function indexDeactive(){
        $data=$this->model::where("status_data","deactive")->orderBy("id","desc")->get();
        return view($this->admin_view.".indexDeactive",compact("data"));
    }

    public function create(){
        return view($this->admin_view.".create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), []);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $data=$request->all();
        if ($request->hasFile("image")) {
            $data['image'] = Upload::fileUpload($request->file("image"),"booking-enquiries");
        }
        if ($request->hasFile("bannerImage")) {
            $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"booking-enquiries");
        }
        if($request->product_name){
            $ar=[];
            foreach($request->product_name as $key=>$value){
                $ar[]=[
                    "product_name"=>$request->product_name[$key],
                    "product_amount"=>$request->product_amount[$key]
                ];
            }
            $data['custom_before_total_fees']=json_encode($ar);
        }else{
            $data['custom_before_total_fees']=json_encode([]);
        }
        if($request->booking_type_admin){
            if($request->booking_type_admin=="manual"){
                $data['booking_status']="booking-confirmed";
                $data['after_total_fees']=json_encode([]);
                $data['before_total_fees']=json_encode([]);
            }
            if($request->booking_type_admin=="custom-quote"){
                $data['after_total_fees']=json_encode([]);
                $data['before_total_fees']=json_encode([]);
                if($request->custom_amount){
                    $data['amount_data']='[{"amount":'.$request->custom_amount.',"type":"first","message":"Total Amount to be Paid"}]';
                    $data['total_payment']=1;
                    $data['gross_amount']=$request->custom_amount;
                    $data['sub_amount']=$request->custom_amount;
                    $data['total_amount']=$request->custom_amount;
                    $data['after_discount_total']=$request->custom_amount;
                    $data['tax']='';
                    $data['request_id']=uniqid();
                    $data['define_tax']='';
                    $data['total_guests']=$request->adults + $request->child;
                    $data['total_night']=Helper::calculateDays($request->checkin,$request->checkout);
                    $data['accessories_rate_ids']=json_encode([]);
                    $data['mileage_rate_ids']=json_encode([]);
                    $data['option_rate_ids']=json_encode([]);
                }else{
                    return redirect()->back()->withInput()->with("danger","Must we enter custom amount");
                }
            }
        }
        
        $data=$this->model::create($data);
        if($request->booking_type_admin){
            if($request->booking_type_admin=="manual"){
                LiveCart::getFileIcalFileData($data->property_id);
                return redirect()->route($this->admin_base_url)->with("success","Successfully Added");
            }
        }
        return redirect()->route('booking-enquiry-confirm',$data->id)->with("success","Successfully Added");
    }
  
    public function show($id){
        return redirect()->route($this->admin_base_url);
    }

    public function edit($id){
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data"));
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), []);   
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
            if ($request->hasFile("image")) {
                $data['image'] = Upload::fileUpload($request->file("image"),"booking-enquiries");
            }
            if ($request->hasFile("bannerImage")) {
                $data['bannerImage'] = Upload::fileUpload($request->file("bannerImage"),"booking-enquiries");
            }
            if($request->product_name){
                $ar=[];
                foreach($request->product_name as $key=>$value){
                    $ar[]=[
                        "product_name"=>$request->product_name[$key],
                        "product_amount"=>$request->product_amount[$key]
                    ];
                }
                $data['custom_before_total_fees']=json_encode($ar);
            }else{
                $data['custom_before_total_fees']=json_encode([]);
            }
         // dd($data);
            if($request->booking_type_admin){
                if($request->booking_type_admin=="custom-quote"){
                    $data['after_total_fees']=json_encode([]);
                    $data['before_total_fees']=json_encode([]);
                    if($request->custom_amount){
                        $data['amount_data']='[{"amount":'.$request->custom_amount.',"type":"first","message":"Total Amount to be Paid"}]';
                        $data['total_payment']=1;
                        $data['gross_amount']=$request->custom_amount;
                        $data['sub_amount']=$request->custom_amount;
                        $data['total_amount']=$request->custom_amount;
                        $data['after_discount_total']=$request->custom_amount;
                        $data['tax']='';
                        $data['define_tax']='';
                        $data['total_guests']=$request->adults + $request->child;
                        $data['total_night']=Helper::calculateDays($request->checkin,$request->checkout);
                        $data['accessories_rate_ids']=json_encode([]);
                        $data['mileage_rate_ids']=json_encode([]);
                        $data['option_rate_ids']=json_encode([]);
                    }else{
                        return redirect()->back()->withInput()->with("danger","Must we enter custom amount");
                    }
                }
            }
            $this->model::find($id)->update($data);
            $data=BookingRequest::find($id)->toArray();
            $property=Property::find($exist->property_id);
            //dd($property);
            $exist=$this->model::find($id);
            if($property){
                $html=view("mail.booking-confirmation-user-email",compact("data","property"))->render();
                $to=$exist->email;
                $customer_subject="Payment Request for ".$property->name;
               ( MailHelper::emailSenderByController($html,$to,$customer_subject));
            }
            return redirect()->route($this->admin_base_url)->with("success","Successfully Updated");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
    
    public function activePayment($id){
        $data=$this->model::find($id);
        if($data){
            $data->status_data="active";
            $data->save();
            return redirect()->back()->with("success","active successful");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function deactivePayment($id){
        $data=$this->model::find($id);
        if($data){
            $data->status_data="deactive";
            $data->save();
            return redirect()->back()->with("success","Deactive successful");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function destroy($id){
        $exist=$this->model::find($id);
        if($exist){
            $exist->booking_status='booking-cancel';
            $exist->save();
            $data=BookingRequest::find($id)->toArray();
            if($data){
                if($data['booking_type_admin']=="invoice"){
                    $property=Property::find($data['property_id']);
                    if($property){
                        LiveCart::getFileIcalFileData($data['property_id']);
                        $html= view("mail.booking-cancel-admin-email",compact("data","property"))->render();
                        $to=ModelHelper::getDataFromSetting('cancel_receiving_mail');
                        $admin_subject="Booking Cancelled for ".$property->name;
                        MailHelper::emailSenderByController($html,$to,$admin_subject);
                        $html= view("mail.booking-cancel-user-email",compact("data","property"))->render();
                        $to=$data['email'];
                        $user_subject="Booking Cancelled for ".$property->name;
                        MailHelper::emailSenderByController($html,$to,$user_subject);
                    }
                }
                LiveCart::getFileIcalFileData($data['property_id']);
            }
            return redirect()->route($this->admin_base_url)->with("success","Successfully Deleted");
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    public function confirmed($id,Request $request){
        $exist=$this->model::find($id);
        if($exist){
            $property=Property::find($exist->property_id);
            if($property){
                $data=$exist->toArray();
                $html=view("mail.booking-confirmation-user-email",compact("data","property"))->render();
                $to=$exist->email;
                $customer_subject="Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$customer_subject);
                if($exist->booking_status!="booking-confirmed")
                $exist->booking_status='rental-aggrement';
                $exist->sent_date=date('Y-m-d H:i:s');
                $exist->sent_ip=$request->ip();
                $exist->save();
                return redirect()->route($this->admin_base_url)->with("success","Successfully send");
            }
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
  
    public function adminEmail($id){
       
        $data=$this->model::find($id);
        
        $property = Property::find($data->property_id);
        $payment = Payment::where('booking_id', $id)->first();
        if (!$payment) {
            $payment = new \stdClass(); // Create a dummy object
            $payment->amount = $data->total_amount;
            $payment->type = '';
            $payment->tran_id = '';
            $payment->balance_transaction = '';
            $payment->receipt_url = '';
        }
        //dd($payment);
         
      
        $pdf_name='invoice-'.$id.'.pdf';
        if($data){
            $file_path='uploads/files/pdf/'.$pdf_name;
            $view= view("mail.rental-pdf",compact("data","pdf_name"))->render();
            $pdf = PDF::loadHTML($view);
            $pdf->save($file_path);
        }
        $html= view("mail.booking-first-admin",compact("property","data","payment"))->render();
        $to=ModelHelper::getDataFromSetting('payment_receiving_mail');
        //$to = 'developerwebdesignvr@gmail.com';
        $admin_subject="Booking Confirmation  for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject,['uploads/files/pdf/'.$pdf_name]);

        $html= view("mail.booking-first-customer",compact("property","data","payment"))->render();
        $to=$data->email;
        //$to = 'developerwebdesignvr@gmail.com';
        $admin_subject="Booking Confirmation for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject,['uploads/files/pdf/'.$pdf_name]);

        dd('Confirmation Email Sent Successfully');
    }  
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
}