<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Payment;

use Session;
use ModelHelper;
Use MailHelper;

class PaypalController extends Controller
{
    function index(Request $request,$id){
        
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="stripe"){
            return redirect()->route("stripe_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="authorize"){
            return redirect()->route("authorize_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="Instapay"){
            return redirect()->route("instapay_payment",$id);
        }
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
                $data = new \stdClass();
                    $data->name=" Payment Request ";
                    $data->meta_title=" Payment Request ";
                    $data->meta_keywords=" Payment Request ";
                    $data->meta_description=" Payment Request ";
                    $booking=$booking->toArray();
                    //dd($data,$booking,$property);
                return view("front.booking.payment.paypal",compact("booking","data","property"));
            }
        }
        return abort(404);//
    }

    function indexPost(Request $request,$id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
       // dd($request->all(),$id);
        try {

           
            if($request->st == "COMPLETED" ){
                $payment=Payment::create([
                    'booking_id'=>$booking->id,
                    'receipt_url'=>'' ,
                    'customer_id'=>'' ,
                    'amount'=>$request->amt,
                    'tran_id'=>$request->tx ,
                    'description'=>json_encode($request->all()),
                    'type'=>"paypal",
                    'status'=>"complete"
                ]);
                ModelHelper::finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property);

                return redirect('payment/success/'.$payment->id)->with("success","successfully Payment");
            }else{
                $message="something happen";
            }
      
        }  catch (Exception $e) {
     
            $message =$e->getError()->message ;
        }
        
  
        
          
         }else{
            $message="property is not longer";
         }
        }else{
            $message="Booking is invalid";
        }
        return redirect()->back()->with("danger",$message);
    }
}
