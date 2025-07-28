<?php 
namespace App\Helper;
use Auth;
use DB;
use App\Models\BasicSetting;
use App\Models\EmailTemplete;
use Mail;
use Config;
use ModelHelper;
/**
 * Class Helper
 * @package App\Helper
 */
class MailHelper{

    public function emailSender($mailData){
        $temp = EmailTemplete::where('email_type','=',$mailData['type'])->first();
        if($temp){
            $body=$temp->email_body;
            if(isset($mailData['useremail'])){
                $body = preg_replace("/{useremail}/", $mailData['useremail'] ,$body);
            }
            if(isset($mailData['username'])){
                $body = preg_replace("/{username}/", $mailData['username'] ,$body);
            }
            if(isset($mailData['usermobile'])){
                $body = preg_replace("/{usermobile}/", $mailData['usermobile'] ,$body);
            }
           
            if(isset($mailData['usermessage'])){
                $body = preg_replace("/{usermessage}/", $mailData['usermessage'] ,$body);
            }
            if(isset($mailData['date_of_request'])){
                $body = preg_replace("/{date_of_request}/", $mailData['date_of_request'] ,$body);
            }
            if(isset($mailData['guests'])){
                $body = preg_replace("/{guests}/", $mailData['guests'] ,$body);
            }
            if(isset($mailData['budget'])){
                $body = preg_replace("/{budget}/", $mailData['budget'] ,$body);
            }
            $data = ['email_body' => $body];
            $objDemo = new \stdClass();
            $objDemo->to = explode(',',$mailData['to']);
            $objDemo->from = ModelHelper::getDataFromSetting("mail_from");
            $objDemo->title = ModelHelper::getDataFromSetting("mail_from_name");
            $objDemo->subject = $temp->email_subject;
            try{
                Mail::send('mail.dummyMail',$data, function ($message) use ($objDemo) {
                    $message->from($objDemo->from,$objDemo->title);
                    $message->to($objDemo->to);
                    $message->subject($objDemo->subject);
                });
            }catch (\Exception $e){
                 ($e->getMessage());
            }
        }
    }

    public function emailSenderByController($html,$to,$subject,$files=[]){
        $data = ['email_body' => $html];
        $objDemo = new \stdClass();
        $objDemo->to = explode(',',$to);
        $objDemo->from = ModelHelper::getDataFromSetting("mail_from");
        $objDemo->title = ModelHelper::getDataFromSetting("mail_from_name");
        $objDemo->subject = $subject;
        try{
            Mail::send('mail.dummyMail',$data, function ($message) use ($objDemo,$files) {
                $message->from($objDemo->from,$objDemo->title);
                $message->to($objDemo->to);
                $message->subject($objDemo->subject);
                if(count($files)>0){
                    foreach ($files as $file){
                        $message->attach($file);
                    }
                }
            });
        }catch (\Exception $e){
             ($e->getMessage());
        }
    }
}