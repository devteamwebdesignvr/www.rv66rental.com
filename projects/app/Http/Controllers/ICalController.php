<?php

namespace App\Http\Controllers;
use App\Models\IcalEvent;
use LiveCart;
use MailHelper;
use ModelHelper;
use App\Models\Property;
use App\Models\PropertyRate;
use App\Models\BookingRequest;

class ICalController extends Controller
{
   function setCronJob(){
       $this->refresshCalendar1();
     //   $this->sendReminderPackage1();
        $this->sendWelcomePackage1();
        $this->setPriceLab1();
    }
   /**
    * Gets the events data from the database
    * and populates the iCal object.
    *
    * @return void
    */
   public function getEventsICalObject($id)
   {
       $events = IcalEvent::where(["event_type"=>"website","event_pid"=>$id])->get();
       $ICAL_FORMAT= 'Ymd\THis\Z';

$icalObject = "BEGIN:VCALENDAR
VERSION:2.0
METHOD:PUBLISH
PRODID:-//Laravel//Webdesignvr//EN\n";

// loop over events
foreach ($events as $event) {
$uid=strtotime("now")."#".$event->id."#saro@".env('APP_URL_WITHOUT_HTTPS','Laravel');
$icalObject .=
"BEGIN:VEVENT
DTSTART:" . date($ICAL_FORMAT, strtotime($event->start_date)) . "
DTEND:" . date($ICAL_FORMAT, strtotime($event->end_date)) . "
DTSTAMP:" . date($ICAL_FORMAT, strtotime($event->created_at)) . "
SUMMARY:$event->text
DESCRIPTION:$event->text
UID:$uid
STATUS:CONFIRMED
LAST-MODIFIED:" . date($ICAL_FORMAT, strtotime($event->updated_at)) . "
END:VEVENT\n";
}

       // close calendar
        $icalObject .= "END:VCALENDAR";
        $file= sprintf("%06d", $id);
       file_put_contents(public_path('uploads/ical/'.$file.".ics"), $icalObject);
   }
   
   function refresshCalendar(){
    LiveCart::allIcalImportListRefresh();
    return redirect()->back()->with("success","successfully refreshed");
   }
   
   function refresshCalendar1(){
    LiveCart::allIcalImportListRefresh();
    //return redirect()->back()->with("success","successfully refreshed");
   }

   function setPriceLab(){
    if(ModelHelper::getDataFromSetting('pricelab_access_token')!=""):
        $data=Property::whereNotNull("api_id")->whereNotNull("api_pms")->get();
        foreach($data as $property){
            if($property->api_id){
                if($property->api_pms){
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.pricelabs.co/v1/listing_prices',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                        "listings": [
                            {
                                "id": "'.$property->api_id.'",
                                "pms": "'.$property->api_pms.'"
                            }
                        ]
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'X-API-Key: '.ModelHelper::getDataFromSetting('pricelab_access_token'),
                        'Content-Type: application/json'
                      ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $json = json_decode($response, true);
               
                    if(isset($json[0]['data'])):
                        foreach($json[0]['data'] as $results) {
                            $bdate=$results['date'];
                            $price=$results['price'];
                            try{
                                if($bdate!="" && $price!=""):
                                    PropertyRate::where(["property_id"=>$property->id,"single_date"=>$bdate])->delete();

                                    PropertyRate::create([
                                        "property_id"=>$property->id,
                                        "single_date"=>$bdate,
                                        "single_date_timestamp"=>strtotime($bdate),
                                        "price"=>$price,
                                        "is_available"=>1,
                                        "platform_type"=>$property->api_pms,
                                        "min_stay"=>$results['min_stay'],
                                        "base_min_stay"=>$results['min_stay']
                                    ]);
                                endif;
                            }catch(Exception $e) {
                              echo 'Message: ' .$e->getMessage();die;
                            }
                        }
                    endif;
                }
            }
        }

