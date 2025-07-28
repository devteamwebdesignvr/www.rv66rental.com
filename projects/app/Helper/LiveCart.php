<?php 
namespace App\Helper;
use App\Models\IcalEvent;
use App\Models\IcalImportList;
use Auth;
use DB;
use Helper;
use Session;
use ModelHelper;
use App\Models\BookingRequest;

class LiveCart{

    private $title;
    function DifferentDates($start=false,$end=false,$format = 'Y-m-d'){
        $array = array();
        $interval = new \DateInterval('P1D');
        $realEnd = new \DateTime($end);
        $realEnd->add($interval);
        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);
        foreach($period as $date) {
             $array[] = $date->format($format); 
        }
        return $array;
    }
    
    function iCalDataCheckInCheckOut($property_id){
        $data=IcalEvent::where(['event_pid'=>$property_id])->where("end_date",">",date('Y-m-d'))->get();
        $checkin=[];
        $checkout=[];
        foreach($data as $row){
            $todate = date('Y-m-d',strtotime('-1 days',strtotime($row->end_date)));
            $fdate = date('Y-m-d',strtotime('+1 days',strtotime($row->start_date)));
            $checkin = array_merge($checkin,$this->DifferentDates($row->start_date,$todate));
            $checkout = array_merge($checkout,$this->DifferentDates($fdate,$row->end_date));
        }
        $data = BookingRequest::where(["booking_status"=>"booking-confirmed","property_id"=>$property_id])->where("checkout",">",date('Y-m-d'))->get();
        $checkin1=[];
        $checkout1=[];
        foreach($data as $row){
            $todate = date('Y-m-d',strtotime('-1 days',strtotime($row->checkout)));
            $fdate = date('Y-m-d',strtotime('+1 days',strtotime($row->checkin)));
            $checkin = array_merge($checkin,$this->DifferentDates($row->checkin,$todate));
            $checkout = array_merge($checkout,$this->DifferentDates($fdate,$row->checkout));
        }
        sort($checkin);
        sort($checkout);
        return ["checkin"=>$checkin,"checkout"=>$checkout];
    }
    
    function iCalDataCheckInCheckOutCheckinCheckout($property_id){
        $data=IcalEvent::where(['event_pid'=>$property_id])->where("end_date",">",date('Y-m-d'))->get();
        $checkin=[];
        $checkout=[];
        $blocked=[];
        foreach($data as $row){
            $checkin[]=$row->start_date;
            $checkout[]=$row->end_date;
            $todate = date('Y-m-d',strtotime($row->end_date));
            $fdate = date('Y-m-d',strtotime($row->start_date));
            $now = strtotime($row->start_date); 
            $your_date = strtotime($row->end_date);
            $datediff =  $your_date-$now;
            $day= ceil($datediff / (60 * 60 * 24));
            for($i=1;$i<$day;$i++){
                $date = strtotime($row->start_date);
                $date = strtotime("+".$i." day", $date);
                $blocked[]= date('Y-m-d', $date);
            }
        }
        $data = BookingRequest::where(["booking_status"=>"booking-confirmed","property_id"=>$property_id])->where("checkout",">",date('Y-m-d'))->get();
        $checkin1=[];
        $checkout1=[];
        foreach($data as $row){
            $checkin[]=$row->checkin;
            $checkout[]=$row->checkout;
            $todate = date('Y-m-d',strtotime($row->checkout));
            $fdate = date('Y-m-d',strtotime($row->checkin));
            $now = strtotime($row->checkin); 
            $your_date = strtotime($row->checkout);
            $datediff =  $your_date-$now;
            $day= ceil($datediff / (60 * 60 * 24));
            for($i=1;$i<$day;$i++){
                $date = strtotime($row->checkin);
                $date = strtotime("+".$i." day", $date);
                $blocked[]= date('Y-m-d', $date);
            }
        }
        $result = array_intersect($checkin, $checkout);
        $blocked = array_merge($blocked, $result);
        $checkin1=$checkin;
        $checkout1=$checkout;
        foreach($checkin as $key=>$c){
            if(in_array($c,$result)) {
                unset($checkin[$key]);
            }   
        }
        foreach($checkout as $key=>$c){
            if(in_array($c,$result)) {
                unset($checkout[$key]);
            }   
        }
        sort($checkin);
        sort($checkout);
        sort($blocked);
        return ["checkin"=>$checkin,"checkout"=>$checkout,"blocked"=>$blocked];
    }
    
    function refreshIcalData($property_id,$ical_link,$id){
        IcalEvent::where(['ppp_id'=>$property_id,'event_pid'=>$property_id,'ical_link'=>$ical_link])->delete();
        $icals=$this->icsToArray($ical_link);
        foreach($icals as $c){
            $ar=[
                'ppp_id'=>$property_id,
                'ical_link'=>$ical_link,
                'start_date'=>date('Y-m-d',strtotime($c['start_date'])),
                'end_date'=>date('Y-m-d',strtotime($c['end_date'])),
                'text'=>$c['text'],
                'event_pid'=>$property_id,
                'cat_id'=>$id,
                'uid'=>$property_id,
                'event_type'=>"ical",
                'booking_status'=>1
            ];
            $ar1=[
                'ppp_id'=>$property_id,
                'ical_link'=>$ical_link,
                'start_date'=>date('Y-m-d',strtotime($c['start_date'])),
                'end_date'=>date('Y-m-d',strtotime($c['end_date'])),
                'event_pid'=>$property_id,
                'cat_id'=>$id,
            ];
            $da=IcalEvent::where($ar1)->first();
            if($da){
                $da->delete();
            }
            IcalEvent::create($ar);
        }
    }

    function allIcalImportListRefresh(){
        $data=IcalImportList::all();
        foreach($data as $ical_list){
            $this->refreshIcalData($ical_list->property_id,$ical_list->ical_link,$ical_list->id,$ical_list->color);
        }
    }
    
	public function getFileIcalFileData($id){
       $events = BookingRequest::where(["booking_status"=>"booking-confirmed","property_id"=>$id])->get();
       $ICAL_FORMAT ='Ymd\THis\Z';
$icalObject = "BEGIN:VCALENDAR
VERSION:2.0
METHOD:PUBLISH
PRODID:-//Laravel//Webdesignvr//EN\n";
// loop over events
foreach ($events as $event) {
$uid=strtotime("now")."#".$event->id."#saro@".env('APP_URL_WITHOUT_HTTPS','Laravel');
$icalObject .=
"BEGIN:VEVENT
DTSTART:" . date($ICAL_FORMAT, strtotime($event->checkin)) . "
DTEND:" . date($ICAL_FORMAT, strtotime($event->checkout)) . "
DTSTAMP:" . date($ICAL_FORMAT, strtotime($event->created_at)) . "
SUMMARY:$event->name
DESCRIPTION:$event->name
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

   function icsToArray($paramUrl){
        $icsFile = file_get_contents($paramUrl);
        $icsData = $this->getParseString( $icsFile);
        return $icsData;
    }

    function setTitle($t) {
        $this->title = $t;
    }
    
    //get calendar name
    function getTitle() {
        return $this->title;
    }
    
    //returns the string value of the day instead of its ordinal number or return number
    function getConvertDay($i, $mode=false) {
        $a = array ("SU","MO","TU","WE","TH","FR","SA");
        if($mode) {
            for($y=0;$y<sizeof($a);$y++){
                if($a[$y] == $i) {
                    return $y;
                }
            }
        }
        else{
            return $a[$i];  
        }
    }
    
    //returns the appropriate line 
    function getConvertType($i, $mode=false) {
        $a = array ('day' => "DAILY",'week' => "WEEKLY",'month' => "MONTHLY",'year' => "YEARLY");
        if($mode) {
            foreach ($a as $key => $value) {
                if($a[$key] == $i) {
                    return $key;
                }
            }
        }
        else {
            return $a[$i];
        }
    }
    
    //returns the strings value of the days instead of its ordinal numbers
    function getConvertDays($n, $ind=false) {
        $a = explode(",", $n);
        $str = "";
        for($i=0;$i<sizeof($a);$i++) {
            $str .= $this->getConvertDay($a[$i]);
            if($i != sizeof($a)-1) { $str .= ","; }
        }
        return $str;
    }
    
    //get iCal rrule for recurrence events
    function getRrule($events) {
        $mas = explode("#",$events['rec_type']);
        $a = explode("_", $mas[0]);
        $type = "FREQ=".$this->getConvertType($a[0]).";";
        $interval = "INTERVAL=".$a[1].";";
        if($mas[1] != "no") { $count = "COUNT=".$mas[1].";"; } else { $count = ""; }
        $count2 = $a[3];
        if($a[2] != "") { $day = $this->getConvertDay($a[2]); } else { $day = ""; }
        if($a[4] != "") { $days = $this->getConvertDays($a[4]); } else { $days = ""; }
        if($day != "" and $count2 != "") {
            $byday = "BYDAY=".$count2."".$day.";";
        }
        elseif($days != "") {
            $byday = "BYDAY=".$days.";";
        }
        else {
            $byday = "";
        }
        $end_date = $this->getTime($events['end_date']);
        if(substr($end_date, 0, 4) != 9999) { $until = "UNTIL=".$end_date.";"; } else { $until = ""; };
        return $type."".$interval."".$count."".$byday."".$until;
    }
    
    //returns a string of remote events
    function getExdate($id, $h) {
        $a = array();
        $y = 0;
        for($i=0;$i<sizeof($h);$i++) {
            if($id == $h[$i]['event_pid'] and $h[$i]['rec_type'] == "none") {
                $a[$y] = date("Ymd\THis", $h[$i]['event_length']);
                $y++;
            }
        }
        if(sizeof($a) != 0) {
            return implode(",", $a);
        }
        else {
            return 0;
        }
    }
    
    //get date in icalendater format
    function getStartTimeEvent($event) {
        $mas = explode("#",$event['rec_type']);
        $a = explode("_", $mas[0]);     
        switch($a[0]) {
            case "day":
                return $this->getTime($event['start_date']);
                break;
            case "week":
                $diff = explode(",",$a[4]);
                if($diff[0] == 0) { 
                    $n = 7;
                }else {
                    $n = $diff[0];
                }
                $day = date("j", strtotime($event['start_date'])) + $n - 1;
                if($day < 10) { $day = "0".$day; }
                return date("Ym",strtotime($event['start_date']))."".$day."T".date("His",strtotime($event['start_date']));
                break;
            case "month":
            case "year":
                if($a[2] != "" and $a[3] != "") {
                    $diff = $a[2] - date("N", strtotime($event['start_date']));
                    if($diff > 0) { $diff -= 7; }
                    $day = 7*$a[3] + $diff + 1;
                    if($day < 10) { $day = "0".$day; }
                    return date("Ym",strtotime($event['start_date']))."".$day."T".date("His",strtotime($event['start_date']));
                } else {
                    return $this->getTime($event['start_date']);
                }
                break;
        }
    }
    
    function getEndTimeEvent($event) {
        $start_date = strtotime($this->getStartTimeEvent($event));
        return date("Ymd\THis",$start_date+$event['event_length']);
    }
    
    function getTime($date) {
        $mas = explode('-',$date);
        if($mas[0] == 9999) { 
            return "99990201T000000";
        }
        else {
            return date("Ymd\THis",strtotime($date));
        }
    }
    
    //convert the XML string to array
    function simpleParseXML($string) {
        $a = array();
        $xmlobj = simplexml_load_string($string);
        //$start_date = (string)$xmlobj->event[0]->start_date;
        for($i=0;$i<sizeof($xmlobj->event);$i++) {
            $a[$i] = array(
                'event_id' => (string)$xmlobj->event[$i]->attributes(),
                'start_date' => (string)$xmlobj->event[$i]->start_date,
                'end_date' => (string)$xmlobj->event[$i]->end_date,
                'text' => (string)$xmlobj->event[$i]->text,
                'rec_type' => (string)$xmlobj->event[$i]->rec_type,
                'event_pid' => (string)$xmlobj->event[$i]->event_pid,
                'event_length' => (string)$xmlobj->event[$i]->event_length
            );
        }
        return $a;
    }
    
    //convert the information from the array in icalendar format
    function toICal($h) {
        if(is_string($h)) {
            $h = $this->simpleParseXML($h);
        }
        $str = "BEGIN:VCALENDAR\n";
        $str .= "VERSION:2.0\n";
        $str .= "PRODID:-//dhtmlXScheduler//NONSGML v2.2//EN\n";
            $title = $this->getTitle();
                if($title) { $str .= "X-WR-CALNAME:".$title."\n"; }
        for($i=0;$i<sizeof($h);$i++) {
            if($h[$i]['event_pid'] != 0 and $h[$i]['rec_type'] == "") {
                $str .= "BEGIN:VEVENT\n";
                $str .= "DTSTART:".$this->getTime($h[$i]['start_date'])."\n";
                $str .= "DTEND:".$this->getTime($h[$i]['end_date'])."\n";
                $str .= "RECURRENCE-ID:".date("Ymd\THis",$h[$i]['event_length'])."\n";
                $str .= "UID:".$h[$i]['event_pid']."\n";
                $str .= "SUMMARY:".$h[$i]['text']."\n";
                $str .= "END:VEVENT\n";
            }
            elseif($h[$i]['rec_type'] != "" and $h[$i]['event_pid'] == 0) {
                $str .= "BEGIN:VEVENT\n";
                $str .= "DTSTART:".$this->getStartTimeEvent($h[$i])."\n";
                $str .= "DTEND:".$this->getEndTimeEvent($h[$i])."\n";
                $str .= "RRULE:".$this->getRrule($h[$i])."\n";
                    $exdate = $this->getExdate($h[$i]['event_id'], $h);
                        if($exdate != 0) { $str .= "EXDATE:".$exdate."\n"; }
                $str .= "UID:".$h[$i]['event_id']."\n";
                $str .= "SUMMARY:".$h[$i]['text']."\n";
                $str .= "END:VEVENT\n";
            }
            elseif($h[$i]['rec_type'] == "" and $h[$i]['event_pid'] == 0) {
                $str .= "BEGIN:VEVENT\n";
                $str .= "DTSTART:".$this->getTime($h[$i]['start_date'])."\n";
                $str .= "DTEND:".$this->getTime($h[$i]['end_date'])."\n";
                $str .= "UID:".$h[$i]['event_id']."\n";
                $str .= "SUMMARY:".$h[$i]['text']."\n";
                $str .= "END:VEVENT\n";
            }
        }
        $str .= "END:VCALENDAR";    
        return $str;
    }
    
    //give date in ical format and return date in MySQL format
    function getMySQLDate($str) {
        preg_match('/[0-9]{8}[T][0-9]{6}/',trim($str),$date);
        if(isset($date[0])) {
            if($date[0] != "") {
                $y = substr($date[0], 0, 4);
                $mn = substr($date[0], 4, 2);
                $d = substr($date[0], 6, 2);
                $h = substr($date[0], 9, 2);
                $m = substr($date[0], 11, 2);
                $s = substr($date[0], 13, 2);
                return $y."-".$mn."-".$d." ".$h.":".$m.":".$s;
            }
        }
        elseif(strlen(trim($str)) == 8) {
            $y = substr($str, 0, 4);
            $mn = substr($str, 4, 2);
            $d = substr($str, 6, 2);
            return $y."-".$mn."-".$d." 00:00:00";
        }
    }
    
    //get parse a string into an array
    function getParseString($str) {
        $arr_n = array();
        $arr = explode("BEGIN:VEVENT",$str);
        for($x=1;$x<sizeof($arr);$x++) {
            $arr2 = explode("\n",$arr[$x]);
            for($y=1;$y<sizeof($arr2);$y++) {       
                $mas = explode(":",$arr2[$y]);
                $mas_ = explode(";",$mas[0]);
                if(isset($mas_[0])){
                    $mas[0] = $mas_[0];
                }
                switch(trim($mas[0])) {
                    case "DTSTART":
                        $arr_n[$x]['start_date'] = $this->getMySQLDate($mas[1]);
                        break;
                    case "DTEND":
                        $arr_n[$x]['end_date'] = $this->getMySQLDate($mas[1]);
                        break;
                    case "RRULE":
                            $rrule = explode(";", $mas[1]);
                        for($z=0;$z<sizeof($rrule);$z++) {
                            $rrule_n = explode("=", $rrule[$z]);
                            switch($rrule_n[0]) {
                                case "FREQ":
                                    $arr_n[$x]['type'] = $this->getConvertType($rrule_n[1], true);
                                    break;
                                case "INTERVAL":
                                    $arr_n[$x]['count'] = $rrule_n[1];
                                    break;
                                case "COUNT":
                                    $arr_n[$x]['extra'] = $rrule_n[1];
                                    break;
                                case "BYDAY":
                                    $bayday = explode(",",$rrule_n[1]);
                                    if(sizeof($bayday) == 1) {
                                        if(strlen(trim($bayday[0])) == 3) {
                                            $arr_n[$x]['day'] = substr($bayday[0], 0, 1);
                                            $arr_n[$x]['counts'] = $this->getConvertDay(substr($bayday[0], 1, 2), true);
                                        }else {
                                            $arr_n[$x]['days'] = $this->getConvertDay($bayday[0], true);
                                        }
                                    }
                                    else {
                                        $arr_n[$x]['days'] = "";
                                        for($nx=0;$nx<sizeof($bayday);$nx++) {
                                            $arr_n[$x]['days'] .= $this->getConvertDay($bayday[$nx], true);
                                            if($nx != sizeof($bayday)-1) {
                                                $arr_n[$x]['days'] .= ",";
                                            }
                                        }
                                    }
                                    break;
                                case "UNTIL":
                                    $arr_n[$x]['until'] = $this->getMySQLDate($rrule_n[1]);
                                    break;
                            }
                        }
                        break;
                    case "EXDATE":
                        $exdate = explode(",",trim($mas[1]));
                        if(sizeof($exdate) == 1) {
                            $arr_n[$x]['exdate'] = $this->getMySQLDate($exdate[0]);
                        }else {
                            for($nx=0;$nx<sizeof($exdate);$nx++) {
                                $arr_n[$x]['exdate'][$nx] = $this->getMySQLDate($exdate[$nx]);
                            }
                        }
                        break;
                    case "RECURRENCE-ID":   
                        $arr_n[$x]['rec_id'] = $this->getMySQLDate($mas[1]);
                        break;
                    case "UID":
                        $arr_n[$x]['event_id'] = trim($mas[1]);
                        break;
                    case "SUMMARY":
                        $arr_n[$x]['text'] = trim($mas[1]);
                        break;
                }
            }
            if(isset($arr_n[$x]['rec_id'])){
                $arr_n[$x]['event_pid'] = $arr_n[$x]['event_id'];
            }
            if(isset($arr_n[$x]['exdate'])){
                $arr_n[$x]['event_pid'] = $arr_n[$x]['event_id'];
            }
        }
        return $arr_n;
    }
    
    function getNativeStartDate($arr_p) {
        if(isset($arr_p['day']) or isset($arr_p['days'])) {
            $odate = strtotime($arr_p['start_date']);
            switch($arr_p['type']) {
                case "week":
                    $week_day = (date("N",$odate)-1)*60*60*24;
                    $week_start = date("Y-m-d H:i:s", $odate - $week_day);
                    $start_date = $week_start;
                    break;
                case "month":
                case "year":
                    $start_date = date("Y-m", $odate)."-01 ".date("H:i:s", $odate);
                    break;
            }
        }
        else {
            $start_date = $arr_p['start_date'];
        }
        return $start_date;
    }
    
    function getSortArrayById($arr) {
        $id = 1;
        for($x=1;$x<=sizeof($arr);$x++){
            for($y=1;$y<=sizeof($arr);$y++){
                if($arr[$x]['event_id'] == $arr[$y]['event_pid'] and $arr[$x]['event_pid'] == "0" and $arr[$y]['event_pid'] != "0"){
                    if($arr[$y]['rec_type'] == "" or $arr[$y]['rec_type'] == "none") {
                        $arr[$y]['event_pid'] = $id;
                    }
                }
            }
            $arr[$x]['event_id'] = $id;
            $id++;
        }
        return $arr;
    }
    
    //return hashs
    function toHash($str) {
        if(strpos($str, "BEGIN:VCALENDAR") === false) {
            $ctx = stream_context_create(array(
            'http' => array(
            'method' => 'GET',
            'header' => 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko')
            )
            );
            $str = file_get_contents($str,false,$ctx);
        }
        $arr_p = $this->getParseString($str);
        $arr_n = array();
        $id = 1;
        for($i=1;$i<=sizeof($arr_p);$i++) {
            if(isset($arr_p[$i]['rec_id'])){
                $arr_n[$i]['event_id'] = $arr_p[$i]['event_id'];
                $arr_n[$i]['start_date'] = $arr_p[$i]['start_date'];
                $arr_n[$i]['end_date'] = $arr_p[$i]['end_date'];
                $arr_n[$i]['text'] = $arr_p[$i]['text'];
                $arr_n[$i]['rec_type'] = "";
                $arr_n[$i]['event_pid'] = $arr_p[$i]['event_pid'];
                $arr_n[$i]['event_length'] = strtotime($arr_p[$i]['rec_id']);
            }   
            else {
                if(isset($arr_p[$i]['exdate'])){
                    if(sizeof($arr_p[$i]['exdate'])> 1) {
                        for($ni=0;$ni<sizeof($arr_p[$i]['exdate']);$ni++) {
                            $arr_n[sizeof($arr_p)+$id]['event_id'] = $arr_p[$i]['event_id'];
                            $arr_n[sizeof($arr_p)+$id]['start_date'] = $arr_p[$i]['exdate'][$ni];
                            $arr_n[sizeof($arr_p)+$id]['end_date'] = date("Y-m-d H:i:s", strtotime($arr_p[$i]['exdate'][$ni])+(strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date'])));                                        
                            $arr_n[sizeof($arr_p)+$id]['text'] = "";
                            $arr_n[sizeof($arr_p)+$id]['rec_type'] = "none";
                            $arr_n[sizeof($arr_p)+$id]['event_pid'] = $arr_p[$i]['event_pid'];
                            $arr_n[sizeof($arr_p)+$id]['event_length'] = strtotime($arr_p[$i]['exdate'][$ni]);
                            $id++;
                        }
                    }else {
                            $arr_n[sizeof($arr_p)+$id]['event_id'] = $arr_p[$i]['event_id'];
                            $arr_n[sizeof($arr_p)+$id]['start_date'] = $arr_p[$i]['exdate'];
                            $arr_n[sizeof($arr_p)+$id]['end_date'] = date("Y-m-d H:i:s", strtotime($arr_p[$i]['exdate'])+(strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date'])));                                        
                            $arr_n[sizeof($arr_p)+$id]['text'] = "";
                            $arr_n[sizeof($arr_p)+$id]['rec_type'] = "none";
                            $arr_n[sizeof($arr_p)+$id]['event_pid'] = $arr_p[$i]['event_pid'];
                            $arr_n[sizeof($arr_p)+$id]['event_length'] = strtotime($arr_p[$i]['exdate']);
                            $id++;
                    }
                }
                //id
                $arr_n[$i]['event_id'] = $arr_p[$i]['event_id'];
                //start_date
                $arr_n[$i]['start_date'] = $this->getNativeStartDate($arr_p[$i]);
                //rec_type
                isset($arr_p[$i]['type'])? $type = $arr_p[$i]['type'] : $type = "";
                isset($arr_p[$i]['count'])? $count = $arr_p[$i]['count'] : $count = "";
                isset($arr_p[$i]['counts'])? $counts = $arr_p[$i]['counts'] : $counts = "";
                isset($arr_p[$i]['day'])? $day = $arr_p[$i]['day'] : $day = "";
                isset($arr_p[$i]['days'])? $days = $arr_p[$i]['days'] : $days = "";
                isset($arr_p[$i]['extra'])? $extra = $arr_p[$i]['extra'] : $extra = "no";
                if($type != "" and $count == "") {
                    $count = 1;
                }
                if($type != "") {
                    $arr_n[$i]['rec_type'] = $type."_".$count."_".$counts."_".$day."_".$days."#".$extra;
                }else {
                    $arr_n[$i]['rec_type'] = "";
                }
                //end_date
                if(isset($arr_p[$i]['until'])){
                    $arr_n[$i]['end_date'] = $arr_p[$i]['until'];   
                }else {
                    if($arr_n[$i]['rec_type'] == "") {
                        if(isset($arr_p[$i]['end_date'])) {
                            $arr_n[$i]['end_date'] = $arr_p[$i]['end_date'];
                        }else {
                            $arr_n[$i]['end_date'] =  date("Y-m-d H:i:s",strtotime($arr_n[$i]['start_date'])+24*60*60);
                            $arr_p[$i]['end_date'] = $arr_n[$i]['end_date'];
                        }
                    }else {
                        $arr_n[$i]['end_date'] = "9999-02-01 00:00:00"; 
                    }
                }
                //text
                $arr_n[$i]['text'] = $arr_p[$i]['text'];
                //event_pid
                $arr_n[$i]['event_pid'] = "0";
                //event_length
                $arr_n[$i]['event_length'] = strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date']);
            }
        }
        return $this->getSortArrayById($arr_n);
    }
    
    //return XML string
    function toXML($str) {
        if(strpos($str, "BEGIN:VCALENDAR") === false) {
            $str = file_get_contents($str);
        }
        $arr = $this->toHash($str);
        $str = '<?xml version="1.0" encoding="UTF-8"?>';
        $str .= '<data>';
        for($i=1;$i<=sizeof($arr);$i++) {
            $str .= '<event id="'.$arr[$i]['event_id'].'">';
            $str .= '<start_date><![CDATA['.$arr[$i]['start_date'].']]></start_date>';
            $str .= '<end_date><![CDATA['.$arr[$i]['end_date'].']]></end_date>';
            $str .= '<text><![CDATA['.$arr[$i]['text'].']]></text>';
            $str .= '<rec_type><![CDATA['.$arr[$i]['rec_type'].']]></rec_type>';
            $str .= '<event_pid><![CDATA['.$arr[$i]['event_pid'].']]></event_pid>';
            $str .= '<event_length><![CDATA['.$arr[$i]['event_length'].']]></event_length>';
            $str .= '</event>';
        }
        $str .= '</data>';
        return $str;
    }
    
    function toHashnew($str) {
        if(strpos($str, "BEGIN:VCALENDAR") === false) {
            $str = preg_replace("/^http:/i", "https:", $str);
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "$str",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: edf0746d-6412-8902-fb96-a034976710e8"
              ),
            ));
            $str = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
        $arr_p = $this->getParseString($str);
        $arr_n = array();
        $id = 1;
        for($i=1;$i<=sizeof($arr_p);$i++) {
            if(isset($arr_p[$i]['rec_id'])){
                $arr_n[$i]['event_id'] = $arr_p[$i]['event_id'];
                $arr_n[$i]['start_date'] = $arr_p[$i]['start_date'];
                $arr_n[$i]['end_date'] = $arr_p[$i]['end_date'];
                $arr_n[$i]['text'] = $arr_p[$i]['text'];
                $arr_n[$i]['rec_type'] = "";
                $arr_n[$i]['event_pid'] = $arr_p[$i]['event_pid'];
                $arr_n[$i]['event_length'] = strtotime($arr_p[$i]['rec_id']);
            }else {
                if(isset($arr_p[$i]['exdate'])){
                    if(sizeof($arr_p[$i]['exdate'])> 1) {
                        for($ni=0;$ni<sizeof($arr_p[$i]['exdate']);$ni++) {
                            $arr_n[sizeof($arr_p)+$id]['event_id'] = $arr_p[$i]['event_id'];
                            $arr_n[sizeof($arr_p)+$id]['start_date'] = $arr_p[$i]['exdate'][$ni];
                            $arr_n[sizeof($arr_p)+$id]['end_date'] = date("Y-m-d H:i:s", strtotime($arr_p[$i]['exdate'][$ni]) +(strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date'])));                                        
                            $arr_n[sizeof($arr_p)+$id]['text'] = "";
                            $arr_n[sizeof($arr_p)+$id]['rec_type'] = "none";
                            $arr_n[sizeof($arr_p)+$id]['event_pid'] = $arr_p[$i]['event_pid'];
                            $arr_n[sizeof($arr_p)+$id]['event_length'] = strtotime($arr_p[$i]['exdate'][$ni]);
                            $id++;
                        }
                    }else {
                            $arr_n[sizeof($arr_p)+$id]['event_id'] = $arr_p[$i]['event_id'];
                            $arr_n[sizeof($arr_p)+$id]['start_date'] = $arr_p[$i]['exdate'];
                            $arr_n[sizeof($arr_p)+$id]['end_date'] = date("Y-m-d H:i:s", strtotime($arr_p[$i]['exdate']) +(strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date'])));                                        
                            $arr_n[sizeof($arr_p)+$id]['text'] = "";
                            $arr_n[sizeof($arr_p)+$id]['rec_type'] = "none";
                            $arr_n[sizeof($arr_p)+$id]['event_pid'] = $arr_p[$i]['event_pid'];
                            $arr_n[sizeof($arr_p)+$id]['event_length'] = strtotime($arr_p[$i]['exdate']);
                            $id++;
                    }
                }
                //id
                $arr_n[$i]['event_id'] = $arr_p[$i]['event_id'];
                //start_date
                $arr_n[$i]['start_date'] = $this->getNativeStartDate($arr_p[$i]);
                //rec_type
                isset($arr_p[$i]['type'])? $type = $arr_p[$i]['type'] : $type = "";
                isset($arr_p[$i]['count'])? $count = $arr_p[$i]['count'] : $count = "";
                isset($arr_p[$i]['counts'])? $counts = $arr_p[$i]['counts'] : $counts = "";
                isset($arr_p[$i]['day'])? $day = $arr_p[$i]['day'] : $day = "";
                isset($arr_p[$i]['days'])? $days = $arr_p[$i]['days'] : $days = "";
                isset($arr_p[$i]['extra'])? $extra = $arr_p[$i]['extra'] : $extra = "no";
                if($type != "" and $count == "") {
                    $count = 1;
                }
                if($type != "") {
                    $arr_n[$i]['rec_type'] = $type."_".$count."_".$counts."_".$day."_".$days."#".$extra;
                }else {
                    $arr_n[$i]['rec_type'] = "";
                }
                //end_date
                if(isset($arr_p[$i]['until'])){
                    $arr_n[$i]['end_date'] = $arr_p[$i]['until'];   
                }else {
                    if($arr_n[$i]['rec_type'] == "") {
                        if(isset($arr_p[$i]['end_date'])) {
                            $arr_n[$i]['end_date'] = $arr_p[$i]['end_date'];
                        }else {
                            $arr_n[$i]['end_date'] =  date("Y-m-d H:i:s",strtotime($arr_n[$i]['start_date'])+24*60*60);
                            $arr_p[$i]['end_date'] = $arr_n[$i]['end_date'];
                        }
                    }else {
                        $arr_n[$i]['end_date'] = "9999-02-01 00:00:00"; 
                    }
                }
                //text
                $arr_n[$i]['text'] = $arr_p[$i]['text'];
                //event_pid
                $arr_n[$i]['event_pid'] = "0";
                //event_length
                $arr_n[$i]['event_length'] = strtotime($arr_p[$i]['end_date']) - strtotime($arr_p[$i]['start_date']);
            }
        }
        return $arr_n;
    }
}