<?php 
namespace App\Helper;
use App\Models\Agent;
use Auth;
use DB;
use File;
use ModelHelper;
use LiveCart;
use App\Models\BasicSetting;
use App\Models\PropertyRate;
use App\Models\Property;
use App\Models\CheckinConfig;
use Session;
/**
 * Class Helper
 * @package App\Helper
 */
class Helper{
    
    public function getPriceAmountData($id){
        $data=Property::find($id);
        $price=0;
        if($data){
            $price=$data->price;
            if($data->standard_rate){
                $price=$data->standard_rate;
            }
            $propertyRate=PropertyRate::where(["single_date"=>date('Y-m-d'),"property_id"=>$data->id])->orderBy('id',"desc")->first();
            if($propertyRate){
                $price=$propertyRate->price;
            }
            if(request()->start_date){
                $propertyRate=PropertyRate::where(["single_date"=>request()->start_date,"property_id"=>$data->id])->orderBy('id',"desc")->first();
                if($propertyRate){
                    $price=$propertyRate->price;
                }
            }
        }
        return $price;
    }
    
    public function deleteFile($file){
        if($file){
            $image_path = public_path("{$file}");
            if (File::exists($image_path)) {
                //File::delete($image_path);
            }
        }
    }

	public function calculateDays($start_date,$end_date){
		$now = strtotime($start_date); // or your date as well
		$your_date = strtotime($end_date);
		$datediff =  $your_date-$now;
		$day= ceil($datediff / (60 * 60 * 24));
		return $day;
	}

	public function getBookingStatus($item,$id){
		if($item=="booked"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-primary">Accept Booking</a>';
		}
		if($item=="rental-aggrement-success"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-warning">Booking Accepted</a>';
		}
		if($item=="rental-aggrement"){
			$s='<a href="'.url('admin/booking-enquiries/confirmed/'.$id).'" class="btn btn-xs btn-warning">Booking Accepted</a>';
		}
		if($item=="booking-confirmed"){
			$s='<a href="javascript:;" class="btn btn-xs btn-success">Booking Confirmed</a>';
		}
		if($item=="booking-cancel"){
			$s='<a href="javascript:;" class="btn btn-xs btn-danger">Booking Cancelled</a>';
		}
		return $s;
	}

	public function checkStatus($item){
		if($item=="true"){
			return '<i class="fa fa-check"></i>';
		}else{
			return '<i class="fa fa-times"></i>';
		}
	}

	public function getDayBetweenTwoDates($start_date,$end_date){
		$now = strtotime($start_date); 
        $your_date = strtotime($end_date);
        $datediff =  $your_date-$now;
        $day= ceil($datediff / (60 * 60 * 24));
        return $day;
	}

	public function getFeeAmountAndName($c,$gross_amount){
		$name=$c->fee_name;
        if($c->fee_type=="Percentage"):
            $amount=round(($gross_amount*$c->fee_rate)/100,2);
        else:
            $amount=$c->fee_rate; 
        endif;
        return ["status"=>true,"name"=>$name,"amount"=>$amount];
	}

	public function getPropertyRates($id){
		$ar=PropertyRate::where(["property_id"=>$id])->orderBy("id","desc")->get();
		$ar_checkin_checkout=LiveCart::iCalDataCheckInCheckOut($id);
		$new_dates=[];
		$payment_currency=ModelHelper::getDataFromSetting('payment_currency');
		$property=Property::find($id);
		$price='';
		if($property){
		    $price=$property->standard_rate;
		}
		for($i=0;$i<=365;$i++){
		     $title=$payment_currency.''.$price;
		    $class="available-date-full-calendar";
		    $date_single=date('Y-m-d',strtotime("+ ".$i."days",strtotime(date('Y-m-d'))));
		    $a=PropertyRate::where(["property_id"=>$id])->where("single_date",$date_single)->orderBy("id","desc")->first();
		    if($a){
		        $title=$payment_currency.''.$a->price;
		    }
			if(in_array($date_single, $ar_checkin_checkout['checkin'])){
				$title='';
				$class="booked-date-full-calendar";
			}
			if(in_array($date_single, $ar_checkin_checkout['checkout'])){
				$title='';
				$class="booked-date-full-calendar";
			}
		    $new_dates[]=["title"=>$title,"start"=>$date_single,"end"=>$date_single,"className"=>$class];
		}
		return json_encode($new_dates);
	}

