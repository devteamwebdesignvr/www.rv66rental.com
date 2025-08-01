<div class="row">
    <input type="hidden" name="booking_type_admin" value="<?php echo e($data->booking_type_admin); ?>"/>
    <div class="col-md-12 ">
        <div class="form-group">
            <?php echo Form::label("RV"); ?>

            <?php echo Form::select("property_id",ModelHelper::getProperptySelectList(),null,["class"=>"form-control","required","placeholder"=>"Choose RV","id"=>"property-selector"]); ?>

            <span class="text-danger"><?php echo e($errors->first("property_id")); ?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("checkin"); ?>

            <?php echo Form::text("checkin",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in","class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("checkin")); ?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("checkout"); ?>

            <?php echo Form::text("checkout",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out","class"=>"form-control lst" ]); ?>

            <span class="text-danger"><?php echo e($errors->first("checkout")); ?></span>
        </div>
    </div>
</div>


<div class="   <?php echo e($data->booking_type_admin!='manual'?'':'d-none'); ?>"  id="gaurav-data-new-logic" >

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("adults"); ?>

            <?php echo Form::selectRange("adults",0,100,null,["class"=>"form-control","required","id"=>"adult_data"]); ?>

            <span class="text-danger"><?php echo e($errors->first("adults")); ?></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("child"); ?>

            <?php echo Form::selectRange("child",0,100,null,["class"=>"form-control","id"=>"child_data"]); ?>

            <span class="text-danger"><?php echo e($errors->first("child")); ?></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("pets"); ?>

            <?php echo Form::selectRange("total_pets",0,100,null,["class"=>"form-control","id"=>"pet_data"]); ?>

            <span class="text-danger"><?php echo e($errors->first("pets")); ?></span>
        </div>
    </div>
    <div class="col-md-3 <?php echo e($data->booking_type_admin!='custom-quote'?'':'d-none'); ?>">
        <div class="form-group">
            <?php echo Form::label("extra_discount"); ?>

            <?php echo Form::number("extra_discount",null,["class"=>"form-control","id"=>"extra-discount"]); ?>

            <span class="text-danger"><?php echo e($errors->first("extra_discount")); ?></span>
        </div>
    </div>
    <div class="col-md-3 <?php echo e($data->booking_type_admin=='custom-quote'?'':'d-none'); ?>">
        <div class="form-group">
            <?php echo Form::label("custom_amount"); ?>

            <?php echo Form::number("custom_amount",$data->total_amount,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("custom_amount")); ?></span>
        </div>
    </div>
</div>
<div class="row   <?php echo e($data->booking_type_admin=='invoice'?'':'d-none'); ?>" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-space-data btn btn-info btn-xs"><i class="fa fa-plus"></i> Add Additional Price</a>
             <hr>
    </div>
</div>
<div class="row gaurav-delete-property <?php echo e($data->booking_type_admin=='invoice'?'':'d-none'); ?>">
     <div class="col-md-2">
        <strong>Action</strong>
    </div>
    <div class="col-md-7">
        <strong>Name</strong>
    </div>
    

    <div class="col-md-3">
        <strong>Amount</strong>
    </div>
  
    
    <div class="col-md-12">
        <br>
    </div>
</div>
<div id="space-area-section" class="<?php echo e($data->booking_type_admin=='invoice'?'':' d-none'); ?>">
    <?php if(isset($data)): ?>
        <?php if($data->custom_before_total_fees): ?>
            <?php
                $products=json_decode($data->custom_before_total_fees,true);
            ?>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($p['product_amount'])): ?>
                        <div class="row gaurav-delete-property-space">
                            <div class="col-md-1">
                                <a href="javascript:;" class="delete-space-data btn btn-danger btn-xs" ><i class="fa fa-times"></i> </a>
                            </div>
                            <div class="col-md-8">
                                <?php echo Form::text("product_name[]",$p['product_name'],["required","class"=>"form-control","placeholder"=>"Name"]); ?>

                            </div>
                            <div class="col-md-3">
                                <?php echo Form::text("product_amount[]",$p['product_amount'],["class"=>"form-control product_amount","placeholder"=>"Amount","required"]); ?>

                            </div>
                            <div class="col-md-12">
                                <br>
                            </div>
                        </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endif; ?>
