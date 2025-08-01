
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>

<?php $__env->startSection("container"); ?>

    <?php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        $payment_currency= $setting_data['payment_currency'];
    ?>
	<!-- start banner sec -->
    

    <section class="page-title" style="background-image: url(<?php echo e($bannerImage); ?>);">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate"><?php echo e($name); ?></h1>
            <div class="checklist">
                <p>
                    <a href="<?php echo e(url('/')); ?>" class="text"><span>Home</span></a>
                    <a class="g-transparent-a"><?php echo e($name); ?></a>
                </p>
            </div>
        </div>
    </section>
    <section class="About-sec payment">
        <div class="container">
            <div class="row">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="left" valign="top" style="border:0px solid; padding:0px;">
                            <h4 style="font-size: 17px; color: #222; font-weight: 600">Hey <?php echo e($booking['name']); ?>,</h4>

                            <p style=" font-size: 15px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 15px 0; text-align: left">Congratulations, Your booking is confirmed. You will receive an email with further details.</p>
                            
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Property Detail </strong></th>
                                    </tr>

                                       <tr>
                                     
                                        <td  align="left" style="padding: 10px;text-align:center;" valign="top" colspan="2" >
                                                <a href="<?php echo e(url('properties/detail/'.$property->seo_url)); ?>" target="_BLANK">
                                                        <img src="<?php echo e(asset($property->feature_image)); ?>" class="img-fluid" style="height:200px;" alt="">
                                               </a> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>Fleet Name :</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top"><strong><?php echo e($property->name); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>


                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Payment Detail </strong></th>
                                </tr>

                                <tr>
                                    <td align="left" style="padding: 10px;" valign="top"><strong>Amount :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e($payment->amount); ?></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding: 10px;" valign="top"><strong>Payment Mode :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top"><?php echo e($payment->type); ?></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding: 10px;" valign="top"><strong>Tran ID :</strong></td>
                                    <td align="left" style="padding: 10px;" valign="top"><?php echo e($payment->tran_id); ?></td>
                                </tr>
                                <?php if($payment->balance_transaction): ?>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>Balance transaction ID:</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top"><?php echo e($payment->balance_transaction); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($payment->receipt_url): ?>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>Receipt:</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top"><a href="<?php echo e($payment->receipt_url); ?>">View Receipt</a></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="4" align="center" style="padding: 10px;" valign="top" class="book"><strong>Booking Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkin :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkout :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top" class="d-none"><strong>Total Guest :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Night :</strong></th>
                                        <th align="right" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><?php echo e($booking['checkin']); ?></td>
                                        <td align="left" style="padding: 10px;" valign="top"><?php echo e($booking['checkout']); ?></td>
                                        <td align="left" style="padding: 10px;" valign="top" class="d-none"><?php echo e($booking['total_guests']); ?> (<?php echo e($booking['adults']); ?> Adults, <?php echo e($booking['child']); ?> Child)</td>
                                        <td align="left" style="padding: 10px;" valign="top"><?php echo e($booking['total_night']); ?></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($booking['gross_amount'],2)); ?></td>
                                    </tr>
                                    	<?php if($booking['rest_guests']): ?>
								    <?php if($booking['rest_guests']>0): ?>
								        <?php if($booking['guest_fee']): ?>
								            <?php if($booking['guest_fee']>0): ?>
								            <tr>
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($booking['total_night']); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($booking['single_guest_fee']); ?> * <?php echo e($booking['rest_guests']); ?> Guests)</span></strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['guest_fee'],2)); ?></td>
            								</tr>
								            <?php endif; ?>
								        <?php endif; ?>
								    <?php endif; ?>
								<?php endif; ?>
								
								
								<?php if($booking['total_pets']): ?>
								    <?php if($booking['total_pets']>0): ?>
								        <?php if($booking['pet_fee']): ?>
								            <?php if($booking['pet_fee']>0): ?>
								            <tr>
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong>Pet Fee :</strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['pet_fee'],2)); ?></td>
            								</tr>
								            <?php endif; ?>
								        <?php endif; ?>
								    <?php endif; ?>
								<?php endif; ?>
								
                                    <?php $__currentLoopData = json_decode($booking['before_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?> :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($booking['custom_before_total_fees']): ?>
                                        <?php $__currentLoopData = json_decode($booking['custom_before_total_fees'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($p['product_amount'])): ?>
                                                <tr>
                                                    <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($p['product_name']); ?> :</strong></td>
                                                    <td align="right" style="padding: 10px; " valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($p['product_amount'],2)); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    
                                    <?php $__currentLoopData = json_decode($booking['accessories_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->accessories_name); ?>:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format(($c->accessories_rate*$c->value),2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = json_decode($booking['mileage_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->milleage_name); ?>

                                            <?php if(isset($c->message)): ?>
                                                <small>( <?php echo e($c->message); ?> )</small>
                                            <?php endif; ?>
                                        :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format(($c->milleage_rate*$c->value),2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = json_decode($booking['option_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->option_name); ?>:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format(($c->option_rate*$c->value),2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              
                                    
                                    <tr style="display:none;">
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($booking['sub_amount'],2)); ?></td>
                                    </tr>
                                    
                                    <?php $__currentLoopData = json_decode($booking['after_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?> :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php if($booking['tax']): ?>
                             
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Tax (<?php echo e($booking['define_tax'] ?? ''); ?>%): :</strong></td>
                                            <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($booking['tax'],2)); ?></td>
                                        </tr>
                                  
                                    <?php endif; ?>
                                    
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($booking['total_amount'],2)); ?></td>
                                    </tr>
                                    
                                           	<?php $gaurav_discount=0;?>
							    <?php if($booking['discount']): ?>
                                    <?php if($booking['discount']!=""): ?>
                                        <?php if($booking['discount']!=0): ?>
                                               <?php $gaurav_discount=1;?> 
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Discount (<?php echo e($booking['discount_coupon']); ?>):</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['discount'],2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
							    <?php if($booking['extra_discount']): ?>
                                    <?php if($booking['extra_discount']!=""): ?>
                                        <?php if($booking['extra_discount']>0): ?>
                                               <?php $gaurav_discount=1;?> 
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['extra_discount'],2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
								<?php if($gaurav_discount==1): ?>
								    <tr>
                                        <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['after_discount_total'],2)); ?></td>
                                    </tr>
								<?php endif; ?>
                                    
                                     <?php if($booking['amount_data']): ?>
                                        <?php
                                            $amount_data=json_decode($booking['amount_data'],true);
                                        ?>
                                        <?php if(is_array($amount_data)): ?>
                                            <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $status='';?>
                                                <?php if(isset($c['status'])): ?>
                                                    <?php $status='(<span style="color:green;">Paid</span>)'; ?>
                                                <?php endif; ?>
                                            <tr>
                                                <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c['message']); ?> <?php echo $status; ?>:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c['amount'],2)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("css"); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/booking/payment/first-preview.blade.php ENDPATH**/ ?>