	public function getGrossAmountData($property,$start_date,$end_date,$edit="default"){
        //dd($property); 
		$status=false;
		$gross_amount=0;
		$message='';
		$total_night=0;
		$stay_flag=0;
		$day_gaurav=$this->getWeekNameSelect();
		$blocked_date=[];
		$blocked_dates=CheckinConfig::where(["type"=>"date-wise"])->get();
		foreach($blocked_dates as $b){
		    $blocked_date[]=$b->date_data;
		}
		$blocked_day=[];
		$blocked_days=CheckinConfig::where(["type"=>"day-wise"])->get();
		foreach($blocked_days as $b){
		    $blocked_day[]=$b->name;
		}
		if($edit!="edit"){
    		if(in_array($start_date,$blocked_date)){
    		    $status='checkin-checkout-day';
    		    return [
        			"status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>0,"message"=>'You can not check in, check out on Saturday, Sunday and US Holidays'
        		];
    		}
    		if(in_array($end_date,$blocked_date)){
    		     $status='checkin-checkout-day';
    		    return [
        			"status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>0,"message"=>'You can not check in, check out on Saturday, Sunday and US Holidays'
        		];
    		}
    		$snew_day=(date('w', strtotime($start_date)));
    		if(in_array($snew_day,$blocked_day)){
    		     $status='checkin-checkout-day';
    	            $message="Please select another checkin day. You can't checkin on ".$day_gaurav[$snew_day]." ";
    		    return [
        			"status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>0,"message"=>'You can not check in, check out on Saturday, Sunday and US Holidays'
        		];
    		}
    		$snew_day=(date('w', strtotime($end_date)));
    		if(in_array($snew_day,$blocked_day)){
    		     $status='checkin-checkout-day';
    	            $message="Please select another checkout day. You can't checkout on ".$day_gaurav[$snew_day]." ";
    		    return [
        			"status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>0,"message"=>'You can not check in, check out on Saturday, Sunday and US Holidays'
        		];
    		}
		}
		if($property){
            $now = strtotime($start_date); 
            $your_date = strtotime($end_date);
            $datediff =  $your_date-$now;
            $day= ceil($datediff / (60 * 60 * 24));
            $total_night=$day;
             if($day>0){
    	         for($i=0;$i<$day;$i++){
    	         	$date = strtotime($start_date);
    	            $date = strtotime("+".$i." day", $date);
    	            $date= date('Y-m-d', $date);
    	            $rate=PropertyRate::where(["property_id"=>$property->id,"single_date"=>$date])->first();
                    
    	            if($rate){
    	            	$stay_flag=1;
    	            	if($rate->min_stay<=$day){
    	            	    if($i==0){
    	            	        if(in_array($rate->checkin_day,['0','1','2','3','4','5','6'])){
    	            	            $new_day=(date('w', strtotime($date)));
    	            	            if($new_day==$rate->checkin_day){}else{
    	            	                $status='checkin-checkout-day';
    	            	                $message="Please select checkin  day is ".$day_gaurav[$rate->checkin_day];
    	            	                break;
    	            	            }
    	            	        }
    	            	    }
    	            	    if($i==($day-1)){
    	            	        if(in_array($rate->checkout_day,['0','1','2','3','4','5','6'])){
    	            	            $new_day=(date('w', strtotime("+1 day",strtotime($date))));
    	            	            if($new_day==$rate->checkout_day){}else{
    	            	                $status='checkin-checkout-day';
    	            	                $message="Please select checkout  day is ".$day_gaurav[$rate->checkout_day];
    	            	                break;
    	            	            }
    	            	        }
    	            	    }
    	            		if($rate->price){
    		            		$gross_amount+=$rate->price;
    		            		$status=true;
    		            	}
    	            	}else{
    	            		$status='min-stay-day';
    	            		break;
    	            	}
    	            }else{
    	            	if($property->standard_rate){
    	            	 //dd($property);   
    	            	     if($i==0){
    	            	        if(in_array($property->checkin_day,['0','1','2','3','4','5','6'])){
    	            	            $new_day=(date('w', strtotime($date)));
    	            	            if($new_day==$property->checkin_day){}else{
    	            	                $status='checkin-checkout-day';
    	            	                $message="Please select checkin  day is ".$day_gaurav[$property->checkin_day];
    	            	                break;
    	            	            }
    	            	        }
    	            	    }
    	            	    if($i==($day-1)){
    	            	        if(in_array($property->checkout_day,['0','1','2','3','4','5','6'])){
    	            	            $new_day=(date('w', strtotime("+1 day",strtotime($date))));
    	            	            if($new_day==$property->checkout_day){}else{
    	            	                $status='checkin-checkout-day';
    	            	                $message="Please select checkout  day is ".$day_gaurav[$property->checkout_day];
    	            	                break;
    	            	            }
    	            	        }
    	            	    }
    	            		$gross_amount+=$property->standard_rate;
    	            		$status=true;
    	            	}else{
    	            		$status='date-price';
    	            		break;
    	            	}
    	            }
    	         }
    	         if($stay_flag==0){
    	         	if($property->min_stay){
    	         		if($property->min_stay<=$day){}else{
    	         			$status='min-stay-day';
    	         		}
    	         	}else{
    	         		$status='min-stay-day';
    	         	}
    	         }
    	         $ar=[];
    	         if($edit!="edit"){
        	         $checkinCheckout=LiveCart::iCalDataCheckInCheckOut($property->id);
        	        for($i=0;$i<$day;$i++){
        	         	$date = strtotime($start_date);
        	            $date = strtotime("+".$i." day", $date);
        	            $date= date('Y-m-d', $date);
        	            $ar[]=$date;
        	            if(in_array($date, $checkinCheckout['checkin'])){
        	            	$status="already-booked";
        	            	break;
        	            }
        	        }
    	         }
             }
	     }else{
	     	$status='min-stay-day';
	     }
		return [
			"status"=>$status,"gross_amount"=>$gross_amount,"total_night"=>$total_night,"message"=>$message
		];
	}
	
