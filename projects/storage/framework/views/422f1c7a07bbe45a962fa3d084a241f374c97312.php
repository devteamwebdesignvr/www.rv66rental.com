 	<?php $payment_currency= $setting_data['payment_currency'];   ?>
<div class="price" style=" padding: 20px 0; border-top: 1px solid #dddddd;">
    <h2 style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin: 0; margin-bottom: 15px;">Price details</h2>
    <table class="prices" style="border-spacing: 0px; width:100%;">
        <tr class="price-per-night">
            <td style="padding-bottom: 15px;">Price Per Night x <?php echo e($data['total_night']); ?> nights</td>
            <td class="amt" style="text-align: right; padding-bottom: 15px;"><?php echo $payment_currency; ?><?php echo e(number_format($data['gross_amount'],2)); ?></td>
        </tr>
        <?php if($data['rest_guests']): ?>
            <?php if($data['rest_guests']>0): ?>
                <?php if($data['guest_fee']): ?>
                    <?php if($data['guest_fee']>0): ?>
                        <tr class="admin-fee">
                            <td><strong> Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($data['total_night']); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($data['single_guest_fee']); ?> * <?php echo e($data['rest_guests']); ?> Guests)</span></strong></td>
                            <td class="amt" style="text-align: right;"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data['guest_fee'],2)); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($data['total_pets']): ?>
            <?php if($data['total_pets']>0): ?>
                <?php if($data['pet_fee']): ?>
                    <?php if($data['pet_fee']>0): ?>

                <tr class="admin-fee">
                    <td>Pet Fee :</td>
                    <td class="amt" style="text-align: right;"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data['pet_fee'],2)); ?></td>
                </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php $__currentLoopData = json_decode($data['before_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="admin-fee">
                    <td><?php echo e($c->name); ?> :</td>
                    <td class="amt" style="text-align: right;"><?php echo $setting_data['payment_currency']; ?><?php echo e(($c->amount)); ?></td>
                </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($data['custom_before_total_fees']): ?>
            <?php $__currentLoopData = json_decode($data['custom_before_total_fees'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($p['product_amount'])): ?>
                    <tr class="admin-fee">
                        <td><?php echo e($p['product_name']); ?> : </td>
                        <td class="amt" style="text-align: right;"><?php echo $setting_data['payment_currency']; ?><?php echo e(($p['product_amount'])); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php
            $payment_currency=$setting_data['payment_currency'] ;
        ?>
            <?php if(count(json_decode($data['mileage_rate_ids']))>0): ?> 
            <?php endif; ?>
            <?php $__currentLoopData = json_decode($data['mileage_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="admin-fee millage-data">
                    <td><?php echo e($c->milleage_name); ?>

                                            <?php if(isset($c->message)): ?>
                                                <small>( <?php echo e($c->message); ?> )</small>
                                            <?php endif; ?> 
                    </td>
                    <td class="amt" style="text-align: right;"><?php echo $payment_currency; ?><?php echo e(number_format(($c->milleage_rate*$c->value),2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = json_decode($data['option_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="admin-fee">
                    <td><?php echo e($c->option_name); ?>  (<?php echo e($c->value); ?>*<?php echo $payment_currency; ?><?php echo e($c->option_rate); ?>): </td>
                    <td class="amt" style="text-align: right;"><?php echo $payment_currency; ?><?php echo e(number_format(($c->option_rate*$c->value),2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = json_decode($data['accessories_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                <tr class="admin-fee">
                    <td><?php echo e($c->accessories_name); ?> (<?php echo e($c->value); ?>*<?php echo $payment_currency; ?><?php echo e($c->accessories_rate); ?>): </td>
                    <td class="amt" style="text-align: right;"><?php echo $payment_currency; ?><?php echo e(number_format(($c->accessories_rate*$c->value),2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = json_decode($data['after_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr class="admin-fee">
                <td><?php echo e($c->name); ?> :</td>
                <td class="amt" style="text-align: right;"><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($data['tax']): ?>
                <tr class="admin-fee">
                    <td>Tax (<?php echo e($data['define_tax'] ?? ''); ?>%): </td>
                    <td class="amt" style="text-align: right;"><?php echo $payment_currency; ?><?php echo e(number_format($data['tax'],2)); ?></td>
                </tr>
            <?php endif; ?>
   		<tr class="total">
            <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Total :</b></td>
            <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b><?php echo $payment_currency; ?><?php echo e(number_format($data['total_amount'],2)); ?></b></td>
        </tr>
        <?php $gaurav_discount=0;?>
        <?php if($data['discount']): ?>
            <?php if($data['discount']!=""): ?>
                <?php if($data['discount']!=0): ?>
                       <?php $gaurav_discount=1;?> 
              		<tr class="discount">
                        <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Discount (<?php echo e($data['discount_coupon']); ?>) :</b></td>
                        <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>- <?php echo $payment_currency; ?><?php echo e(number_format($data['discount'],2)); ?></b></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($data['extra_discount']): ?>
            <?php if($data['extra_discount']!=""): ?>
                <?php if($data['extra_discount']>0): ?>
                       <?php $gaurav_discount=1;?>
                  <tr class="discount">
                        <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Extra Discount :</b></td>
                        <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>- <?php echo $payment_currency; ?><?php echo e(number_format($data['extra_discount'],2)); ?></b></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if($gaurav_discount==1): ?>
            <tr class="discount">
                <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Total Amount after Discount :</b></td>
                <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b><?php echo $payment_currency; ?><?php echo e(number_format($data['after_discount_total'],2)); ?></b></td>
            </tr>
        <?php endif; ?>
           <?php if($data['amount_data']): ?>
                <?php   $amount_data=json_decode($data['amount_data'],true);  ?>
                <?php if(is_array($amount_data)): ?>
                    <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $status='';?>
                        <?php if(isset($c['status'])): ?>
                            <?php $status='(<span style="color:green;">Paid</span>)'; ?>
                        <?php endif; ?>
                       <tr class="amt-discount">
                            <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b><?php echo e($c['message']); ?> <?php echo $status; ?> :</b></td>
                            <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b><?php echo $payment_currency; ?><?php echo e(number_format($c['amount'],2)); ?></b></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>

    </table>
</div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/mail/booking-common-data.blade.php ENDPATH**/ ?>