<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Payment;
use Stripe;
use Session;
use ModelHelper;
Use MailHelper;

class StripeController extends Controller
{
    function index(Request $request,$id){
        
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="paypal"){
            return redirect()->route("paypal_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="authorize"){
            return redirect()->route("authorize_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="Instapay"){
            return redirect()->route("instapay_payment",$id);
        }
        
        $booking=BookingRequest::find($id);
        if($booking){
            if($booking->payment_status!="paid"){
                $property=Property::find($booking->property_id);
                if($property){
                    $data = new \stdClass();
                        $data->name="Stripe Payment Booking ";
                        $data->meta_title="Stripe Payment Booking ";
                        $data->meta_keywords="Stripe Payment Booking ";
                        $data->meta_description="Stripe Payment Booking ";
                        $booking=$booking->toArray();
                    return view("front.booking.payment.stripe",compact("booking","data","property"));
                }
            }else{
                return redirect('/');
            }
        }
        return abort(404);//
    }

    function indexPost(Request $request,$id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
        //dd($request->all(),$id);
        try {

            Stripe\Stripe::setApiKey(ModelHelper::getDataFromSetting('stripe_secret_key'));
            $customer = Stripe\Customer::create(array(
              "email" => $booking->email,
              "source" => $request->stripeToken,
            ));
            $amount=$request->amount;
            $charge=Stripe\Charge::create ([
                    'customer' => $customer->id,
                    "amount" => $amount * 100,
                    "currency" => "usd",
                   
                    "description" => "Payment for ".$property->name
            ]);

            $chargeJson=$charge->jsonSerialize();
            // /dd($chargeJson);
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
                $payment=Payment::create([
                    'booking_id'=>$booking->id,
                    'receipt_url'=>$chargeJson['receipt_url'] ,
                    'customer_id'=>$chargeJson['customer'] ,
                    'balance_transaction'=>$chargeJson['balance_transaction'] ,
                    'tran_id'=>$chargeJson['id'] ,
                    'description'=>json_encode($chargeJson),
                    'status'=>"complete",
                    'type'=>"stripe",
                    'amount'=>$amount
                ]);
                ModelHelper::finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property);

                return redirect('payment/success/'.$payment->id)->with("success","successfully Payment");
            }else{
                $message="something happen";
            }
          // Use Stripe's library to make requests...
        } catch(Stripe\Exception\CardException $e) {
          // Since it's a decline, Stripe\Exception\CardException will be caught
          
          $message =$e->getError()->message ;
        } catch (Stripe\Exception\RateLimitException $e) {
          // Too many requests made to the API too quickly
            $message =$e->getError()->message ;
        } catch (Stripe\Exception\InvalidRequestException $e) {
          // Invalid parameters were supplied to Stripe's API
            $message =$e->getError()->message ;
        } catch (Stripe\Exception\AuthenticationException $e) {
          // Authentication with Stripe's API failed
          // (maybe you changed API keys recently)
            $message =$e->getError()->message ;
        } catch (Stripe\Exception\ApiConnectionException $e) {
          // Network communication with Stripe failed
            $message =$e->getError()->message ;
        } catch (Stripe\Exception\ApiErrorException $e) {
          // Display a very generic error to the user, and maybe send
          // yourself an email
            $message =$e->getError()->message ;
        } catch (Exception $e) {
          // Something else happened, completely unrelated to Stripe
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
