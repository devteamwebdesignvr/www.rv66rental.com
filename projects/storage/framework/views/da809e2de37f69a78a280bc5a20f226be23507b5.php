    <?php
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
  


        $gross_amount=$main_data['gross_amount'];
        $day=$main_data['total_night'];
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;

        $before_total_fees=[];
        $after_total_fees=[];
    ?>
<?php $__currentLoopData = App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); ?>
    <?php if($fee['status']==true): ?>
       

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
      <div class="row">
		    <div class="col-md-9">
		        <?php echo e($fee['name']); ?>

		    </div>
		    <div class="col-md-3">
		       <?php echo $setting_data['payment_currency']; ?> <?php echo e(number_format($fee['amount'],2)); ?>

		    </div>
		</div>
       
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
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/property/ajax-gaurav-modal-service-get-quote.blade.php ENDPATH**/ ?>