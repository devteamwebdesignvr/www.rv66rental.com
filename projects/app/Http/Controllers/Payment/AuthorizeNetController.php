<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Property;
use App\Models\Location;
use App\Models\Payment;
use App\Models\Country;
use App\Models\State;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Session;
use ModelHelper;
use MailHelper;
use LiveCart;

class AuthorizeNetController extends Controller
{
    function index(Request $request,$id){
        
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="stripe"){
            return redirect()->route("stripe_payment",$id);
        }
        if(ModelHelper::getDataFromSetting('which_payment_gateway')=="paypal"){
            return redirect()->route("paypal_payment",$id);
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
                return view("front.booking.payment.authorize",compact("booking","data","property"));
            }
        }
        return abort(404);//
    }

    function indexPost(Request $request,$id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
            if($property){
        try {
             $input = $request->input();
          
          
          
             /**$payment=Payment::create([
                 'booking_id'=>$booking->id,
                 'receipt_url'=>'' ,
                 'customer_id'=>'' ,
                 'amount'=>$input['amount'],
                 'tran_id'=>'TEST123',
                 'description'=>json_encode($input),
                 'type'=>"authorize",
                 'status'=>"complete"
               ]);
            $location=Location::find($property->location_id);
            if($location){
              if($location->amount){
                $refundable_amount=($location->amount);
                // ($this->authorizeCreditCard($refundable_amount,$booking,$input,$id));
              }
            }
            ModelHelper::finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property);
          **/
          
          
               $cardNumber = preg_replace('/\s+/', '', $input['cardNumber']);
             //  if($booking->customer_profile_id){}else{
                    $first_name=$input['first_name'];
                    $last_name=$input['last_name'];
                    $company=$input['company'];
                    $address=$input['address'];
                    $city=$input['city'];
                    $state=State::find($input['state']);
                    if($state){
                        $state=$state->iso2;
                    }else{
                        return redirect()->back()->with("danger","Invalid State");
                    }
                    $country=Country::find($input['country']);
                    if($country){
                        $country=$country->iso2;
                    }else{
                        return redirect()->back()->with("danger","Invalid Country");
                    }
                    $zipcode=$input['zipcode'];
                    $mobile=$input['mobile'];
                    $response=$this->createCustomerProfile($booking->email,$cardNumber,$input['cvv'],$input['expiration-year'],$input['expiration-month'],$first_name,$last_name,$mobile,$company,$city,$state,$country,$zipcode,$address);
                   // dd($response,$request->all());
                    if($response['status']==400){
                       // dd($response['message']);
                        return redirect()->back()->with("danger",$response['message']);
                    }else{
                        BookingRequest::find($id)->update([
                            "customer_profile_id"=>$response['customer_profile_id'],
                            "customer_profile_payment_id"=>$response['customer_profile_payment_id'],
                            "customer_json_data"=>$response['customer_json_data'],
                        ]);
                    }
             //  }

            $booking=BookingRequest::find($id);
            /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));
            // Set the transaction's refId
            $refId = 'ref' . time();
            $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
            $profileToCharge->setCustomerProfileId($booking->customer_profile_id);
            $paymentProfile = new AnetAPI\PaymentProfileType();
            $paymentProfile->setPaymentProfileId($booking->customer_profile_payment_id);
            $profileToCharge->setPaymentProfile($paymentProfile);
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authCaptureTransaction");
            $transactionRequestType->setAmount($input['amount']);
            $transactionRequestType->setProfile($profileToCharge);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId( $refId);
            $request->setTransactionRequest($transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            $refundable_amount=200;
           
            if ($response != null) {
                // Check to see if the API request was successfully received and acted upon
                if ($response->getMessages()->getResultCode() == "Ok") {
                    // Since the API request was successful, look for a transaction response
                    // and parse it to display the results of authorizing the card
                    $tresponse = $response->getTransactionResponse();
                    if ($tresponse != null && $tresponse->getMessages() != null) {
                        $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                        $msg_type = "success_msg";    
                          $payment=Payment::create([
                            'booking_id'=>$booking->id,
                            'receipt_url'=>'' ,
                            'customer_id'=>'' ,
                            'amount'=>$input['amount'],
                            'tran_id'=>$tresponse->getTransId(),
                            'description'=>json_encode($input),
                            'type'=>"authorize",
                            'status'=>"complete"
                        ]);
                        $location=Location::find($property->location_id);
                        if($location){
                            if($location->amount){
                                $refundable_amount=($location->amount);
                              // ($this->authorizeCreditCard($refundable_amount,$booking,$input,$id));
                           }
                        }
                        ModelHelper::finalEmailAndUpdateBookingPayment($id,$booking,$payment,$property);
                        return redirect('payment/success/'.$payment->id)->with("success","successfully Payment");
                    } else {
                        $message_text = 'There were some issue with the payment. Please try again later.';
                        $msg_type = "error_msg";                                    
                        if ($tresponse->getErrors() != null) {
                            $message_text = $tresponse->getErrors()[0]->getErrorText();
                            $msg_type = "error_msg";                                    
                            // dd($message_text,"first");
                        }
                    }
                    // Or, print errors if the API request wasn't successful
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";                                    
                    $tresponse = $response->getTransactionResponse();
                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";
                        // dd($message_text,"if");
                    } else {
                        $message_text = $response->getMessages()->getMessage()[0]->getText();
                        $msg_type = "error_msg";
                        // dd($message_text,"else");
                    }                
                }
            } else {
                $message_text = "No response returned";
                $msg_type = "error_msg";
                // dd($message_text,"no ");
            }
            //dd($message_text);
            return back()->with($msg_type, $message_text)->with("danger",$message_text);
        }  catch (Exception $e) {
            $message =$e->getError()->message ;
        }
         }else{
            $message="property is not longer";
         }
        }else{
            $message="Booking is invalid";
        }
       // dd($message,"last");
        return redirect()->back()->with("danger",$message);
    }

    function authorizeCreditCard($amount,$booking,$input,$id){
        $booking=BookingRequest::find($id);
        try {
            /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));

            // Set the transaction's refId
            $refId = 'ref' . time();

            $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
            $profileToCharge->setCustomerProfileId($booking->customer_profile_id);
            $paymentProfile = new AnetAPI\PaymentProfileType();
            $paymentProfile->setPaymentProfileId($booking->customer_profile_payment_id);
            $profileToCharge->setPaymentProfile($paymentProfile);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "authOnlyTransaction"); 
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setProfile($profileToCharge);

            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId( $refId);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
               if ($response != null) {
                // Check to see if the API request was successfully received and acted upon
                if ($response->getMessages()->getResultCode() == "Ok") {
                    // Since the API request was successful, look for a transaction response
                    // and parse it to display the results of authorizing the card
                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getMessages() != null) {

                        
                        BookingRequest::find($id)->update([
                            "refund_tran_id"=>$tresponse->getTransId()
                        ]);
                       //  $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                       // dd($tresponse,$message_text);
                        return ["status"=>200];

                    } else {
                        $message_text = 'There were some issue with the payment. Please try again later.';
                        $msg_type = "error_msg";                                    

                        if ($tresponse->getErrors() != null) {
                            $message_text = $tresponse->getErrors()[0]->getErrorText();
                            $msg_type = "error_msg";                                    
                        }
                    }
                    // Or, print errors if the API request wasn't successful
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";                                    

                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";                    
                    } else {
                        $message_text = $response->getMessages()->getMessage()[0]->getText();
                        $msg_type = "error_msg";
                    }                
                }
            } else {
                $message_text = "No response returned";
                $msg_type = "error_msg";
            }

        }  catch (Exception $e) {
            $message =$e->getError()->message ;
        }
        return ["status"=>400,"message"=>$message_text];
    }

    function createCustomerProfile($email,$card_no,$cvv,$exp_year,$exp_month,$first_name,$last_name,$mobile,$company,$city,$state,$country,$zipcode,$address){
        if($exp_month<10){
            $exp_month='0'.$exp_month;
        }
       // dd($exp_month);
            //dd($email,$card_no,$cvv,$exp_year,$exp_month,$first_name,$last_name,$mobile,$company,$city,$state,$country,$zipcode,$address);
         /* Create a merchantAuthenticationType object with authentication details
        
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));
    
        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create a Customer Profile Request
        //  1. (Optionally) create a Payment Profile
        //  2. (Optionally) create a Shipping Profile
        //  3. Create a Customer Profile (or specify an existing profile)
        //  4. Submit a CreateCustomerProfile Request
        //  5. Validate Profile ID returned

        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_no);
        $creditCard->setExpirationDate($exp_year."-".$exp_month);
        $creditCard->setCardCode($cvv);
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        // Create the Bill To info for new payment type
        $billTo = new AnetAPI\CustomerAddressType();
        $billTo->setFirstName($first_name);
        $billTo->setLastName($last_name);
        $billTo->setCompany($company);
        $billTo->setAddress($address);
        $billTo->setCity($city);
        $billTo->setState($state);
        $billTo->setZip($zipcode);
        $billTo->setCountry($country);
        $billTo->setPhoneNumber($mobile);
        $billTo->setfaxNumber($mobile);
        // Create an array of any shipping addresses
        $shippingProfiles[] = $billTo;
        // Create a new CustomerPaymentProfile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setBillTo($billTo);
        $paymentProfile->setPayment($paymentCreditCard);
        $paymentProfiles[] = $paymentProfile;
        // Create a new CustomerProfileType and add the payment profile object
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setDescription("Customer 2 Test PHP");
        $customerProfile->setMerchantCustomerId("M_" . time());
        $customerProfile->setEmail($email);
        $customerProfile->setpaymentProfiles($paymentProfiles);
        $customerProfile->setShipToList($shippingProfiles);
        // Assemble the complete transaction request
        $request = new AnetAPI\CreateCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setProfile($customerProfile);
        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            // echo "Succesfully created customer profile : " . $response->getCustomerProfileId() . "\n";
            $paymentProfiles = $response->getCustomerPaymentProfileIdList();
            // echo "SUCCESS: PAYMENT PROFILE ID : " . $paymentProfiles[0] . "\n";
            $ar=[
                "status"=>200,
                "customer_profile_id"=> $response->getCustomerProfileId(),
                "customer_profile_payment_id"=> $paymentProfiles[0],
                'customer_json_data'=>json_encode($response)
            ];
        } else {
            // echo "ERROR :  Invalid response\n";
            $errorMessages = $response->getMessages()->getMessage();
            // echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
             $ar=[
                "status"=>400,
                "message"=> $errorMessages[0]->getText(),
                'customer_json_data'=>json_encode($response)
            ];
        }
      //  dd($ar);
        return $ar;
    }

    function releasePayment($id){
        $booking=BookingRequest::find($id);
        if($booking){
             $property=Property::find($booking->property_id);
            /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));
            // Set the transaction's refId
            $refId = 'ref' . time();
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "voidTransaction"); 
            $transactionRequestType->setRefTransId($booking->refund_tran_id);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId($refId);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            if ($response != null){
              if($response->getMessages()->getResultCode() == "Ok"){
                $tresponse = $response->getTransactionResponse();
                if ($tresponse != null && $tresponse->getMessages() != null){
                    BookingRequest::find($id)->update(["void_status"=>"release"]);
                    return redirect()->back()->with("success",$tresponse->getMessages()[0]->getDescription() );
                }
                else{
                 // echo "Transaction Failed \n";
                  if($tresponse->getErrors() != null){
                  //  echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    return redirect()->back()->with("danger",$tresponse->getErrors()[0]->getErrorText() );
                  }
                }
              }
              else{
               // echo "Transaction Failed \n";
                $tresponse = $response->getTransactionResponse();
                if($tresponse != null && $tresponse->getErrors() != null){
                 // echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                  return redirect()->back()->with("danger", $tresponse->getErrors()[0]->getErrorText() );
                }
                else{
                 // echo " Error code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                  return redirect()->back()->with("danger",$response->getMessages()->getMessage()[0]->getText() );
                }
              }      
            }
            else{
              return redirect()->back()->with("danger", "No response returned \n");
            }
            return $response;
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    function chargePayment($id){
        $booking=BookingRequest::find($id);
        if($booking){
            $property=Property::find($booking->property_id);
              /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));
            // Set the transaction's refId
            $refId = 'ref' . time();
            // Now capture the previously authorized  amount
            //echo "Capturing the Authorization with transaction ID : " . $transactionid . "\n";
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("priorAuthCaptureTransaction");
            $transactionRequestType->setRefTransId($booking->refund_tran_id);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            
            if ($response != null){
              if($response->getMessages()->getResultCode() == "Ok"){
                $tresponse = $response->getTransactionResponse();
                
                if ($tresponse != null && $tresponse->getMessages() != null){
                   BookingRequest::find($id)->update(["void_status"=>"charged"]);
                    return redirect()->back()->with("success",$tresponse->getMessages()[0]->getDescription() );
                }
                else{
                 // echo "Transaction Failed \n";
                  if($tresponse->getErrors() != null){
                    //echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                     return redirect()->back()->with("danger", $tresponse->getErrors()[0]->getErrorText() );            
                  }
                }
              }
              else{
               // echo "Transaction Failed \n";
                $tresponse = $response->getTransactionResponse();
                if($tresponse != null && $tresponse->getErrors() != null){
                  //echo " Error code  : " . $tresponse->getErrors()[0]->getErrorCode() );
                   return redirect()->back()->with("danger", $tresponse->getErrors()[0]->getErrorText() );                      
                }
                else{
                 // echo " Error code  : " . $response->getMessages()->getMessage()[0]->getCode() );
                   return redirect()->back()->with("danger", $response->getMessages()->getMessage()[0]->getText() );
                }
              }      
            }
            else{
               return redirect()->back()->with("danger", "No response returned \n");
            }
            return $response;
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }

    function twoDayBeforePaymentData(){
        $date=date('Y-m-d', strtotime(' +2 day'));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed"])->whereNull("refund_tran_id")->where("checkin",$date)->get();
        foreach($events as $booking){
            if($booking->customer_profile_id){
                if($booking->customer_profile_payment_id){
                    $property=Property::find($booking->property_id);
                    if($property){
                        $location=Location::find($property->location_id);
                        if($location){
                            if($location->amount){
                                $refundable_amount=($location->amount);
                                $input=[];
                                $id=$booking->id;
                               ($this->authorizeCreditCard($refundable_amount,$booking,$input,$id));
                           }
                        }
                    }
                }
            }
        }
        
    //    dd($booking);
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_how_many_days').'days',strtotime(date('Y-m-d'))));
      
   //   dd($date);
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","booking_type_admin"=>"invoice","total_payment"=>2,"how_many_payment_done"=>1,"reminder_email"=>"false"])->where("id","!=","205")->whereNotNull("customer_profile_payment_id")->where("checkin",'<=',$date)->get();
       // $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","booking_type_admin"=>"invoice","total_payment"=>2,"how_many_payment_done"=>1,"reminder_email"=>"false"])->where("id",'209')->get();
      //  dd($events);
        foreach($events as $booking){
            if($booking->customer_profile_id){
                if($booking->customer_profile_payment_id){
                    $property=Property::find($booking->property_id);
                    if($property){
                        if($booking->amount_data){
                            $amount_data=json_decode($booking->amount_data,true);
                          //  dd($amount_data,$events);
                            if(is_array($amount_data)){
                                foreach($amount_data as $c){
                                    if(isset($c['status'])){
                                        
                                    }else{
                                        $refundable_amount=$c['amount'];
                                        $input=[];
                                        $id=$booking->id;
                                       ($this->authorizeForSecondPaymentCreditCard($refundable_amount,$booking,$input,$id));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    function authorizeForSecondPaymentCreditCard($amount,$booking,$input,$id){
        $booking=BookingRequest::find($id);
        try {
            /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY'));

            // Set the transaction's refId
            $refId = 'ref' . time();

            $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
            $profileToCharge->setCustomerProfileId($booking->customer_profile_id);
            $paymentProfile = new AnetAPI\PaymentProfileType();
            $paymentProfile->setPaymentProfileId($booking->customer_profile_payment_id);
            $profileToCharge->setPaymentProfile($paymentProfile);

            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "authOnlyTransaction"); 
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setProfile($profileToCharge);

            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId( $refId);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
               if ($response != null) {
                // Check to see if the API request was successfully received and acted upon
                if ($response->getMessages()->getResultCode() == "Ok") {
                    // Since the API request was successful, look for a transaction response
                    // and parse it to display the results of authorizing the card
                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getMessages() != null) {
                              $booking= BookingRequest::find($id);
                        $payment=Payment::create([
                            'booking_id'=>$booking->id,
                            'receipt_url'=>'' ,
                            'customer_id'=>'' ,
                            'amount'=>$amount,
                            'tran_id'=>$tresponse->getTransId(),
                            'description'=>json_encode($tresponse),
                            'type'=>"authorize",
                            'status'=>"complete"
                        ]);
                        
                       $booking= BookingRequest::find($id);
                        $property=Property::find($booking->property_id);
                        
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
                        
                        
                        
                       //  $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                       // dd($tresponse,$message_text);
                        return ["status"=>200];

                    } else {
                        $message_text = 'There were some issue with the payment. Please try again later.';
                        $msg_type = "error_msg";                                    

                        if ($tresponse->getErrors() != null) {
                            $message_text = $tresponse->getErrors()[0]->getErrorText();
                            $msg_type = "error_msg";                                    
                        }
                    }
                    // Or, print errors if the API request wasn't successful
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type = "error_msg";                                    

                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type = "error_msg";                    
                    } else {
                        $message_text = $response->getMessages()->getMessage()[0]->getText();
                        $msg_type = "error_msg";
                    }                
                }
            } else {
                $message_text = "No response returned";
                $msg_type = "error_msg";
            }

        }  catch (Exception $e) {
            $message =$e->getError()->message ;
        }
        return ["status"=>400,"message"=>$message_text];
    }

}