    endif;
    return redirect()->back();

   }




   function setPriceLab1(){
    if(ModelHelper::getDataFromSetting('pricelab_access_token')!=""):
        $data=Property::whereNotNull("api_id")->whereNotNull("api_pms")->get();
        foreach($data as $property){
            if($property->api_id){
                if($property->api_pms){
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://api.pricelabs.co/v1/listing_prices',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>'{
                        "listings": [
                            {
                                "id": "'.$property->api_id.'",
                                "pms": "'.$property->api_pms.'"
                            }
                        ]
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'X-API-Key: '.ModelHelper::getDataFromSetting('pricelab_access_token'),
                        'Content-Type: application/json'
                      ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                    $json = json_decode($response, true);
               
                    if(isset($json[0]['data'])):
                        foreach($json[0]['data'] as $results) {
                            $bdate=$results['date'];
                            $price=$results['price'];
                            try{
                                if($bdate!="" && $price!=""):
                                    PropertyRate::where(["property_id"=>$property->id,"single_date"=>$bdate])->delete();

                                    PropertyRate::create([
                                        "property_id"=>$property->id,
                                        "single_date"=>$bdate,
                                        "single_date_timestamp"=>strtotime($bdate),
                                        "price"=>$price,
                                        "is_available"=>1,
                                        "platform_type"=>$property->api_pms,
                                        "min_stay"=>$results['min_stay'],
                                        "base_min_stay"=>$results['min_stay']
                                    ]);
                                endif;
                            }catch(Exception $e) {
                              echo 'Message: ' .$e->getMessage();die;
                            }
                        }
                    endif;
                }
            }
        }

    endif;
    //return redirect()->back();

   }


   function sendWelcomePackage(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('welcome_package_send_day').'days',strtotime(date('Y-m-d'))));
        $date='2023-05-06';
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","welcome_email"=>"false","booking_type_admin"=>"invoice"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.welcome-package-admin",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('welcome_package_receiving_mail');
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.welcome-package-customer",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["welcome_email"=>"true"]);
            }
        }
        
        return redirect()->back();
   }  
   
   
   

   function sendWelcomePackage1(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('welcome_package_send_day').'days',strtotime(date('Y-m-d'))));
        $date='2023-05-06';
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","welcome_email"=>"false","booking_type_admin"=>"invoice"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.welcome-package-admin",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('welcome_package_receiving_mail');
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.welcome-package-customer",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Welcome Package in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["welcome_email"=>"true"]);
            }
        }
        
        //return redirect()->back();
   }  
   
   function sendReminderPackage(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>2,"how_many_payment_done"=>1,"reminder_email"=>"false","booking_type_admin"=>"invoice"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>3,"how_many_payment_done"=>1,"booking_type_admin"=>"invoice","third_reminder_email"=>"false","reminder_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
             
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","total_payment"=>3,"booking_type_admin"=>"invoice","how_many_payment_done"=>2,"third_reminder_email"=>"false"])->where("checkin",$date)->get();

        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["third_reminder_email"=>"true"]);
            }
        }
        
        return redirect()->back();
   }
   
   
   
   function sendReminderPackage1(){
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","booking_type_admin"=>"invoice","total_payment"=>2,"how_many_payment_done"=>1,"reminder_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
                if($property->welcome_package_attachment){
                    $files[]=public_path($property->welcome_package_attachment);
                }
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('second_third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","booking_type_admin"=>"invoice","total_payment"=>3,"how_many_payment_done"=>1,"third_reminder_email"=>"false","reminder_email"=>"false"])->where("checkin",$date)->get();
       
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
             
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["reminder_email"=>"true"]);
            }
        }
        
        
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('third_how_many_days').'days',strtotime(date('Y-m-d'))));
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","payment_status"=>"partially","booking_type_admin"=>"invoice","total_payment"=>3,"how_many_payment_done"=>2,"third_reminder_email"=>"false"])->where("checkin",$date)->get();

        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                
                $html= view("mail.reminder-admin-email",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('reminder_package_receiving_mail');
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                $html= view("mail.reminder-user-email",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Reminder Payment Request for ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject);
                
                BookingRequest::find($data->id)->update(["third_reminder_email"=>"true"]);
            }
        }
        
        //return redirect()->back();
   }


   function sendReviewEmail(){
      
        $date=date('Y-m-d',strtotime("+".ModelHelper::getDataFromSetting('review_send_day').'days',strtotime(date('Y-m-d'))));
      //  $date='2022-12-21';
        $events = BookingRequest::where(["booking_status"=>"booking-confirmed","review_email"=>"false","booking_type_admin"=>"invoice"])->where("checkout",$date)->get();
       // dd($events);
        foreach($events as $data){
            $property=Property::find($data->property_id);
            if($property){
                $files=[];
              
                $html= view("mail.review-admin",compact("property","data"))->render();
                $to=ModelHelper::getDataFromSetting('review_receiving_mail');
                $admin_subject="Review in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                $html= view("mail.review-customer",compact("property","data"))->render();
                $to=$data->email;
                $admin_subject="Review in ".$property->name;
                MailHelper::emailSenderByController($html,$to,$admin_subject,$files);
                
                BookingRequest::find($data->id)->update(["review_email"=>"true"]);
            }
        }
        return redirect()->back();
   }
}