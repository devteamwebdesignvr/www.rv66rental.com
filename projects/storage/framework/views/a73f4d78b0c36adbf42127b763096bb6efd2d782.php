<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="Active Booking Enquiries";$route="booking-enquiries";
?>             
<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e($name); ?> Management</h1>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php 
            $addbar=["name"=>$name,"add-data"=>true,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create')];
          ?>
          <?php echo $__env->make("admin.common.add-bar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card  ">
            <div class="card-header">
              <h3 class="card-title"><?php echo e($name); ?> Listing</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data-table-gaurav" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> #</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Booking-id</th>
                        <th>Property</th>
                        <th>Customer</th>
                        <th>Guests</th>
                        <th>Nights</th>
                        <th>Amount</th>
                        <th>Request of Date</th>
                        <th>Booking Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            $sno=1; 
                            $payment_currency=ModelHelper::getDataFromSetting('payment_currency');
                        ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($sno++); ?></td>
                            <td><?php echo e(date("F jS, Y",strtotime($client->checkin))); ?></td>
                            <td><?php echo e(date("F jS, Y",strtotime($client->checkout))); ?></td>
                            <!--<td><a href='<?php echo route($route.'.admin-confirmed', [$client->id]); ?>'><?php echo e($client->id); ?></a></td>  -->
                            <td><?php echo e($client->id); ?></td> 
                            <td><?php echo e(App\Models\Property::find($client->property_id)->name ?? $client->property_id); ?></td>
                            <td>
                                <?php echo e($client->name); ?>

                                <br>
                                <?php echo e($client->email); ?>

                            </td>
                            <td><?php echo e($client->total_guests); ?></td>
                            <td><?php echo e($client->total_night); ?></td>
                            <td><?php if($client->booking_type_admin!="manual"): ?> <?php echo $payment_currency; ?><?php echo e($client->total_amount); ?> <?php endif; ?></td>
                            <td><?php echo e(date("F jS, Y",strtotime($client->created_at))); ?></td>
                            <td>
                           <?php echo Helper::getBookingStatus($client->booking_status,$client->id); ?></td>
                            <td>  
                            <?php if($client->booking_type_admin!="manual"): ?>
                                <div class="btn-group btn-group-sm"><a href="#" class="btn btn-info">Status</a>
                                  <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item <?php echo e($client->rental_aggrement_status=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Rental  <?php echo Helper::checkStatus($client->rental_aggrement_status); ?></a>
                                    <a class="dropdown-item " href="javascript:;" >Payment  (<?php echo $client->payment_status; ?>)</a>
                                    <a class="dropdown-item <?php echo e($client->welcome_email=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Welcome  <?php echo Helper::checkStatus($client->welcome_email); ?></a>
                                    <a class="dropdown-item <?php echo e($client->review_email=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Review  <?php echo Helper::checkStatus($client->review_email); ?></a>
                                    <a class="dropdown-item <?php echo e($client->reminder_email=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Reminder  <?php echo Helper::checkStatus($client->reminder_email); ?></a>
                                    <a class="dropdown-item <?php echo e($client->checkin_email=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Checkin  <?php echo Helper::checkStatus($client->checkin_email); ?></a>
                                    <a class="dropdown-item <?php echo e($client->checkout_email=='true'?'text-success':'text-danger'); ?>" href="javascript:;" >Checkout  <?php echo Helper::checkStatus($client->checkout_email); ?></a>
                                  </div>
                                </div>
                                <?php else: ?> <button type="button" class="btn btn-info "> Manual Booking </button> <?php endif; ?>
                            
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-outline-primary btn-sm raw-margin-right-8" data-toggle="modal" data-target="#myModal<?php echo e($client->id); ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if($client->booking_status!='booking-cancel'): ?>
                               
                                        <a href="<?php echo route($route.'.edit', [$client->id]); ?>" class="btn btn-outline-success btn-sm raw-margin-right-8"><i
                                        class="fa fa-pencil-alt"></i> </a>
                                        <?php if($client->status_data=="active"): ?>
                                        <a href="<?php echo route($route.'.deactive', [$client->id]); ?>" class="btn btn-outline-info btn-sm raw-margin-right-8"><i
                                        class="fa fa-pencil-alt"></i> Deactive</a>
                                        <?php else: ?>
                                        
                                        <a href="<?php echo route($route.'.active', [$client->id]); ?>" class="btn btn-outline-info btn-sm raw-margin-right-8"><i
                                        class="fa fa-pencil-alt"></i> Active</a>
                                        <?php endif; ?>
                        
                                    
                                    <?php if($client->booking_status=='booking-confirmed'): ?>
                                        <form method="post" action="<?php echo route($route.'.destroy', [$client->id]); ?>"
                                              style="display: inline-block;">
                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit" class="btn btn-outline-danger btn-sm raw-margin-right-8"
                                                    onclick="return confirm('Are you sure you want to cancel this <?php echo e($name); ?>?')"> 
                                                    Cancel Booking
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                <?php else: ?>
                                  <?php if($client->status_data=="active"): ?>
                                        <a href="<?php echo route($route.'.deactive', [$client->id]); ?>" class="btn btn-outline-info btn-sm raw-margin-right-8"><i
                                        class="fa fa-pencil-alt"></i> Deactive</a>
                                        <?php else: ?>
                                        
                                        <a href="<?php echo route($route.'.active', [$client->id]); ?>" class="btn btn-outline-info btn-sm raw-margin-right-8"><i
                                        class="fa fa-pencil-alt"></i> Active</a>
                                        <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<?php $data123=$data; ?>
    <?php $__currentLoopData = $data123; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- The Modal -->
        <div class="modal" id="myModal<?php echo e($client->id); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Booking Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
              <!-- Modal body -->
                <div class="modal-body">
                    <?php
                        $data=$client->toArray();
                        $property=App\Models\Property::find($client->property_id);
                    ?>
                    <table class="table table-bordered" >
                        <tbody>
                            <tr>
                                <th colspan="4" ><strong>Property Detail </strong></th>
                            </tr>
                            <tr>
                                <th>Request ID</th>
                                <td><?php echo e($data['request_id']); ?></td>
                           
                                <th>Booking Date</th>
                                <td><?php echo e(date("F jS, Y",strtotime($data['created_at']))); ?></td>
                            </tr>
                            <tr>
                                <th>Booking Status</th>
                                <td>
                                    <?php echo Helper::getBookingStatus($client->booking_status,$client->id); ?>

                                </td>
                                <td ><strong>Property Name :</strong></td>
        
                                <td ><?php echo e($property->name ?? $client->property_id); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3">Rental Aggrement</th>
                                <th><?php echo e($data['rental_aggrement_status']); ?></th>
                            </tr>
                            <?php if($data['rental_aggrement_status']=="true"): ?>
                            <tr>
                                <th>Sign</th>
                                <td><img src="<?php echo e(asset($data['rental_aggrement_signature'])); ?>" style="width: 100px;" /></td>
                                <th>Image</th>
                                <td><img src="<?php echo e(asset($data['rental_aggrement_images'])); ?>" style="width: 100px;" /></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th colspan="4" ><strong>User Detail </strong></th>
                            </tr>
                            <tr>
                                <td ><strong>Name :</strong></td>
                                <td ><?php echo e($data['name']); ?></td>
                           
                                <td ><strong>Email :</strong></td>
                                <td ><?php echo e($data['email']); ?></td>
                            </tr>
                            <tr>
                                <td ><strong>Mobile:</strong></td>
                                <td ><?php echo e($data['mobile']); ?></td>
                          
                                <td ><strong>Message :</strong></td>
                                <td >
                                    <pre><?php echo e($data['message']); ?></pre>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Where they are going as destination</strong></td>
                                <td colspan="3">
                                    <pre><?php echo e($data['where_they_are']); ?></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" >
                        <tbody>
                            <tr>
                                <th colspan="5" ><strong>Booking Detail </strong></th>
                            </tr>
                            <tr>
                                <th ><strong>Checkin :</strong></th>
                                <th ><strong>Checkout :</strong></th>
                                <th ><strong>Total Guest :</strong></th>
                                <th ><strong>Total Night :</strong></th>
                                <td ><strong>Gross Amount :</strong></td>
                            </tr>
                            <tr>
                                <td ><?php echo e($data['checkin']); ?></td>
                                <td ><?php echo e($data['checkout']); ?></td>
                                <td ><?php echo e($data['total_guests']); ?> (<?php echo e($data['adults']); ?> Adults, <?php echo e($data['child']); ?> Child)</td>
                                <td ><?php echo e($data['total_night']); ?></td>
                                <td ><?php echo $payment_currency; ?><?php echo e(number_format($data['gross_amount'],2)); ?></td>
                            </tr>
        					<?php if($data['rest_guests']): ?>
        					    <?php if($data['rest_guests']>0): ?>
        					        <?php if($data['guest_fee']): ?>
        					            <?php if($data['guest_fee']>0): ?>
        					            <tr>
        									<td colspan="4" ><strong> Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($data['total_night']); ?> nights * <?php echo $payment_currency; ?><?php echo e($data['single_guest_fee']); ?> * <?php echo e($data['rest_guests']); ?> Guests)</span></strong></td>
        									<td><?php echo $payment_currency; ?><?php echo e(number_format($data['guest_fee'],2)); ?></td>
        								</tr>
        					            <?php endif; ?>
        					        <?php endif; ?>
        					    <?php endif; ?>
        					<?php endif; ?>
        					<?php if($data['total_pets']): ?>
        					    <?php if($data['total_pets']>0): ?>
        					        <?php if($data['pet_fee']): ?>
        					            <?php if($data['pet_fee']>0): ?>
        					            <tr>
        									<td colspan="4"><strong>Pet Fee :</strong></td>
        									<td ><?php echo $payment_currency; ?><?php echo e(number_format($data['pet_fee'],2)); ?></td>
        								</tr>
        					            <?php endif; ?>
        					        <?php endif; ?>
        					    <?php endif; ?>
        					<?php endif; ?>
                         
                            <?php if($data['before_total_fees']): ?>
                            <?php $__currentLoopData = json_decode($data['before_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="4" ><strong><?php echo e($c->name); ?> :</strong></td>
                                <td ><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                                <?php if($data['custom_before_total_fees']): ?>
                                    <?php
                                        $products=json_decode($data['custom_before_total_fees'],true);
                                    ?>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($p['product_amount'])): ?>
                                            <tr>
                                                <td colspan="4" ><strong><?php echo e($p['product_name']); ?>:</strong></td>
                                                <td><?php echo $payment_currency; ?><?php echo e((($p['product_amount']))); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($data['accessories_rate_ids']): ?>
                                    <?php $__currentLoopData = json_decode($data['accessories_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="4" ><strong><?php echo e($c->accessories_name); ?>  (<?php echo e($c->value); ?>*<?php echo $payment_currency; ?><?php echo e($c->accessories_rate); ?>):</strong></td>
                                            <td><?php echo $payment_currency; ?><?php echo e(number_format(($c->accessories_rate*$c->value),2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($data['mileage_rate_ids']): ?>
                                    <?php $__currentLoopData = json_decode($data['mileage_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="4" ><strong><?php echo e($c->milleage_name); ?>

                                            <?php if(isset($c->message)): ?>
                                                <small>( <?php echo e($c->message); ?> )</small>
                                            <?php endif; ?>
                                          :</strong></td>
                                            <td><?php echo $payment_currency; ?><?php echo e(number_format(($c->milleage_rate*$c->value),2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if($data['option_rate_ids']): ?>
                                    <?php $__currentLoopData = json_decode($data['option_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td colspan="4" ><strong><?php echo e($c->option_name); ?>  (<?php echo e($c->value); ?>*<?php echo $payment_currency; ?><?php echo e($c->option_rate); ?>):</strong></td>
                                            <td><?php echo $payment_currency; ?><?php echo e(number_format(($c->option_rate*$c->value),2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                               
                            <tr>
                                <td colspan="4" ><strong>Sub Total :</strong></td>
                                <td ><?php echo $payment_currency; ?><?php echo e(number_format($data['sub_amount'],2)); ?></td>
                            </tr>
                             <?php if($data['tax']): ?>
                                    <tr>
                                        <td  colspan="4"><strong>Tax (<?php echo e($data['define_tax'] ?? ''); ?>%): :</strong></td>
                                        <td ><?php echo $payment_currency; ?><?php echo e(number_format($data['tax'],2)); ?></td>
                                    </tr>
                                <?php endif; ?>
                           <?php if($data['after_total_fees']): ?>
                            <?php $__currentLoopData = json_decode($data['after_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="4" ><strong><?php echo e($c->name); ?> :</strong></td>
                                    <td ><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                            <tr>
                                <td colspan="4" ><strong>Total :</strong></td>
                                <td ><?php echo $payment_currency; ?><?php echo e(number_format($data['total_amount'],2)); ?></td>
                            </tr>
                            <?php if($data['discount']): ?>
                                <?php if($data['discount']!=""): ?>
                                    <?php if($data['discount']!=0): ?>  
                                    <tr>
                                        <td  colspan="4"  ><strong>Discount (<?php echo e($data['discount_coupon']); ?>):</strong></td>
                                        <td>- <?php echo $payment_currency; ?><?php echo e(number_format($data['discount'],2)); ?></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="4"  ><strong>Total Amount after Discount:</strong></td>
                                        <td><?php echo $payment_currency; ?><?php echo e(number_format($data['after_discount_total'],2)); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
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
                            <?php if($data['amount_data']): ?>
                                <?php
                                    $amount_data=json_decode($data['amount_data'],true);
                                ?>
                                <?php if(is_array($amount_data)): ?>
                                    <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $status='';?>
                                        <?php if(isset($c['status'])): ?>
                                            <?php $status='(<span style="color:green;">Paid</span>)'; ?>
                                        <?php endif; ?>
                                    <tr>
                                        <td colspan="4"><strong><?php echo e($c['message']); ?> <?php echo $status; ?>:</strong></td>
                                        <td><?php echo $payment_currency; ?><?php echo e(number_format($c['amount'],2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                           <tr>
                                <th colspan="4">Status</th>
                            </tr>
                            <tr>
                                <th>Payment </th>
                                <td><?php echo e($data['payment_status']); ?></td>
                                <th>Welcome Email </th>
                                <td><?php echo e($data['welcome_email']); ?></td>
                            </tr>
                            <tr>
                                <th>Review Email </th>
                                <td><?php echo e($data['review_email']); ?></td>
                                <th>Reminder Email </th>
                                <td><?php echo e($data['reminder_email']); ?></td>
                            </tr>
                            <tr>
                                <th>Checkin Email </th>
                                <td><?php echo e($data['checkin_email']); ?></td>
                                <th>Checkout Email </th>
                                <td><?php echo e($data['checkout_email']); ?></td>
                            </tr>
                    </table>
                    <table class="table table-bordered" >
                        <tr>
                            <th>Payment Interval</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Tran ID</th>
                            <th>Mode</th>
                        </tr>
                        <?php if($data['amount_data']): ?>
                            <?php
                                $amount_data=json_decode($data['amount_data'],true);
                            ?>
                            <?php if(is_array($amount_data)): ?>
                                <?php $__currentLoopData = $amount_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $status='';?>
                                    <?php if(isset($c['status'])): ?>
                                        <?php $status='(<span style="color:green;">Paid</span>)'; ?>
                                    <?php endif; ?>
                                <tr>
                                    <td align="left" style="padding: 10px;" valign="top"><strong><?php echo e($c['message']); ?> <?php echo $status; ?>:</strong></td>
                                    <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c['amount'],2)); ?></td>
                                    <td align="right" style="padding: 10px;" valign="top"><?php echo e($c['status'] ?? '--'); ?></td>
                                    <td align="right" style="padding: 10px;" valign="top"><?php echo e($c['date'] ?? '--'); ?></td>
                                    <td align="right" style="padding: 10px;" valign="top"><?php echo e($c['tran_id'] ?? '--'); ?></td>
                                    <td align="right" style="padding: 10px;" valign="top"><?php echo e($c['mode'] ?? '--'); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </table>
                </div>
                <?php if($client->booking_status!='booking-cancel'): ?>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="<?php echo route($route.'.edit', [$client->id]); ?>" class="btn btn-outline-success btn-sm raw-margin-right-8 d-none"><i
                                class="fa fa-pencil-alt"></i> </a>
                        <?php if($client->booking_status=='booking-confirmed'): ?>
                            <form method="post" action="<?php echo route($route.'.destroy', [$client->id]); ?>"
                                  style="display: inline-block;">
                                <?php echo csrf_field(); ?>

                                <?php echo method_field('DELETE'); ?>

                                <button type="submit" class="btn btn-outline-danger btn-sm raw-margin-right-8"
                                        onclick="return confirm('Are you sure you want to cancel this <?php echo e($name); ?>?')">
                                    Cancel Booking
                                </button>
                            </form>

                            <?php if($client->void_status=="pending"): ?>
                                <?php if($client->customer_profile_id): ?>
                                    <?php if($client->refund_tran_id): ?>
                                         <a href="<?php echo route($route.'.release', [$client->id]); ?>" class="btn btn-outline-success btn-sm raw-margin-right-8 "> Release </a>
                                         <a href="<?php echo route($route.'.charge', [$client->id]); ?>" class="btn btn-outline-success btn-sm raw-margin-right-8 "> Charge  </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
          </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
    $("#data-table-gaurav").DataTable({"lengthMenu": [[ 50, -1], [ 50, "All"]]});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/booking-enquiries/index.blade.php ENDPATH**/ ?>