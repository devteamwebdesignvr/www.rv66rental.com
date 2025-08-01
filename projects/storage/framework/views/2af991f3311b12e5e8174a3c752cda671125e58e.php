
   <?php
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
        $adults=$main_data["adults"];
        $child=$main_data["child"];
        $total_guests=$adults+$child;
        $gross_amount=$main_data['gross_amount'];
        $day=$main_data['total_night'];
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;
        $before_total_fees=[];
        $after_total_fees=[];
        
        
        
        $total_guests=$main_data["adults"]+$main_data["childs"];
        $total_pets=$main_data['pet_fee_data_guarav'];
        
        $pet_fee=0;
        $guest_fee=0;
        $rest_guests=0;
        $single_guest_fee=0;
         $tax=0;
          $define_tax=$property->tax;
    ?>
      <div class="container">
           <div class="row">
              <div class="col-md-12 text-center">
                  <a href="<?php echo e(url('properties/detail/'.$property->seo_url)); ?>" class="img-anc">
                        <div class="image-sec">
                            <img src="<?php echo e(asset($property->feature_image)); ?>" class="img-fluid" style="height:200px;" alt="">
                        </div>
     
                   </a> 
                  <h2><?php echo e($property->name ?? ''); ?> : Booking Quote</h2>
                   
              </div>
            </div>
            <div class="table-box">
            <table class="table table-bordered">
            <tr>
              <th>Check IN</th>
              <th>Check Out</th>
              <th class="d-none">Total Guests</th>
              <th>Total Nights</th>
              <th>Gross Amount</th>
           </tr>
            <tr>
              <td><?php echo e(date('F jS, Y',strtotime($start_date))); ?></td>
              <td><?php echo e(date('F jS, Y',strtotime($end_date))); ?></td>
              <td class="d-none"><?php echo e($total_guests); ?> Guests   (<?php echo e($adults); ?> Adults , <?php echo e($child); ?> Child)</td>
              <td><?php echo e($day); ?></td>
              <td  align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($gross_amount,2)); ?></td>
           </tr>
           
          <?php if($property->guest_fee): ?>
    <?php if($property->guest_fee>0): ?>
        <?php if($property->no_of_guest): ?>
            <?php if($property->no_of_guest<$total_guests): ?>
            
                <?php $single_guest_fee=$property->guest_fee; ?>
                <?php $rest_guests=$total_guests-$property->no_of_guest; ?>
                <?php $guest_fee=$single_guest_fee*$day*$rest_guests;   ?>
                <?php 
                $sub_total+=$guest_fee;$total_amount+=$guest_fee; 
                ?>

        
          <tr>
                      <td colspan="3"  align="left">Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($day); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($single_guest_fee); ?> * <?php echo e($rest_guests); ?> Guests)</span></td>
                      <td align="right"> <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($guest_fee,2)); ?></td>
                   </tr>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if($property->pet_fee): ?>
    <?php if($property->pet_fee>0): ?>
        <?php if($total_pets>0): ?>
         <?php 
        if($property->pet_fee_interval=="per_pet")
        {
            $pet_fee=$property->pet_fee*$total_pets;
        }else{
            $pet_fee=$property->pet_fee;
        }
         
                $sub_total+=$pet_fee;$total_amount+=$pet_fee; 
                ?>
         
                
                <tr>
                      <td colspan="3"  align="left"> Pet Fee</td>
                      <td align="right"> <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($pet_fee,2)); ?></td>
                   </tr>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?> 
           
           <?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); ?>
                <?php if($fee['status']==true): ?>
                    <tr>
                      <td colspan="3"  align="left"><?php echo e($fee['name']); ?></td>
                      <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($fee['amount'],2)); ?></td>
                   </tr>
                    <?php 

                        $sub_total+=$fee['amount'];$total_amount+=$fee['amount']; 
                        $before_total_fees[]=[
                            "name"=>$fee['name'],
                            "amount"=>$fee['amount'],
                            "fee_name"=>$c->fee_name,
                            "fee_rate"=>$c->fee_rate,
                            "fee_type"=>$c->fee_type,
                            "fee_apply"=>$c->fee_apply,
                            "fee_status"=>$c->fee_status
                        ];
                    ?>
                <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </table>
               <form  id="web-form-data">
                  <table class="table table-bordered">
                  <?php $ids=[];
                    if((Request::get("mileage_rate_id"))){

                        if(isset(Request::get("mileage_rate_id")['id'])){
                            $ids=Request::get("mileage_rate_id")['id'];
                        }

                    }
                    $fields=[];
                    if((Request::get("mileage_rate_id"))){

                        if(isset(Request::get("mileage_rate_id")['field'])){
                            $fields=Request::get("mileage_rate_id")['field'];
                        }

                    }
                 //dd($fields,Request::get("mileage_rate_id")); 
                 ?>
            <?php
                $listData=App\Models\PropertyMillageRate::where(["property_id"=>$property->id,"milleage_status"=>"active"])->get();
            ?>
            <?php if(count($listData)>0): ?>
                <tr>
                    <th colspan="3">
                        <p><strong>Add additional Mileage.</strong></p>
                    </th>
                    <td align="right"></td>
                </tr>
                 <?php $__currentLoopData = $listData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php

                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=1;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->milleage_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                           
                        }
                         // $message_data_new=preg_replace("/{DYNAMIC-DATA}/", $c->milleage_free*$day ,$c->milleage_format);
                          
                          
                          
                            if($c->milleage_format=="millage"){
                                $total_free_miles=$c->milleage_free*$day;
                                $total_paid_miles=$value_1;
                                $total_miles=$total_free_miles+$total_paid_miles;
                                if($total_paid_miles>0){
                                    $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                                }else{
                                    $paid_message='';
                                }
                                $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                                
                            }else{
                                 $total_free_hours=$c->milleage_free*$day;
                                $total_paid_hours=$value_1;
                                $total_hours=$total_free_hours+$total_paid_hours;
                                if($total_paid_hours>0){
                                    $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                                }else{
                                    $paid_message='';
                                }
                                $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                            }
            
                    ?>
                 <tr>
                    <th colspan="3">
                        <input type="checkbox" <?php echo e(in_array($c->id,$ids)?'checked':''); ?> name="mileage_rate_id[id][<?php echo e($c->id); ?>]" value="<?php echo e($c->id); ?>" class="common-field-show-rate mileage-rate" data-target="mileage_rate_id<?php echo e($c->id); ?>field" >
                        <input type="text" value="<?php echo e($value_1); ?>" name="mileage_rate_id[field][<?php echo e($c->id); ?>]" id="mileage_rate_id<?php echo e($c->id); ?>field" class="<?php echo e(in_array($c->id,$ids)?'':'d-none'); ?>  rate-calculateion-data"> <?php echo e($c->milleage_name); ?>   <small>( <?php echo e($message_data_new); ?> )</small>
                    </th>
                    <td align="right">
                         <?php if(isset($abc_amount)): ?>
                            <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($abc_amount,2)); ?>

                        <?php endif; ?>
                    </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>


            <?php
                $listData=App\Models\PropertyExtraOptionRate::where(["property_id"=>$property->id,"option_status"=>"active"])->get();
            ?>
            <?php if(count($listData)>0): ?>



                <tr>
                    <th colspan="3">
                        <p><strong>Extra Option</strong><br>
                            
                        </p>
                    </th>
                    <td align="right">
                     
                    </td>
                </tr>
                 <?php $ids=[];
                    if((Request::get("option_rate_id"))){

                        if(isset(Request::get("option_rate_id")['id'])){
                            $ids=Request::get("option_rate_id")['id'];
                        }

                    }
                    $fields=[];
                    if((Request::get("option_rate_id"))){

                        if(isset(Request::get("option_rate_id")['field'])){
                            $fields=Request::get("option_rate_id")['field'];
                        }

                    }
                 //dd($fields,Request::get("option_rate_id")); 
                 ?>

                 <?php $__currentLoopData = $listData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=1;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->option_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
                    ?>
                 <tr>
                    <th colspan="3">
                        <input type="checkbox" name="option_rate_id[id][<?php echo e($c->id); ?>]" <?php echo e(in_array($c->id,$ids)?'checked':''); ?> value="<?php echo e($c->id); ?>" class="common-field-show-rate1 option-rate" data-target="option_rate_id<?php echo e($c->id); ?>field" >
                        <!--<?php echo Form::selectRange("name",1,5,null,["class"=>"option"]); ?>-->
                        <input type="text" value="<?php echo e($value_1); ?>" name="option_rate_id[field][<?php echo e($c->id); ?>]" id="option_rate_id<?php echo e($c->id); ?>field" class="d-none rate-calculateion-data">
                        <?php echo e($c->option_name); ?>

                    </th>
                    <td align="right">
                        <?php if(isset($abc_amount)): ?>
                            <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($abc_amount,2)); ?>

                        <?php endif; ?>
                    </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>
             
  <?php $ids=[];
                    if((Request::get("accessories_rate_id"))){

                        if(isset(Request::get("accessories_rate_id")['id'])){
                            $ids=Request::get("accessories_rate_id")['id'];
                        }

                    }
                    $fields=[];
                    if((Request::get("accessories_rate_id"))){

                        if(isset(Request::get("accessories_rate_id")['field'])){
                            $fields=Request::get("accessories_rate_id")['field'];
                        }

                    }
                 //dd($fields,Request::get("accessories_rate_id")); 
                 ?>
            <?php
                $listData=App\Models\PropertyAccessoriesRate::where(["property_id"=>$property->id,"accessories_status"=>"active"])->get();
            ?>
            <?php if(count($listData)>0): ?>
                <tr>
                    <th colspan="3">
                        <p><strong>Rv Rental Accessories</strong><br>
                           
                        </p>
                    </th>
                    <td align="right"></td>
                </tr>
                 <?php $__currentLoopData = $listData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=1;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->accessories_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
                        $d_none_class=in_array($c->id,$ids)?'':'d-none';
                        $type="per_person";
                        if($c->accessories_type=="per stay"){
                            $type="per_stay";
                            $d_none_class='d-none';
                        }
                        if($c->accessories_type=="per night"){
                            $type="per_night";
                            $d_none_class='d-none';
                        }



                    ?>
                 <tr>
                    <th colspan="3">
                        <input type="checkbox" <?php echo e(in_array($c->id,$ids)?'checked':''); ?> name="accessories_rate_id[id][<?php echo e($c->id); ?>]" value="<?php echo e($c->id); ?>" class="common-field-show-rate-demo accessories-rate-<?php echo e($type); ?>" data-target="accessories_rate_id<?php echo e($c->id); ?>field" >


                  
                        <input type="text" value="<?php echo e($value_1); ?>" name="accessories_rate_id[field][<?php echo e($c->id); ?>]" id="accessories_rate_id<?php echo e($c->id); ?>field" class="<?php echo e($d_none_class); ?>  rate-calculateion-data">


                        <?php echo e($c->accessories_name); ?><sub><?php echo e($c->accessories_helping_text); ?></sub>
                    </th>
                    <td align="right">
                        <?php if(isset($abc_amount)): ?>
                            <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($abc_amount,2)); ?>

                        <?php endif; ?>
                    </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>


        
           <?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  $fee=Helper::getFeeAmountAndName($c,$sub_total); ?>
                <?php if($fee['status']==true): ?>
                    <tr >
                      <td colspan="3"  align="left"><?php echo e($fee['name']); ?></td>
                      <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($fee['amount'],2)); ?></td>
                   </tr>
                    <?php $total_amount+=$fee['amount'];
                    $after_total_fees[]=[
                            "name"=>$fee['name'],
                            "amount"=>$fee['amount'],
                            "fee_name"=>$c->fee_name,
                            "fee_rate"=>$c->fee_rate,
                            "fee_type"=>$c->fee_type,
                            "fee_apply"=>$c->fee_apply,
                            "fee_status"=>$c->fee_status
                        ];
                     ?>
                <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php if($define_tax): ?>
  
    
             <?php
                    $tax=round(($total_amount*$define_tax)/100,2);
                    $total_amount+=$tax; 
                    
                ?>
             
                    <tr>
                      <td colspan="3"  align="left"> Tax </td>
                      <td align="right"><?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($tax,2)); ?></td>
                   </tr>

            <?php endif; ?>
            <tr>
                <td colspan="3"  align="left"><strong>Total</strong></td>
                <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($total_amount,2)); ?></td>
           </tr>
           


               <?php
                    
                        $apply_button_name="Apply";
                        $apply=0;
                        $discount=0;
                        $error=0;
                        if(Request::get("coupon")){
                                $coupon=App\Models\Coupon::where(["code"=>Request::get("coupon"),"property_id"=>$property->id])->whereDate("start_date","<=",$start_date)->whereDate("end_date",">=",$end_date)->first();
                          
                            if($coupon){
                            
                                if($coupon->type=="excat"){
                                    if($gross_amount<$coupon->amount){
                                        $error=1;
                                    }else{
                                        $apply=1;
                                        $discount=$coupon->amount;
                                        $apply_button_name="Applied";
                                    }
                                }else{
                                    if($coupon->amount>100){
                                     $error=1;
                                    }else{
                                        $apply=1;
                                        $discount=($gross_amount*$coupon->amount)/100;
                                        $apply_button_name="Applied";
                                    }
                                }
                            }else{
                                $error=1;
                            }
                        }
                    ?>

  
            <tr>
                <td colspan="3"  align="left">
                    <strong><input type="checkbox" <?php echo e($apply==1?'disabled':''); ?> name="is_coupon" id="is_coupon" /> Do you have coupon code?</strong>
                    
                </td>
                <td align="right"></td>
           </tr>
            <tr  id="coupon-form" style="display:none;">
                <td colspan="3"  align="left">
              
                   
                        <?php if(Request::get("coupon")): ?>
                        <input type="text" style="" value="<?php echo e(Request::get('coupon')); ?>">
                        <?php else: ?>
                        <input type="text" name="coupon" style="" value="<?php echo e(Request::get('coupon')); ?>" 
                        placeholder="Enter Coupon Code" />
                        <?php endif; ?>
                        <button type="submit" <?php echo e($apply==1?'disabled':''); ?> class="btn-success btn-25 <?php echo e($apply==1?'d-none':''); ?>" ><span><?php echo e($apply_button_name); ?></span></button>
                        <?php if($apply==0): ?>
                            <?php $__currentLoopData = Request::except(["coupon","mileage_rate_id","option_rate_id","accessories_rate_id"]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c_gaurav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($c_gaurav); ?>" />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                     
          
                     <?php if($apply==1): ?>
              
                       
                        
                            <?php $__currentLoopData = Request::except(["coupon","mileage_rate_id","option_rate_id","accessories_rate_id"]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c_gaurav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($c_gaurav); ?>" />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                        <button type="submit"  class="btn btn-danger" > <i class="fa fa-times"></i> Remove</button>
                    
                       
                        <?php if($apply==1): ?>
                        <div class="text-success">Coupon code applied successfully</div>
                        <?php endif; ?>
                    <?php endif; ?>
                     <?php if($error==1): ?>
                            <div class="text-danger">Invalid Coupon</div>
                        <?php endif; ?>
                </td>
                <td align="right"><?php if($apply==1): ?> <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?> <?php echo e(number_format($discount,2)); ?> <?php endif; ?></td>
           </tr>

           </form>
       </table>
         <table class="table table-bordered">
           <?php $remaining_total_amount=$total_amount-$discount; ?>
            <?php if($apply==1): ?>
                  <tr>
                        <td colspan="3"  align="left"><strong>Total Amount after Discount</strong></td>
                        <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($remaining_total_amount,2)); ?></td>
                   </tr>
            <?php endif; ?>

<?php
$days=Helper::calculateDays(date('Y-m-d'),$start_date);


$payment_interval=ModelHelper::getDataFromSetting("payment_interval");
if($payment_interval){
}else{
    $payment_interval=1;
}
//dd($payment_interval,$days);
$total_payment=$payment_interval;
$amount_data=[];
if($payment_interval==1){
        $first_amount=$remaining_total_amount;

        $first_message="Total Amount to be Paid";
        $total_payment=1;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
}
elseif($payment_interval==2){

     $second_days=ModelHelper::getDataFromSetting('second_min_total_days');

    if($days>=$second_days){

        $second_per=ModelHelper::getDataFromSetting('second_payment_per');

        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount;

        $second_days=ModelHelper::getDataFromSetting('second_how_many_days');
        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));


        $first_message="Initial Deposit to be Paid";
        $second_message="Final Remaining Amount Due on ".$second_date;
   
        $total_payment=2;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 

    }else{
        $first_amount=$remaining_total_amount;

        $first_message="Total Amount to be Paid";
        $total_payment=1;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
    } 
}
elseif($payment_interval==3){
    $second_days=ModelHelper::getDataFromSetting('second_min_total_days');
    $third_days=ModelHelper::getDataFromSetting('third_min_total_days');

    if($days>=$third_days){

        $second_per=ModelHelper::getDataFromSetting('second_third_payment_per');
        $third_per=ModelHelper::getDataFromSetting('third_payment_per');


        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $third_amount=round(($remaining_total_amount*$third_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount-$third_amount;


        $second_days=ModelHelper::getDataFromSetting('second_third_how_many_days');
        $third_days=ModelHelper::getDataFromSetting('third_how_many_days');

        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));
        $third_date=date('F jS, Y',strtotime('- '.$third_days.' days',strtotime($start_date)));
        $total_payment=3;
        $first_message="Initial Deposit to be Paid";
        $second_message="Second Remaining Amount Due on ".$second_date;
        $third_message="Final Remaining Amount Due on ".$third_date;

        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 
        $amount_data[]=["amount"=>$third_amount,"type"=>"third","message"=>$third_message]; 

    }elseif($days>=$second_days){

        $second_per=ModelHelper::getDataFromSetting('second_payment_per');

        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount;

        $second_days=ModelHelper::getDataFromSetting('second_how_many_days');
        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));


        $first_message="Initial Deposit to be Paid";
        $second_message="Final Remaining Amount Due on ".$second_date;
   
        $total_payment=2;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 

    }else{
        $first_amount=$remaining_total_amount;
        $total_payment=1;
        $first_message="Total Amount to be Paid";

        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
    }   
}
?>
        <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="3"  align="left"><strong><?php echo e($c['message']); ?></strong></td>
                <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($c['amount'],2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       </table>
            </div>
            
          

       <?php echo Form::open(["url"=>"save-booking-data","class"=>"","id"=>"save-booking-data"]); ?>

             <?php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('accessories_rate_id')){
            if(isset(Request::get('accessories_rate_id')['id'])){
                $ids=array_keys(Request::get('accessories_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyAccessoriesRate::where("id",$id_one)->first();
            if($pay_assco){
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "accessories_name"=>$pay_assco->accessories_name,
                    "accessories_helping_text"=>$pay_assco->accessories_helping_text,
                    "accessories_rate"=>$pay_assco->accessories_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('accessories_rate_id')['field'][$id_one]

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       ?>
       <input type="hidden" name="accessories_rate_ids" value="<?php echo e(json_encode($ar_new_data_web)); ?>">
              <?php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('mileage_rate_id')){
            if(isset(Request::get('mileage_rate_id')['id'])){
                $ids=array_keys(Request::get('mileage_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyMillageRate::where("id",$id_one)->first();
            if($pay_assco){
             if($pay_assco->milleage_format=="millage"){
                    $total_free_miles=$pay_assco->milleage_free*$day;
                    $total_paid_miles=Request::get('mileage_rate_id')['field'][$id_one];
                    $total_miles=$total_free_miles+$total_paid_miles;
                    if($total_paid_miles>0){
                        $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                    
                }else{
                     $total_free_hours=$pay_assco->milleage_free*$day;
                    $total_paid_hours=Request::get('mileage_rate_id')['field'][$id_one];
                    $total_hours=$total_free_hours+$total_paid_hours;
                    if($total_paid_hours>0){
                        $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                }
            
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "milleage_name"=>$pay_assco->milleage_name,
              
                    "milleage_rate"=>$pay_assco->milleage_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('mileage_rate_id')['field'][$id_one],
                     "message"=>$message_data_new

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
          if(count($ids)<=0){
        //$property->id
            foreach(App\Models\PropertyMillageRate::where("property_id",$property->id)->get() as $pay_assco){
                if($pay_assco->milleage_format=="millage"){
                    $total_free_miles=$pay_assco->milleage_free*$day;
                    $total_paid_miles=0;
                    $total_miles=$total_free_miles+$total_paid_miles;
                    if($total_paid_miles>0){
                        $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                    
                }else{
                     $total_free_hours=$pay_assco->milleage_free*$day;
                    $total_paid_hours=0;
                    $total_hours=$total_free_hours+$total_paid_hours;
                    if($total_paid_hours>0){
                        $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                }
            
                 
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "milleage_name"=>$pay_assco->milleage_name,
              
                    "milleage_rate"=>$pay_assco->milleage_rate,
                    'id'=>$pay_assco->id,
                    "value"=>0,
                     "message"=>$message_data_new

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       ?>
       <input type="hidden" name="mileage_rate_ids" value="<?php echo e(json_encode($ar_new_data_web)); ?>">
              <?php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('option_rate_id')){
            if(isset(Request::get('option_rate_id')['id'])){
                $ids=array_keys(Request::get('option_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyExtraOptionRate::where("id",$id_one)->first();
            if($pay_assco){
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "option_name"=>$pay_assco->option_name,
              
                    "option_rate"=>$pay_assco->option_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('option_rate_id')['field'][$id_one]

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       ?>
       <input type="hidden" name="option_rate_ids" value="<?php echo e(json_encode($ar_new_data_web)); ?>">
       
      <input type="hidden" name="discount" value="<?php echo e($discount); ?>" />
      <input type="hidden" name="discount_coupon" value="<?php echo e(Request::get('coupon')); ?>" />
      <input type="hidden" name="after_discount_total" value="<?php echo e($remaining_total_amount); ?>" />
      
  
        
        <input type="hidden" name="total_pets" value="<?php echo e($total_pets); ?>">
        
        <input type="hidden" name="pet_fee" value="<?php echo e($pet_fee); ?>">
        
        <input type="hidden" name="guest_fee" value="<?php echo e($guest_fee); ?>">
        
        <input type="hidden" name="rest_guests" value="<?php echo e($rest_guests); ?>">
        
        <input type="hidden" name="single_guest_fee" value="<?php echo e($single_guest_fee); ?>">
        
        
        <input type="hidden" name="total_payment" value="<?php echo e($total_payment); ?>">
        <input type="hidden" name="amount_data" value="<?php echo e(json_encode($amount_data)); ?>">
        <input type="hidden" name="property_id" value="<?php echo e($property->id); ?>">
        <input type="hidden" name="checkin" value="<?php echo e($start_date); ?>" >
        <input type="hidden" name="checkout" value="<?php echo e($end_date); ?>" >
        <input type="hidden" name="total_guests" value="<?php echo e($total_guests); ?>" >
        <input type="hidden" name="adults" value="<?php echo e($adults); ?>" >
        <input type="hidden" name="child" value="<?php echo e($child); ?>" >
        <input type="hidden" name="gross_amount" value="<?php echo e($gross_amount); ?>" >
        <input type="hidden" name="total_night" value="<?php echo e($day); ?>" >
        <input type="hidden" name="sub_amount" value="<?php echo e($sub_total); ?>" >
        <input type="hidden" name="total_amount" value="<?php echo e($total_amount); ?>" >
        <input type="hidden" name="after_total_fees" value="<?php echo e(json_encode($after_total_fees)); ?>">
        <input type="hidden" name="before_total_fees" value="<?php echo e(json_encode($before_total_fees)); ?>">
        <input type="hidden" name="request_id" value="<?php echo e(uniqid()); ?>" >
        <input type="hidden" name="tax" value="<?php echo e($tax); ?>" >

        <input type="hidden" name="define_tax" value="<?php echo e($define_tax); ?>" >
        <div class="row">
            <h3>*Check the box to acknowledge</h3>
            <?php
                $location=App\Models\Location::find($property->location_id);
            ?>
            <?php if($location): ?>
                <?php if($location->amount): ?>
             <div class="col-md-12 certify">
                <input type="checkbox" name="refund" required="">
                <label for="refund"> A refundable $<?php echo e($location->amount); ?> security deposit is due 2 days prior to departure</label>
            </div>
                <?php endif; ?>
            <?php endif; ?>
                 <div class="col-md-12 certify">
                <input type="checkbox" name="addt" required="">
                <label for="addt"> Please verify that you will be on time for pick up at 2 pm or additional fees apply.</label>
                </div>
                 <div class="col-md-12 certify">
                <input type="checkbox" name="addt" required="">
                <label for="addt"> Please verify that you will be on time to drop off at 9 am or additional fees apply.</label>
                </div>
                 <div class="col-md-12 certify">
                <input type="checkbox" name="cancl" required="">
                <label for="cancl"> Do you agree to the terms of the cancellation policy? NO EXCEPTIONS. There are no refunds (all fees collected) if the cancellation is made 30 days or less prior to the departure date. For cancellation made 31 days or more, the cancellation must be in writing and is a 50% refund of money collected plus a $99 processing fees and taxes. NO REFUND FOR EARLY RETURNS.</label>
                </div>
            <h3>*Age Requirement Confirmation</h3>
             <div class="col-md-12 certify">
                <input type="checkbox" name="certify" required="">
                <label for="certify"> I certify that I’m at least 25 years old at the time of rental and I have a valid drivers license.</label>
                </div>
                <?php if($location): ?>
            <h3>*Insurance</h3>
             <div class="col-md-12 certify">
           
                <label for="certify"> <?php echo e($location->shortDescription); ?></label>
                </div>
                <?php endif; ?>
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("name"); ?>

                            <?php echo Form::text("name",null,["class"=>"form-control","required","placeholder"=>"Enter Name"]); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("email"); ?>

                            <?php echo Form::email("email",null,["class"=>"form-control","required","placeholder"=>"Enter email"]); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("mobile"); ?>

                            <?php echo Form::text("mobile",null,["class"=>"form-control","placeholder"=>"Enter mobile"]); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("where they are going as destination"); ?>

                            <?php echo Form::textarea("where_they_are",null,["class"=>"form-control","placeholder"=>"Enter where they are going as destination","rows"=>"2"]); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("message"); ?>

                            <?php echo Form::textarea("message",null,["class"=>"form-control","placeholder"=>"Enter message","rows"=>"2"]); ?>

                        </div>
                    </div>
                    
                    
                </div>
                <div class="row text-center mt-4 bttn">
                    <div class="">
                        <div class="form-group">
                            <button type="submit" class=" btn-success btn-25" name="operation" value="send-quote"><span>Submit Request</span></button>
                        </div>
                    </div>
                    <?php if($property->instant_booking_button=="true"): ?>
                    <div class="">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class=" btn-success btn-25 pay" name="operation" value="direct-booking"><span>Pay Now</span></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
       <?php echo Form::close(); ?>

       </div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/ajax/get-quote.blade.php ENDPATH**/ ?>