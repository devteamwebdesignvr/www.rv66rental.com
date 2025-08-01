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
        $custom_before_total_fees=[];
        $pet_fee=0;
        $guest_fee=0;
        $rest_guests=0;
        $single_guest_fee=0;
        $extra_discount=0;
          $tax=0;
          $define_tax=$property->tax;
         // dd($define_tax);
    ?>

            <div class="col-md-12">
            <table class="table table-bordered">
            <tr>
              <th>Check IN</th>
              <th>Check Out</th>
              <th>Total Guests</th>
              <th>Total Nights</th>
              <th   align="right" style="text-align: right !important;">Gross Amount</th>
           </tr>
            <tr>
              <td><?php echo e(date('F jS, Y',strtotime($start_date))); ?></td>
              <td><?php echo e(date('F jS, Y',strtotime($end_date))); ?></td>
              <td><?php echo e($total_guests); ?> Guests   (<?php echo e($adults); ?> Adults , <?php echo e($child); ?> Child)</td>
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
                      <td colspan="4"  align="left">Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($day); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($single_guest_fee); ?> * <?php echo e($rest_guests); ?> Guests)</span></td>
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
                      <td colspan="4"  align="left"> Pet Fee</td>
                      <td align="right"> <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($pet_fee,2)); ?></td>
                   </tr>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?> 
           
           <?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); ?>
                <?php if($fee['status']==true): ?>
                    <tr>
                      <td colspan="4"  align="left"><?php echo e($fee['name']); ?></td>
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
              <?php if(Request::get("product_amount")): ?>
           <?php $__currentLoopData = Request::get("product_amount"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               
                <?php if($c): ?>
                    <tr>
                      <td colspan="4"  align="left"><?php echo e(Request::get("product_name")[$key]); ?></td>
                      <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($c,2)); ?></td>
                   </tr>
                    <?php 
                       // dd($c);
                        $sub_total+=$c;$total_amount+=$c; 
                        $custom_before_total_fees[]=[
                            "product_name"=>Request::get("product_name")[$key],
                            "product_amount"=>$c
                          
                        ];
                    ?>
                <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
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
               // dd($fields,Request::get("mileage_rate_id")); 
                 ?>
            <?php
                $listData=App\Models\PropertyMillageRate::where(["property_id"=>$property->id,"milleage_status"=>"active"])->get();
                //dd($listData);
            ?>
            <?php if(count($listData)>0): ?>
                <tr>
                    <th colspan="4">
                        <p><strong>ADDITIONAL MILEAGE ADD ON CALCULATOR</strong><br>
                            Pick RV you are renting by checking the box and adding additional mileage.
                        </p>
                    </th>
                    <td align="right"></td>
                </tr>
                 <?php $__currentLoopData = $listData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php

                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=0;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->milleage_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
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
                    <th colspan="4">
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
                    <th colspan="4">
                        <p><strong>RV RENTAL ACCESSORIES</strong><br>
                           
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
                    ?>
                 <tr>
                    <th colspan="4">
                        <input type="checkbox" <?php echo e(in_array($c->id,$ids)?'checked':''); ?> name="accessories_rate_id[id][<?php echo e($c->id); ?>]" value="<?php echo e($c->id); ?>" class="common-field-show-rate accessories-rate" data-target="accessories_rate_id<?php echo e($c->id); ?>field" >
                        <input type="text" value="<?php echo e($value_1); ?>" name="accessories_rate_id[field][<?php echo e($c->id); ?>]" id="accessories_rate_id<?php echo e($c->id); ?>field" class="<?php echo e(in_array($c->id,$ids)?'':'d-none'); ?>  rate-calculateion-data"> <?php echo e($c->accessories_name); ?><sub><?php echo e($c->accessories_helping_text); ?></sub>
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
                    <th colspan="4">
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
                    <th colspan="4">
                        <input type="checkbox" name="option_rate_id[id][<?php echo e($c->id); ?>]" <?php echo e(in_array($c->id,$ids)?'checked':''); ?> value="<?php echo e($c->id); ?>" class="common-field-show-rate option-rate" data-target="option_rate_id<?php echo e($c->id); ?>field" >
                        <input type="text" value="<?php echo e($value_1); ?>" name="option_rate_id[field][<?php echo e($c->id); ?>]" id="option_rate_id<?php echo e($c->id); ?>field" class="<?php echo e(in_array($c->id,$ids)?'':'d-none'); ?> rate-calculateion-data"> <?php echo e($c->option_name); ?>

                    </th>
                    <td align="right">
                        <?php if(isset($abc_amount)): ?>
                            <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($abc_amount,2)); ?>

                        <?php endif; ?>
                    </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>
      
           <?php if($sub_total!=$gross_amount): ?>
               <?php if(App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->count()>0): ?>
               <tr>
                    <td colspan="4"  align="left"><strong>Sub total</strong></td>
                    <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($sub_total,2)); ?></td>
               </tr>
               <?php endif; ?>
           <?php endif; ?>
          
           <?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  $fee=Helper::getFeeAmountAndName($c,$sub_total); ?>
                <?php if($fee['status']==true): ?>
                    <tr>
                      <td colspan="4"  align="left"><?php echo e($fee['name']); ?></td>
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
                      <td colspan="4"  align="left"> Tax (<?php echo e($define_tax); ?>%)</td>
                      <td align="right"><?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($tax,2)); ?></td>
                   </tr>

         
            <?php endif; ?>
            <tr >
                <td colspan="4"  align="left"><strong>Total</strong></td>
                <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($total_amount,2)); ?></td>
           </tr>
                 <?php
                    
                        $apply_button_name="Apply";
                        $apply=0;
                        $discount=0;
                        $error=0;
                        if(Request::get("coupon")){
                            $coupon=App\Models\Coupon::where(["property_id"=>Request::get("property_id"),"code"=>Request::get("coupon")])->first();
                          
                            if($coupon){
                            
                                if($coupon->type=="excat"){
                                    if($total_amount<$coupon->amount){
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
                                        $discount=($total_amount*$coupon->amount)/100;
                                        $apply_button_name="Applied";
                                    }
                                }
                            }else{
                                $error=1;
                            }
                        }
                    ?>
       
           <?php
           
           $remaining_total_amount=$total_amount;
           //dd($main_data['extra_discount']);
           if($main_data['extra_discount']){
               if($main_data['extra_discount']!=""){
                    if($main_data['extra_discount']>0){
                        if($main_data['extra_discount']<$gross_amount  ){
                            $extra_discount=$main_data['extra_discount'];
                            $remaining_total_amount=$remaining_total_amount-$extra_discount;
                            $apply=1;
                        }
                    }
               }
           }
           
           $remaining_total_amount=$remaining_total_amount-$discount; ?>
           <?php if($extra_discount>0): ?>
                 <tr>
                        <td colspan="4"  align="left"><strong>Extra Discount  </strong></td>
                        <td align="right">-<?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($extra_discount,2)); ?></td>
                   </tr>
           <?php endif; ?>
            <?php if($apply==1): ?>
                  <tr>
                        <td colspan="4"  align="left"><strong>Total Amount after Discount</strong></td>
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
                <td colspan="4"  align="left"><strong><?php echo e($c['message']); ?></strong></td>
                <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($c['amount'],2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       </table>
            </div>

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
         if(count($ids)>0){
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
        <input type="hidden" name="start_date" value="<?php echo e($start_date); ?>" >
        <input type="hidden" name="end_date" value="<?php echo e($end_date); ?>" >
        <input type="hidden" name="total_guests" value="<?php echo e($total_guests); ?>" >
        <input type="hidden" name="adults" value="<?php echo e($adults); ?>" >
        <input type="hidden" name="child" value="<?php echo e($child); ?>" >
        <input type="hidden" name="gross_amount" value="<?php echo e($gross_amount); ?>" >
        <input type="hidden" name="total_night" value="<?php echo e($day); ?>" >
        <input type="hidden" name="sub_amount" value="<?php echo e($sub_total); ?>" >
        <input type="hidden" name="total_amount" value="<?php echo e($total_amount); ?>" >
        <input type="hidden" name="after_total_fees" value="<?php echo e(json_encode($after_total_fees)); ?>">
        <input type="hidden" name="before_total_fees" value="<?php echo e(json_encode($before_total_fees)); ?>">
        <input type="hidden" name="custom_before_total_fees" value="<?php echo e(json_encode($custom_before_total_fees)); ?>">
        <input type="hidden" name="request_id" value="<?php echo e(uniqid()); ?>" >
     <input type="hidden" name="tax" value="<?php echo e($tax); ?>" >

        <input type="hidden" name="define_tax" value="<?php echo e($define_tax); ?>" ><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/common/get-quote.blade.php ENDPATH**/ ?>