	public function getPropertyList($start_date,$end_date){
	    $now = strtotime($start_date); 
        $your_date = strtotime($end_date);
        $datediff =  $your_date-$now;
        $day= ceil($datediff / (60 * 60 * 24));
            
	    $data=Property::where("status","true")->get();
	    $prop_ids=[];
	    foreach($data as $property){
    	    $checkinCheckout=LiveCart::iCalDataCheckInCheckOut($property->id);
	        for($i=0;$i<$day;$i++){
	         	$date = strtotime($start_date);
	            $date = strtotime("+".$i." day", $date);
	            $date= date('Y-m-d', $date);
	            $ar[]=$date;
	            if(in_array($date, $checkinCheckout['checkin'])){
	            	$prop_ids[]=$property->id;
	            	break;
	            }
    	   }
	    }
	    return $prop_ids;
	}

	public function languageChanger($lan){
		Session::put("current_language",$lan);
	}

	public function getPropertyStatus(){
		return [
			"Available"=>"Available",
			"No Available"=>"No Available",
			"Rented"=>"Rented",
			"Trending"=>"Trending",
			"Sale"=>"Sale"
		];
	}
    
    public function getShippingHelper($key){
        $ar=[
            "0"=>"New",
            "1"=>"AWB Assigned",
            "2"=>"Label Generated",
            "3"=>"Pickup Scheduled/Generated",
            "4"=>"Pickup Queued",
            "5"=>"Manifest Generated",
            "6"=>"Shipped",
            "7"=>"Delivered",
            "8"=>"Cancelled",
            "9"=>"RTO Initiated",
            "10"=>"RTO Delivered",
            "11"=>"Pending",
            "12"=>"Lost",
            "13"=>"Pickup Error",
            "14"=>"RTO Acknowledged",
            "15"=>"Pickup Rescheduled",
            "16"=>"Cancellation Requested",
            "17"=>"Out For Delivery",
            "18"=>"In Transit",
            "19"=>"Out For Pickup",
            "20"=>"Pickup Exception",
            "21"=>"Undelivered",
            "22"=>"Delayed",
            "23"=>"Partial_Delivered",
            "24"=>"Destroyed",
            "25"=>"Damaged",
            "26"=>"Fulfilled",
            "38"=>"Reached at Destination",
            "39"=>"Misrouted",
            "40"=>"RTO NDR",
            "41"=>"RTO OFD",
            "42"=>"Picked Up",
            "43"=>"Self Fulfilled",
            "44"=>"DISPOSED_OFF",
            "45"=>"CANCELLED_BEFORE_DISPATCHED",
            "46"=>"RTO_IN_TRANSIT"
        ];
        if(isset($ar[$key])){
            return $ar[$key];
        }
        return $key;
    }

	public function getInstaFeed(){
	    $token = 'IGQVJXS04tRmlqbHFySnEzeGhDWXZA2VjVUTHRmcXQ5LW1WcHBtOXBfeWtWU1Ywc2R1cEI5Tkc1LTlpdzBNbFZAULVUzcmFkbzg5b0tBZAUNJUFp3Y3ppd01PVFc1N3llVkFQa01rLTlZATVVLb0tGelNwcAZDZD';
        $site = 'https://upgradebicycles.com/test/';
        $url = "https://graph.instagram.com/me/media?fields=username,media_type,media_url,permalink,thumbnail_url,timestamp,caption&access_token=$token";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $request = curl_exec($curl);
        curl_close($curl);
        $request = json_decode($request, true);
        if(isset($request['data'])){
            return $request['data'];
        }
        return [];
	}
	
