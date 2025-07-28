<?php 
namespace App\Helper;
use App\Models\BasicSetting;
use DB;
use Auth;
use Mail;
use App\Models\EmailTemplete;
use App\Models\User;
use MailHelper;
use Session;
use LiveCart;
use Helper;
use App\Models\PropertyGallery;
use App\Models\Blogs\BlogCategory;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyRate;
use App\Models\BookingRequest;
use PDF;
use App\Models\Cms;
use App\Models\Country;
use App\Models\State;

class ModelHelper{
    
    public function countryDataSelect(){
        $data=[];
        $all=Country::all();
        foreach($all as $a){
            $data[$a->id]=$a->name." - ".$a->iso3;
        }
        return $data;
    }
    
    public function stateDateSelect($id){
        $data='<option value="">Choose State</option>';
        $all=State::where(["country_id"=>$id])->orderBy("name","asc")->get();
        foreach($all as $a){
            $data.='<option value="'.$a->id.'">'.$a->name." - ".$a->iso2.'</option>';
        }
        return $data;
    }
   
    public function finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property){
        $new_amount_data=[];
        $status_payment='partially';
        if($booking->amount_data){
            $amount_data=json_decode($booking->amount_data,true);
            if(is_array($amount_data)){
                $update=0;
                foreach($amount_data as $c){
                    $ar=$c;
                    if(isset($c['status'])){}else{
                        if((double)trim($c['amount'])==(double)$payment->amount){
                            if($update==0){
                                $ar['status']="complete";
                                $ar['tran_id']=$payment->tran_id;
                                $ar['mode']=$payment->type;
                                $ar['date']=date('Y-m-d H:m:i');
                                $update=1;
                            }
                        }
                    }
                    $new_amount_data[]=$ar;
                }
            }
        }
        $i=0;$j=0;
        foreach($new_amount_data as $c){
            if(isset($c['status'])){
                $i++;
            }
            $j++;
        }
        if($i==$j){
            $status_payment='paid';
        }
        LiveCart::getFileIcalFileData($property->id);  
        BookingRequest::find($id)->update(["booking_status"=>"booking-confirmed","payment_status"=>$status_payment,"amount_data"=>$new_amount_data,"how_many_payment_done"=>$i]);
        LiveCart::getFileIcalFileData($property->id);
        $data=BookingRequest::Find($id);
        $data=BookingRequest::find($id);
        $pdf_name='invoice-'.$id.'.pdf';
        if($data){
            $file_path='uploads/files/pdf/'.$pdf_name;
            $view= view("mail.rental-pdf",compact("data","pdf_name"))->render();
            $pdf = PDF::loadHTML($view);
            $pdf->save($file_path);
        }
        $html= view("mail.booking-first-admin",compact("property","data","payment"))->render();
        $to=ModelHelper::getDataFromSetting('payment_receiving_mail');
        $admin_subject="Booking Confirmation  for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject,['uploads/files/pdf/'.$pdf_name]);
        $html= view("mail.booking-first-customer",compact("property","data","payment"))->render();
        $to=$data->email;
        $admin_subject="Booking Confirmation for ".$property->name;
        MailHelper::emailSenderByController($html,$to,$admin_subject,['uploads/files/pdf/'.$pdf_name]);
    }
    
    public function getImageByProduct($product_id){
        return PropertyGallery::where("property_id",$product_id)->orderBy("sorting","asc")->get();
    }

    public function getBlogCategoriesSelect(){
        $data=[];
        $all=BlogCategory::all();
        foreach($all as $a){
            $data[$a->id]=$a->title;
        }
        return $data;
    }

    public function saveSIngleDatePropertyRate($request,$id='default'){
        PropertyRate::where("rate_group_id",$id)->delete();
        if($request->start_date){
            $now = strtotime($request->start_date); // or your date as well
            $your_date = strtotime($request->end_date);
            $datediff =  $your_date-$now;
            $day= ceil($datediff / (60 * 60 * 24));
            for($i=0;$i<=$day;$i++){
                $data=$request->only(["discount_weekly","discount_monthly","is_available","platform_type","currency","base_price","notes","min_stay","base_min_stay",'property_id','checkin_day','checkout_day']);
                $data['rate_group_id']=$id;
                $date = strtotime($request->start_date);
                $date = strtotime("+".$i." day", $date);
                $date= date('Y-m-d', $date);
                $data['single_date_timestamp']=strtotime($date);
                $data["single_date"]=$date;
                if($request->type_of_price=="default"){
                    $data['price']=$request->price;
                }else{
                    $newDay = date('l', strtotime($date));
                    if($newDay=="Monday"){
                        $data['price']=$request->monday_price;
                    }else if($newDay=="Tuesday"){
                        $data['price']=$request->tuesday_price;
                    }else if($newDay=="Wednesday"){
                        $data['price']=$request->wednesday_price;
                    }else if($newDay=="Thursday"){
                        $data['price']=$request->thrusday_price;
                    }else if($newDay=="Friday"){
                        $data['price']=$request->friday_price;
                    }else if($newDay=="Saturday"){
                        $data['price']=$request->saturday_price;
                    }else if($newDay=="Sunday"){
                        $data['price']=$request->sunday_price;
                    }
                }
                PropertyRate::create($data);
            }
        }
    }
    
    public function showPetFee($pet_fee){
        if($pet_fee){
            if($pet_fee>0){
                return "display:block;";
            }
        }
        return "display:none;";
    }

    public function getProperptySelectList(){
        $data=[];
        $all=Property::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }
    
    public function getLocationSelectList(){
        $data=[];
        $all=Location::orderBy("ordering","asc")->get();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }
    
    public function getPageSelectList(){
        $data=[];
        $all=Cms::all();
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }

    public function getProppertySelectList(){
        $data=[];
        $all=Property::all();
        $data['ALL']='All Vehicle';
        foreach($all as $a){
            $data[$a->id]=$a->name;
        }
        return $data;
    }
	
	public function getDataFromSetting($name){
		$result=null;
		$data=BasicSetting::where("name",$name)->first();
		if($data){
			$result=$data->value;
		}
		return $result;
	}
}