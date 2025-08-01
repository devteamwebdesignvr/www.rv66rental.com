    <?php
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
  


        $gross_amount=$main_data['gross_amount'];
        $day=$main_data['total_night'];
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;
        $pet_fee=0;
        $guest_fee=0;
        $before_total_fees=[];
        $after_total_fees=[];
        
        $total_guests=$main_data["adults"]+$main_data["childs"];
        $total_pets=$main_data['pet_fee_data_guarav'];
        
    ?>

<div class="row">
    <div class="col-md-6">
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#myModal"><?php echo e($day); ?> nights</a>
    </div>
    <div class="col-md-6">
       <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($gross_amount,2)); ?>

    </div>
    <hr>
</div>
<?php if($property->guest_fee): ?>
    <?php if($property->guest_fee>0): ?>
        <?php if($property->no_of_guest): ?>
            <?php if($property->no_of_guest<$total_guests): ?>
                <?php $rest_guests=$total_guests-$property->no_of_guest; ?>
                <?php $guest_fee=$property->guest_fee*$day*$rest_guests; ?>
                <?php 
                $sub_total+=$guest_fee;$total_amount+=$guest_fee; 
                ?>
       <div class="row">
            <div class="col-md-6">
                Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($day); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($property->guest_fee); ?> * <?php echo e($rest_guests); ?> Guests)</span>
            </div>
            <div class="col-md-6">
               <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($guest_fee,2)); ?>

            </div>
            <hr>
        </div>
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
                
                
                  <div class="row">
                    <div class="col-md-6">
                        Pet Fee
                    </div>
                    <div class="col-md-6">
                       <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($pet_fee,2)); ?>

                    </div>
                    <hr>
                </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); ?>
    <?php if($fee['status']==true): ?>
       

       <div class="row">
            <div class="col-md-6">
                <?php echo e($fee['name']); ?>

            </div>
            <div class="col-md-6">
               <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($fee['amount'],2)); ?>

            </div>
            <hr>
        </div>
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
<?php $service_fee=0; ?>
<?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php  $fee=Helper::getFeeAmountAndName($c,$sub_total); ?>
    <?php if($fee['status']==true): ?>
      
       
        <?php $total_amount+=$fee['amount']; $service_fee+=$fee['amount'];
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
         <div class="row">
         
    <div class="col-md-6">
        <?php echo e($fee['name']); ?>

    </div>
    <div class="col-md-6">
       <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($fee['amount'],2)); ?>

    </div>
        <hr>
</div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php

  $define_tax=$property->tax;

  ?>
   <?php if($define_tax): ?>
  
    
             <?php
                    $tax=round(($total_amount*$define_tax)/100,2);
                    $total_amount+=$tax; 
                    
                ?>
             
                   <div class="row">
    <div class="col-md-6"> Tax  </div>
    <div class="col-md-6"><?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($tax,2)); ?>  </div>
</div>

            <?php endif; ?>
<div class="row">
    <div class="col-md-6">
        Total 
    </div>
    <div class="col-md-6">
       <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($total_amount,2)); ?>

    </div>
</div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/property/ajax-gaurav-data-get-quote.blade.php ENDPATH**/ ?>