	public function getSeoUrlGet($title){
		return strtolower(str_replace( array('/', '\\','\'', '"', ',' , ';', '<', '>','&',' ','*','!','@','#','$','%','+',',','.','`','~',':','[',']','{','}','(',')','?'), '-', $title));
	}
	
	public function getTypeOfField(){
		return [
			"select"=>"select",
			"text"=>"text",
			"color"=>"color",
			"date"=>"date",
			"time"=>"time",
			"number"=>"number",
			"textarea"=>"textarea",
		];
	}
	
	public function getGenderData(){
		return[
			"male"=>"male",
			"female"=>"female",
			'unisex'=>"unisex",
			'kids'=>"kids"
		];
	}

	public function getLoginTypeData(){
		return[
			"normal"=>"normal",
			"google"=>"google",
			'facebook'=>"facebook"
		];
	}

	public function getDeviceTypeData(){
		return [
			"ios"=>"ios",
			"A"=>"android"
		];
	}

	public function getBooleanData(){
		return ['0'=>"false","1"=>"true"];
	}

	public function getBooleanDataActual(){
		return ['false'=>"false","true"=>"true"];
	}

	public function getfirstTrueBooleanData(){
		return ["1"=>"true","0"=>"false"];
	}

	public function getCoupanCodeList(){
		return [
			"exact"=>"Exact",
			"percentage"=>"Percentage"
		];
	}

	public function getTempletes(){
		return [
			"home"=>"Home",
			"about"=>"about",
			"common"=>"Common",
			"contact"=>"Contact",
			"blogs"=>"blogs",
			"map"=>"map",
			"reviews"=>"reviews",
			"gallery"=>"gallery",
			"property-list"=>"property-list",
			"attractions"=>"attractions",
			"get-quote"=>"get-quote",
			"faq"=>"FAQ"
		];
	}

	public function getImage($image){
	    if($image!=""){
	        if(is_file(public_path($image))){
	            return $image;
	        }
	    }
	    return 'uploads/no-image.jpg';
	}
    
    public function getWeekNameSelect(){
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];
        return $days;
    }
    
    public function getWeekNameSSelect(){
        $days = [
            'Sunday'=>'Sunday',
            'Monday'=>'Monday',
            'Tuesday'=>'Tuesday',
            'Wednesday'=>'Wednesday',
            'Thursday'=>'Thursday',
            'Friday'=>'Friday',
            'Saturday'=>'Saturday'
        ];
        return $days;
    }
    
	public function send_notification($registatoin_ids, $title,$body,$device_type,$data='dd',$sound='default') {
     	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		$token=$registatoin_ids;
		$f=0;
        if(strtoupper($device_type)=="ANDROID123"){
           $notification = [
                   'title' =>$title,
                   'body' =>$body,
                   "sound" => $sound
               ];
            $extraNotificationData = ["message" => $notification,"moredata" =>$data];
            $f=1;
            $fcmNotification = [
                
                'to'        => $token, //single token
                'notification' => $notification,
                'data' => $extraNotificationData
            ];
        }elseif(strtoupper($device_type)=="IOS123"){
            $f=1;
            $notification = array('title' =>$title , 'body' => $body, 'sound' => $sound, 'badge' => '1');
            $fcmNotification = array('to' => $token, 'notification' => $notification,'priority'=>'high',"data"=>$data);
        }
        $headers = [
            //'Authorization: key=AAAAKBxn96o:APA91bHHmR3ZnrArgtPpOAEWF6iEMx_OfFHtLa6H5BELWX9EI7SkFhEuH4MT0izL8Y_nW6d8On4rAdIGZKmrwoZ2L7mVGVR6eEysbPLjCKPUyOiES87OJR5WnGap0T3NV-MwG9HWZFKZ' ,
              'Authorization: key=AAAArFB060k:APA91bH0OSnyRTBP3jQ_JhMQwvDgw8Qcq41wEw-29RcK1pS9lsKDof8Uui5S8zMtU5P3mf_49J0kU1NgcjNQnVIWTJ9ZhhFuSZk2xTsYZHXCJ1OqH1t1mL6TrVdNx-WEArA6SEnmN8gu',
            'Content-Type: application/json'
        ];
		if($f==1){
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
	        $result = curl_exec($ch);
	        curl_close($ch);
	        return ($result);
		}
    }
}