</div>


<div class="row <?php echo e($data->booking_type_admin=='invoice'?'':'d-none'); ?>" id="pricedata-gaurav">
      <?php
        $start_date=$data->checkin;
        $end_date=$data->checkout;
        $adults=$data->adults;
        $child=$data->child;
        $total_guests=$adults+$child;
        $gross_amount=$data->gross_amount;
        $day=$data->total_night;
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;
        $before_total_fees=[];
        $after_total_fees=[];
         $custom_before_total_fees=[];
        
        
        
        $total_pets=$data->pet_fee_data_guarav;
        
        $pet_fee=0;
        $guest_fee=0;
        $rest_guests=0;
        $single_guest_fee=0;
        $extra_discount=0;
        
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
           

     	<?php if($data->rest_guests): ?>
		    <?php if($data->rest_guests>0): ?>
		        <?php if($data->guest_fee): ?>
		            <?php if($data->guest_fee>0): ?>
		            <tr>
						<td align="left" colspan="4" style="padding: 10px;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($data->total_night); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($data->single_guest_fee); ?> * <?php echo e($data->rest_guests); ?> Guests)</span></strong></td>
						<td align="right" style="padding: 10px; " valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->guest_fee,2)); ?></td>
					</tr>
		            <?php endif; ?>
		        <?php endif; ?>
		    <?php endif; ?>
		<?php endif; ?>
								    
  

			<?php if($data->total_pets): ?>
			    <?php if($data->total_pets>0): ?>
			        <?php if($data->pet_fee): ?>
			            <?php if($data->pet_fee>0): ?>
			            <tr>
							<td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Pet Fee :</strong></td>
							<td align="right" style="padding: 10px; " valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->pet_fee,2)); ?></td>
						</tr>
			            <?php endif; ?>
			        <?php endif; ?>
			    <?php endif; ?>
			<?php endif; ?>
           
           <?php if($data->before_total_fees): ?>   
             <?php $__currentLoopData = json_decode($data->before_total_fees); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?> :</strong></td>
                <td align="right" style="padding: 10px;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($c->amount,2)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

               <?php if($data->custom_before_total_fees): ?>
            <?php
                $products=json_decode($data->custom_before_total_fees,true);
            ?>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($p['product_amount'])): ?>
               
         
                    <tr>
                      <td colspan="4"  align="left"><?php echo e($p['product_name']); ?></td>
                      <td align="right"><?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e($p['product_amount']); ?></td>
                   </tr>
                        <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


            <?php
                $payment_currency=$setting_data['payment_currency'];
            ?>
          
          
                                    <?php if($data['accessories_rate_ids']): ?>
                                    <?php //dd($data['accessories_rate_ids']) ?>
                                    <?php $__currentLoopData = json_decode($data['accessories_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                	<?php //dd(json_decode($data['accessories_rate_ids'])); ?>
                             
                                      <tr>
                                                <th colspan="4">
                                                    <input type="checkbox" checked name="accessories_rate_id[id][<?php echo e($c->id); ?>]" value="<?php echo e($c->id); ?>" class="common-field-show-rate accessories-rate" data-target="accessories_rate_id<?php echo e($c->id); ?>field" >
                                                   <?php if($c->accessories_helping_text=='per night'): ?>
                                                   <input type="hidden" value="<?php echo e($c->value); ?>" name="accessories_rate_id[field][<?php echo e($c->id); ?>]" id="accessories_rate_id<?php echo e($c->id); ?>field" class="  rate-calculateion-data"> 
                                                    <?php echo e($c->accessories_name); ?><sub><?php echo e($c->accessories_helping_text); ?></sub>
                                                  <?php else: ?>
                                                    <input type="text" value="<?php echo e($c->value); ?>" name="accessories_rate_id[field][<?php echo e($c->id); ?>]" id="accessories_rate_id<?php echo e($c->id); ?>field" class="  rate-calculateion-data"> 
                                                    <?php echo e($c->accessories_name); ?><sub><?php echo e($c->accessories_helping_text); ?></sub>
                                                  <?php endif; ?>
                                                </th>
                                                <td align="right">
                                                    <?php echo $payment_currency; ?><?php echo e(number_format(($c->accessories_rate*$c->value),2)); ?>

                                                </td>
                                             </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($data['mileage_rate_ids']): ?>
                                    <?php $__currentLoopData = json_decode($data['mileage_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                   
                                          <tr>
                                            <th colspan="4">
                                                <input type="checkbox" checked name="mileage_rate_id[id][<?php echo e($c->id); ?>]" value="<?php echo e($c->id); ?>" class="common-field-show-rate mileage-rate" data-target="mileage_rate_id<?php echo e($c->id); ?>field" >
                                                <input type="text" value="<?php echo e($c->value); ?>" name="mileage_rate_id[field][<?php echo e($c->id); ?>]" id="mileage_rate_id<?php echo e($c->id); ?>field" class="  rate-calculateion-data"> <?php echo e($c->milleage_name); ?> 
                                            <?php if(isset($c->message)): ?>
                                                <small>( <?php echo e($c->message); ?> )</small>
                                            <?php endif; ?>
                                        
                                            </th>
                                            <td align="right">
                                                <?php echo $payment_currency; ?><?php echo e(number_format(($c->milleage_rate*$c->value),2)); ?>

                                            </td>
                                         </tr>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($data['option_rate_ids']): ?>
                                    <?php $__currentLoopData = json_decode($data['option_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                     
                                          <tr>
                                            <th colspan="4">
                                                <input type="checkbox" name="option_rate_id[id][<?php echo e($c->id); ?>]" checked value="<?php echo e($c->id); ?>" class="common-field-show-rate option-rate" data-target="option_rate_id<?php echo e($c->id); ?>field" >
                                                <input type="text" value="<?php echo e($c->value); ?>" name="option_rate_id[field][<?php echo e($c->id); ?>]" id="option_rate_id<?php echo e($c->id); ?>field" class=" rate-calculateion-data"> <?php echo e($c->option_name); ?>

                                            </th>
                                            <td align="right">
                                              
                                                    <?php echo $payment_currency; ?><?php echo e(number_format(($c->option_rate*$c->value),2)); ?>

                                                
                                            </td>
                                         </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                   
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->sub_amount,2)); ?></td>
                                    </tr>
              
              						 <?php if($data['tax']): ?>
                                        <tr>
                                            <td  align="left" colspan="4" style="padding: 10px;"><strong>Tax (<?php echo e($data['define_tax'] ?? ''); ?>%): </strong></td>
                                            <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($data['tax'],2)); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                     
                                    <?php if($data->after_total_fees): ?>   
                                    <?php $__currentLoopData = json_decode($data->after_total_fees); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?> :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              						<?php endif; ?>					
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->total_amount,2)); ?></td>
                                    </tr>
                        
                                    
                                    	<?php $gaurav_discount=0;?>
							    <?php if($data->discount): ?>
                                    <?php if($data->discount!=""): ?>
                                        <?php if($data->discount!=0): ?>
                                               <?php $gaurav_discount=1;?> 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Discount (<?php echo e($data->discount_coupon); ?>):</strong></td>
                                            <td align="right" style="padding: 10px; " valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->discount,2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
							    <?php if($data->extra_discount): ?>
                                    <?php if($data->extra_discount!=""): ?>
                                        <?php if($data->extra_discount>0): ?>
                                               <?php $gaurav_discount=1;?> 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; " valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->extra_discount,2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
								<?php if($gaurav_discount==1): ?>
								    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; " valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($data->after_discount_total,2)); ?></td>
                                    </tr>
								<?php endif; ?>
              
                               <?php
                                $payments=App\Models\Payment::where(["booking_id"=>$data['id'],"status"=>"complete"])->get();
                            ?>
                                     <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                        <td colspan="4"  align="left"><strong><?php echo e($c->type); ?>-<?php echo e($c->tran_id); ?>  <span class="text-success">(Paid)</span></strong></td>
                                        <td align="right">- <?php echo ModelHelper::getDataFromSetting('payment_currency'); ?><?php echo e(number_format($c->amount,2)); ?></td>
                                   </tr>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php if($data->amount_data): ?>
                                        <?php
                                            $amount_data=json_decode($data->amount_data,true);
                                            //dd($amount_data);  
                                        ?>
                                        <?php if(is_array($amount_data)): ?>
                                            <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $status='';?>
                                                <?php if(isset($c['status'])): ?>
                                                    <?php $status='(<span style="color:green;">Paid</span>)'; ?>
                                                <?php endif; ?>
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong><?php echo e($c['message']); ?> <?php echo $status; ?>:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($c['amount'],2)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

       </table>
            </div>

  
    <input type="hidden" name="accessories_rate_ids" value="<?php echo e($data->accessories_rate_ids); ?>">
    <input type="hidden" name="mileage_rate_ids" value="<?php echo e($data->mileage_rate_ids); ?>">
    <input type="hidden" name="option_rate_ids" value="<?php echo e($data->option_rate_ids); ?>">
    <input type="hidden" name="discount" value="<?php echo e($data->discount); ?>" id="coupon_discount"  />
    <input type="hidden" name="discount_coupon" value="<?php echo e($data->discount_coupon); ?>" id="coupon_discount_code" />
    <input type="hidden" name="after_discount_total" value="<?php echo e($data->remaining_total_amount); ?>" />
    <input type="hidden" name="total_pets" value="<?php echo e($data->total_pets); ?>">
    <input type="hidden" name="pet_fee" value="<?php echo e($data->pet_fee); ?>">
    <input type="hidden" name="guest_fee" value="<?php echo e($data->guest_fee); ?>">
    <input type="hidden" name="rest_guests" value="<?php echo e($data->rest_guests); ?>">
    <input type="hidden" name="single_guest_fee" value="<?php echo e($data->single_guest_fee); ?>">
    <input type="hidden" name="total_payment" value="<?php echo e($data->total_payment); ?>">
    <input type="hidden" name="amount_data" value="<?php echo e(($data->amount_data)); ?>">
    <!--<input type="hidden" name="property_id" value="<?php echo e($data->property_id); ?>"> -->
    <input type="hidden" name="start_date" value="<?php echo e($data->checkin); ?>" >
    <input type="hidden" name="end_date" value="<?php echo e($data->checkout); ?>" >
    <input type="hidden" name="total_guests" value="<?php echo e($data->total_guests); ?>" >
    <input type="hidden" name="adults" value="<?php echo e($data->adults); ?>" >
    <input type="hidden" name="child" value="<?php echo e($data->child); ?>" >
    <input type="hidden" name="gross_amount" value="<?php echo e($data->gross_amount); ?>" >
    <input type="hidden" name="total_night" value="<?php echo e($data->total_night); ?>" >
    <input type="hidden" name="sub_amount" value="<?php echo e($data->sub_amount); ?>" >
    <input type="hidden" name="total_amount" value="<?php echo e($data->total_amount); ?>" >
    <input type="hidden" name="after_total_fees" value="<?php echo e(($data->after_total_fees)); ?>">
    <input type="hidden" name="custom_before_total_fees" value="<?php echo e(($data->custom_before_total_fees)); ?>">
    <input type="hidden" name="before_total_fees" value="<?php echo e(($data->before_total_fees)); ?>">
    <input type="hidden" name="request_id" value="<?php echo e($data->request_id); ?>" >
    <input type="hidden" name="tax" value="<?php echo e($data->tax); ?>" >
    <input type="hidden" name="define_tax" value="<?php echo e($data->define_tax); ?>" >
    <input type="hidden" name="booking_id" value="<?php echo e($data->id); ?>" >
    
    
    
    

</div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("name"); ?>

            <?php echo Form::text("name",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("name")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("mobile"); ?>

            <?php echo Form::text("mobile",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("mobile")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("email"); ?>

            <?php echo Form::email("email",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("email")); ?></span>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("where they are going as destination"); ?>

            <?php echo Form::textarea("where_they_are",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("where_they_are")); ?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("message"); ?>

            <?php echo Form::textarea("message",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("message")); ?></span>
        </div>
    </div>
</div>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/booking-enquiries/edit-form.blade.php ENDPATH**/ ?>