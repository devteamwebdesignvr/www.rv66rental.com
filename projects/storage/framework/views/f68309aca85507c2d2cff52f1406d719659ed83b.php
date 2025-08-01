<div class="row no-gutters">
		    <?php
		    

    function getSinglePropertyRate($date,$property){
            $rate=App\Models\PropertyRate::where(["property_id"=>$property->id,"single_date"=>$date])->orderBy("id","desc")->first();
            if($rate){
                $price=$rate->price;
            }else{
                $price=$property->standard_rate;
            }
            return round($price);
    }
    
    function getcolorData($date,$property){
        $data=App\Models\IcalEvent::whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date)->where("event_pid",$property->id)->first();
        if($data){
            return $data->color;
        }
        return 'red';
    }
    
		        $property=App\Models\Property::Find(Request::get("id"));
		    ?>
		    <?php if($property): ?>
		    <?php
                $new_data_blocked=LiveCart::iCalDataCheckInCheckOut(Request::get("id"));
                $checkin=$new_data_blocked['checkin'];
                $checkout=$new_data_blocked['checkout'];
                $payment_currency= $setting_data['payment_currency'];
                function getWeekday($date1) {
                    return date('w', strtotime($date1));
                }
                $date=date('d-m-Y');
                $current_date=date('d');

                $current_month=date('m',strtotime($date));
                $current_month_name=date('F',strtotime($date));
                $current_year=date('Y',strtotime($date));
                
                
                $current_last_date=date('t',strtotime($date));
                $current_no_of_days= cal_days_in_month(CAL_GREGORIAN,$current_month, $current_year);
                
                $current_day_name=getWeekday(date('01-'.$current_month.'-'.$current_year));
                
                //dd($date);
                if(Request::get("date")){
                    $date=date('01-m-Y',strtotime(Request::get("date")));
                }
                
                if(Request::get("operation")){
                    if(Request::get("operation")=="minus"){
                        $date=date('01-m-Y',strtotime('-1 month',strtotime($date)));
                    }if(Request::get("operation")=="plus"){
                        $date=date('01-m-Y',strtotime('+1 month',strtotime($date)));
                    }else{
                        $date=date('01-m-Y',strtotime($date));
                    }
                }
                
                
                $first_date=date('d',strtotime($date));
                $first_month=date('m',strtotime($date));
                $first_month_name=date('F',strtotime($date));
                $first_year=date('Y',strtotime($date));
                
                
                $first_last_date=date('t',strtotime($date));
                $first_no_of_days= cal_days_in_month(CAL_GREGORIAN,$first_month, $first_year);
                
                $first_day_name=getWeekday(date('01-'.$first_month.'-'.$first_year));
                
                
                $second_month=date('m',strtotime('+1 month',strtotime($date)));
                $second_month_name=date('F',strtotime('+1 month',strtotime($date)));
                $second_year=date('Y',strtotime('+1 month',strtotime($date)));
                
                
                $second_last_date=date('t',strtotime('+1 month',strtotime($date)));
                $second_no_of_days= cal_days_in_month(CAL_GREGORIAN,$second_month, $second_year);
                
                $second_day_name=getWeekday(date('01-'.$second_month.'-'.$second_year));
                
                ?>
			<div class="col-md-6">
				<div class="calendar calendar-first" id="calendar_first">
					<div class="calendar_header">
					    <?php if($current_month.''.$current_year!=$first_month.''.$first_year  ): ?>
						<button class="switch-month switch-left"  data-date="<?php echo e($date); ?>">
						<i class="fa fa-chevron-left"></i>
						</button>
						<?php endif; ?>
						<h2><?php echo e($first_month_name); ?> <?php echo e($first_year); ?></h2>
						<button class="switch-month switch-right">
						<i class="fa fa-chevron-right"></i>
						</button>
					</div>
					<div class="calendar_weekdays">
					    <div>Sun</div>
						<div>Mon</div>
						<div>Tue</div>
						<div>Wed</div>
						<div>Thu</div>
						<div>Fri</div>
						<div>Sat</div>
					
					</div>
					<div class="calendar_content">
					    <?php $k=0; ?>
					    <?php for($i=0;$i<$first_day_name;$i++): ?>
						<div class="blank"></div>
						<?php $k++; ?>
						<?php endfor; ?>
						<?php for($i=1;$i<=$first_no_of_days;$i++): ?>
						   <?php
						   $class="";
						   
						   if($current_month.''.$current_year==$first_month.''.$first_year){
						        if((int)$current_date>$i){
						            $class="disabled-date";
						            $price='';
						        }else{
						            
                                    $i1=$i<10?'0'.$i:$i;
                                    $new_date=$first_year.'-'.$first_month.'-'.$i1;
                                    $price='<span>'.$payment_currency.''.getSinglePropertyRate($new_date,$property).'</span>';
                                     if(in_array($new_date,$checkin)){
                                        $class.=" check-out-blocked ".getcolorData($new_date,$property);
                                    }
                                    if(in_array($new_date,$checkout)){
                                        $class.=" check-in-blocked ".getcolorData($new_date,$property);
                                    }
						         
						        }
						   }else{
						         
						        $i1=$i<10?'0'.$i:$i;
                                $new_date=$first_year.'-'.$first_month.'-'.$i1;
                                $price='<span>'.$payment_currency.''.getSinglePropertyRate($new_date,$property).'</span>';
                                 if(in_array($new_date,$checkin)){
                                    $class.=" check-out-blocked ".getcolorData($new_date,$property);
                                }
                                if(in_array($new_date,$checkout)){
                                    $class.=" check-in-blocked ".getcolorData($new_date,$property);
                                }
						   }
						   
						   if($current_date.''.$current_month.''.$current_year==$i.''.$first_month.''.$first_year){
						        $class='current-date';
						        
						        
						        $i1=$i<10?'0'.$i:$i;
						        $new_date=$first_year.'-'.$first_month.'-'.$i1;
						         $price='<span>'.$payment_currency.''.getSinglePropertyRate($new_date,$property).'</span>';
						   }
						   ?>
						    <div class="<?php echo e($class); ?>"><?php echo e($i); ?> <?php echo $price; ?></div>
						<?php $k++; ?>
						<?php endfor; ?>
						
						<?php for($i=$k;$i<42;$i++): ?>
						<div class="blank"></div>
						<?php endfor; ?>
				
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="calendar calendar-second" id="calendar_second">
					<div class="calendar_header">
						<button class="switch-month switch-left">
						<i class="fa fa-chevron-left"></i>
						</button>
						<h2><?php echo e($second_month_name); ?> <?php echo e($second_year); ?></h2>
						<button class="switch-month switch-right" data-date="<?php echo e($date); ?>">
						<i class="fa fa-chevron-right"></i>
						</button>
					</div>
					<div class="calendar_weekdays">
						<div>Sun</div>
						<div>Mon</div>
						<div>Tue</div>
						<div>Wed</div>
						<div>Thu</div>
						<div>Fri</div>
						<div>Sat</div>
						
					</div>
					<div class="calendar_content">
					 <?php $k=0; ?>
						<?php for($i=0;$i<$second_day_name;$i++): ?>
						<div class="blank"></div>
						<?php $k++; ?>
						<?php endfor; ?>
						<?php for($i=1;$i<=$second_no_of_days;$i++): ?>
						    <?php
						        $class='';
						        $i1=$i<10?'0'.$i:$i;
                                $new_date=$second_year.'-'.$second_month.'-'.$i1;
                                $price='<span>'.$payment_currency.''.getSinglePropertyRate($new_date,$property).'</span>';
                                if(in_array($new_date,$checkin)){
                                    $class.=" check-out-blocked ".getcolorData($new_date,$property);
                                }
                                if(in_array($new_date,$checkout)){
                                    $class.=" check-in-blocked ".getcolorData($new_date,$property);
                                }
						    ?>
						<div  class="<?php echo e($class); ?>"><?php echo e($i); ?>  <?php echo $price; ?></div>
						<?php $k++; ?>
						<?php endfor; ?>
						
						<?php for($i=$k;$i<42;$i++): ?>
						<div class="blank"></div>
						
						<?php endfor; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/common-dates.blade.php ENDPATH**/ ?>