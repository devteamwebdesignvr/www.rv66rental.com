
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

    <section class="About-sec rental">
        <div class="container">
            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                            <div class="table-box" style='margin-bottom:20px; padding-left:0px; padding-right:0px;'>
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Fleet Detail </strong></th>
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
                            </div>
                             <div class="table-box" style='padding-left:0px; padding-right:0px;'>
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
                                        <th align="center" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
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
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">(<?php echo e($booking['total_night']); ?> nights * <?php echo $setting_data['payment_currency']; ?><?php echo e($booking['single_guest_fee']); ?> * <?php echo e($booking['rest_guests']); ?> Guests)</span></strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['guest_fee'],2)); ?></td>
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
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><strong>Pet Fee :</strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['pet_fee'],2)); ?></td>
            								</tr>
								            <?php endif; ?>
								        <?php endif; ?>
								    <?php endif; ?>
								<?php endif; ?>
								
                                    <?php $__currentLoopData = json_decode($booking['before_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?>:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <?php if($booking['custom_before_total_fees']): ?>
                                    <?php $__currentLoopData = json_decode($booking['custom_before_total_fees'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($p['product_amount'])): ?>
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong><?php echo e($p['product_name']); ?> 
                                            <?php if(isset($c->message)): ?>
                                                <small>( <?php echo e($c->message); ?> )</small>
                                            <?php endif; ?>
                                        :</strong></td>
                                                <td align="right" style="padding: 10px; " valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($p['product_amount'],2)); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

        
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
                                    <?php $__currentLoopData = json_decode($booking['accessories_rate_ids']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->accessories_name); ?>:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format(($c->accessories_rate*$c->value),2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                          
                                    <tr style="display:none;">
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($booking['sub_amount'],2)); ?></td>
                                    </tr>
                                    
                                    <?php $__currentLoopData = json_decode($booking['after_total_fees']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr >
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong><?php echo e($c->name); ?> :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top"><?php echo $payment_currency; ?><?php echo e(number_format($c->amount,2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <?php if($booking['tax']): ?>
                             
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Tax (<?php echo e($booking['define_tax'] ?? ''); ?>%) :</strong></td>
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
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Discount (<?php echo e($booking['discount_coupon']); ?>):</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['discount'],2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
							    <?php if($booking['extra_discount']): ?>
                                    <?php if($booking['extra_discount']!=""): ?>
                                        <?php if($booking['extra_discount']>0): ?>
                                               <?php $gaurav_discount=1;?> 
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">- <?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['extra_discount'],2)); ?></td>
                                        </tr>
                                      
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
								<?php if($gaurav_discount==1): ?>
								    <tr>
                                        <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><?php echo $setting_data['payment_currency']; ?><?php echo e(number_format($booking['after_discount_total'],2)); ?></td>
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
                            </div>


<?php echo Form::open(["route"=>"rental-aggrement-data-save","files"=>true,"onsubmit"=>"return checkSignature()"]); ?>

<input type="hidden" name="booking_id" value="<?php echo e($booking['id']); ?>">
                <p class="card-title text-center mb-5 rounded" style='margin-top:30px; background: var(--secondary-color);
    color: #fff;
    text-align: center;
    font-size: 15px;
    font-weight:bold;
    padding: 10px;'>Read Rental Agreement</p>
                <fieldset>
                  <div class="col-md-8-offset-2" style="position: relative;
    width: 100%;
    height: 500px;">
                    <?php if($property->rental_aggrement_attachment): ?>
                       <iframe id="iframepdf" src="<?php echo e(asset($property->rental_aggrement_attachment)); ?>" frameborder="1" scrolling="auto" height="100%" width="100%" allowfullscreen="" style="border:1px solid #666CCC; position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;" ></iframe>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-8-offset-2">
                    <div class="even-1 boxSpacingSet8" colspan="2" style="position: relative;margin-left: auto;padding: 0;padding-top: 15px;">
                      <input type="checkbox" id="agree" name="agree" required >
                       <strong>I have read and agree to the Terms & Conditions.</strong> &emsp;</div>
                  </div>
                </fieldset>
                <hr>
                
                    <!-- Content -->
                    <div class="container" style="padding: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>E-Signature</h1>
                                <p>save your signature as an image!</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="sig-canvas" width="300px" height="160">
                                    Get a better browser, bro.
                                </canvas>
                            </div>
                            <div class="col-md-6">
                                <h1>Please upload valid identity proof</h1>
                                <input type="file" name="image" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn-25" id="sig-submitBtn"><span>Pay Now</span></button>
                                <button class="btn-25" type="button" id="sig-clearBtn"><span>Clear Signature</span></button>
                            </div>
                        </div>
                        <br/>
                        <div class="row d-none">
                            <div class="col-md-12">
                                <textarea id="sig-dataUrl" name="signature" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                            </div>
                        </div>
                        <br/>
                        <div class="row d-none">
                            <div class="col-md-12">
                                <img id="sig-image" src="" alt="Your signature will go here!"/>
                            </div>
                        </div>
                    </div>
              <?php echo Form::close(); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<script>

    function checkSignature(){
        var canvas = document.getElementById('sig-canvas');
        if (isCanvasEmpty(canvas)){
            toastr.error('Please enter signature!');
            return false;
        } else {
            
            return true;
        }
    }

    function isCanvasEmpty(canvas) {
        const blankCanvas = document.createElement('canvas');
        blankCanvas.width = canvas.width;
        blankCanvas.height = canvas.height;
        return canvas.toDataURL() === blankCanvas.toDataURL();
    }
(function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.innerHTML = "Data URL for your signature will go here!";
    sigImage.setAttribute("src", "");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.innerHTML = dataUrl;
    sigImage.setAttribute("src", dataUrl);
  }, false);

})();
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("css"); ?>
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
h1{
    color:#000;
    font-size:20px;
    font-weight:bold;
    font-family:'Poppins', sans-serif;
    line-height: 1.25rem;
    margin-bottom: 10px;
    margin-top: 30px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/booking/rentalAggrementBooking.blade.php ENDPATH**/ ?>