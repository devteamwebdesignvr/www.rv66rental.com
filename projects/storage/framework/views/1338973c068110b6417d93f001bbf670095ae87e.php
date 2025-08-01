
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("container"); ?>
<?php
$name=$data->name;
$bannerImage=asset('front/images/internal-banner.webp');;
if($data->banner_image){
$bannerImage=asset($data->banner_image);
}
?>
      
 
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
<!-- end banner sec -->
<a href="#book" class="sticky btn-25 book1 book-now">
<span class="button-text">BOOK NOW</span>
</a>

<section class="gallery-area">
    <div class="container">
        <div class="row">
            <div class="col-8 left">
                <?php if($data->feature_image): ?>
                <img src="<?php echo e(asset($data->feature_image)); ?>" class="img-fluid" alt="">
                <?php endif; ?>
            </div>
            
            <div class="col-4 right">
                
                        <?php $k=1; ?>
                	   <?php $__currentLoopData = App\Models\PropertyGallery::where("property_id",$data->id)->limit(2)->orderBy("sorting","asc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     
                      
                         	 <img src="<?php echo e(asset($c->image)); ?>" class="img-fluid" alt="<?php echo e($c->caption); ?>" class="img<?php echo e($k++); ?>">
         
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
               
            
                <div class="gall-btn">
                    <a href="#gallery-1" class="btn-25 btn_photos">
                    <span>View Photos</span>
                </a>
                </div>
                <div id="gallery-1" class="hidden">
               
                
                	   <?php $__currentLoopData = App\Models\PropertyGallery::where("property_id",$data->id)->orderBy("sorting","asc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     
                         	<a href="<?php echo e(asset($c->image)); ?>"  title="<?php echo e($c->caption); ?>"></a>
         
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>
        </div>
    </div>
</section>
 <section id="property" class="padding_top padding_bottom_half">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 listing1 property-details">
              

               <div class="upper-box">
                   <div class="row">
                       <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                          
                           <h3><?php echo e($data->name); ?></h3> 
                            <div class="hotel-info"><i class="fas fa-map-marker-alt"></i><?php echo e($data->address); ?></div>
                       </div>
          
                   </div>
      
                   
                   <div class="pro-ammenities">
                        <div class="amn-top1">
                    <p><img src="<?php echo e(asset('front')); ?>/images/rv.png" class="img-fluid"> <?php echo e(App\Models\Location::find($data->location_id)->name ?? ''); ?></p> 
                    <?php if($data->address): ?>
                    <p><i class="bi bi-geo-alt-fill"></i> <?php echo e($data->address); ?></p>
                    <?php endif; ?>
                    <?php if($data->sleeps): ?>
                    <p><i class="bi bi-person-fill-add"></i> <?php echo e($data->sleeps); ?> adults</p>
                    <?php endif; ?>
                      <?php if($data->beds): ?>
                    <p><i class="fa-solid fa-gas-pump"></i> <?php echo e($data->beds); ?> Seats</p>
                    <?php endif; ?>
                    </div>
                </div>
               </div>

                
                <?php if($data->long_description): ?> 
                  <div class="property_meta">
                     <div class="propert-box-sec">
                        <div class="tab-content">
                           <h3 class="heading-2">Description</h3>
                        </div>
                        <hr class="hr">
                     </div>
                     <div class="overview-content">
                        <?php echo $data->long_description; ?>

                     </div>
                     <div class="cta-btn" id="more">
                        <a class="btn-25 mt-4"><span>Read More</span></a>
                    </div>
                    <div class="cta-btn" id="less">
                        <a class="btn-25 mt-4"><span>Read Less</span></a>
                    </div>
                  </div>
                <?php endif; ?>
                  <div id="amenities" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-30">
                        <div class="tab-content">
                           <h3 class="heading-2">Amenities</h3>
                        </div>
                        <hr class="hr">
                        <?php $__currentLoopData = App\Models\PropertyAmenityGroup::where("property_id",$data->id)->orderBy("sorting","asc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h4><?php echo e($c->name); ?></h4>
                        <div class="row">
                            <?php $__currentLoopData = App\Models\PropertyAmenity::where("property_amenity_id",$c->id)->where("status","true")->orderBy("sorting","asc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <ul class="amenities">
                                 <li><i class="fa fa-check"></i> <?php echo e($c1->name); ?></li>
                              </ul>
                           </div>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                        </div>
                        <hr class="hr">

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                  </div>
                  <div id="rates" class="abouttext" style="margin-top: 30px; display:none;">
                    
                  
                     <div id="policies" class="abouttext" style="margin-top: 30px; display:none;">
                        <div class="tab-content">
                           <h3 class="heading-2">Policies</h3>
                           <hr class="hr">
                        </div>
                        
                     </div>
                     <br>
                     <?php if($data->cancellation_policy): ?>
                     <h4>Cancellation Policy</h4>
                     <?php echo $data->cancellation_policy; ?>

                     <?php endif; ?>
                     <?php if($data->short_description): ?>
                     <h4>Damage and Incidentals</h4>
                     <?php echo $data->short_description; ?>

                     <?php endif; ?>
                     <?php if($data->booking_policy): ?>
                     <h4>Booking Policy</h4>
                     <?php echo $data->booking_policy; ?>

                     <?php endif; ?>
                     <?php if($data->notes): ?>
                     <h4>Notes</h4>
                     <?php echo $data->notes; ?>

                     <?php endif; ?>
                     <p></p>
                  </div>
                  <div id="availability" class="abouttext" style="margin-top: 30px;">
                     <div class="properties-amenities mb-40">
                        <h3 class="heading-2">Availability</h3>
                        <hr class="hr">
                     </div>
                     <div class="calender">
                         <iframe src="<?php echo e(url('fullcalendar-demo/'.$data->id)); ?>"  width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                  </div>
                   
                  <div id="reviews" class="abouttext" style="margin-top: 30px;">
                     <div class="inside-properties mb-50">
                        <div class="tab-content">
                           <h3 class="heading-2">Review</h3>
                        </div>
                        <hr class="hr">
                        <div class="comments">
                           <div class="comment">
                            <?php $__currentLoopData = App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("stay_date","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="comment-content">
                                 <div class="comment-meta">
                                    <!-- <h3 style="margin-bottom: 18px;">Wonderful house and pool</h3> -->
                                    <span style="font-size: 14px;">5/5</span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                 </div>
                                 <div class="comment-meta" style="margin-top: 18px;">
                                    <h3 style=""><?php echo e($c->name); ?></h3>
                                 </div>
                                 <p style="font-size: 14px;line-height: 20px;margin-top: 18px;"></p>
                                 <p><?php echo e($c->message); ?></p>
                                 <p></p>
                                 <span style="font-size: 14px;font-weight: 500;">Stayed <?php echo e(date('F Y',strtotime($c->stay_date))); ?></span>
                              </div>
                              <hr class="hr">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                <section class="contact-page-section lv">
                     <div class="auto-container">
                        <!-- Sec Title -->
                        <div class="sec-title">
                           <h3 class="heading-2">Leave a Review</h3>
                        </div>
                        <div class="inner-container">
                           <!-- Contact Form -->
                           <div class="contact-form">
                               <?php echo Form::open(["autocomplete"=>"off","route"=>"reviewSubmit"]); ?>

                                 <div class="">
                                    <div class="row clearfix">
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-6 col-md-6">
                                          <label>
                                             Name *
                                          </label>
                                          <input type="text" name="name" placeholder="Name" required="">
                                       </div>
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                          <label>Email *</label>
                                          <input type="email" name="email" placeholder="Email" required="">
                                       </div>
                                       <!-- Form Group -->
                                       <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                          <label>Captions  *</label>
                                          <input type="text" name="profile" required placeholder="Captions">
                                       </div>
                                       <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                          <label>Book Date</label>
                                          <input type="date"  class="datepicker123" name="stay_date" placeholder="Book date" >
                                          <input type="hidden" name="property_id" value="<?php echo e($data->id); ?>">
                                       </div>
                                       <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                          <label>Rating  *</label>
                                          <fieldset class="score">
                                             <input type="radio" id="score-5" name="score" value="5" checked="">
                                             <label title="5 stars" for="score-5" style="font-size: 25px;">5 stars</label>
                                             <input type="radio" id="score-4" name="score" value="4">
                                             <label title="4 stars" for="score-4" style="font-size: 25px;">4 stars</label>
                                             <input type="radio" id="score-3" name="score" value="3">
                                             <label title="3 stars" for="score-3" style="font-size: 25px;">3 stars</label>
                                             <input type="radio" id="score-2" name="score" value="2">
                                             <label title="2 stars" for="score-2" style="font-size: 25px;">2 stars</label>
                                             <input type="radio" id="score-1" name="score" value="1">
                                             <label title="1 stars" for="score-1" style="font-size: 25px;">1 stars</label>
                                          </fieldset>
                                       </div>
                                       <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                          <label>Review *</label>
                                          <textarea class="" name="message" required placeholder="Review"></textarea>
                                       </div>
                                       <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                          <button type="submit" class="btn-25" name="reviewsubmit"><span>Submit Review</span></button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </section>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
    <div class="col-lg-4">
        <div class="get-quote">
        <div class="price-side">
            <p><span> <?php echo $setting_data['payment_currency']; ?><?php echo e(Helper::getPriceAmountData($data->id)); ?></span> / night</p>
        </div>
       
           <div class="forms-booking-tab" id="book">
              <ul class="tabs">
                 <li class="item booking active" data-form="ovabrw_booking_form">Request A Quote</li>
              </ul>
              <div class="ovabrw_booking_form" id="ovabrw_booking_form" style="">
                 <form class="form booking_form" id="booking_form" action="<?php echo e(url('get-quote')); ?>" method="get" >
                     <input type="hidden" name="property_id" value="<?php echo e($data->id); ?>">
                     <div class="over-form">
                     <input type="text" id="demo17" value="" aria-label="Check-in and check-out dates" aria-describedby="demo17-input-description" readonly/>
                    <div class="ovabrw_datetime_wrapper">
                        <?php echo Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date","placeholder"=>"From"]); ?>

                       <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="ovabrw_datetime_wrapper">
                       <?php echo Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date","placeholder"=>"To"]); ?>

                       <i class="fa-solid fa-calendar-days"></i>
                    </div>
                      
                  </div>
                   <div class="row"   style="<?php echo e(ModelHelper::showPetFee($data->pet_fee)); ?> " >
                                             <!--<div class="col-md-12" style="text-align: left;padding-top: 15px;color: #02c3ff;">-->
                                                 <!--<label>No. of Pet</label>-->
                                             <!--</div>-->
                                             <div class="col-md-12 pets" style="">
                                                 <?php echo Form::selectRange("no_of_pets",1,$data->max_pet,null,["class"=>"form-control","style"=>"border: 1px solid #cacaca;margin-top: 0px;","id"=>"pet_fee_data_guarav","placeholder"=>"Pets"]); ?>

                                                 <i class="fa-solid fa-paw"></i>
                                             </div>
                                         </div>
                    <div class="ovabrw_service_select rental_item" >
                         <input type="text" name="Guests" required value="<?php echo e(Request::get('Guests') ?? '1 Guests'); ?>" readonly class="form-control gst" id="show-target-data" placeholder="Guests">
                   
                              
                              <input type="hidden" value="<?php echo e(Request::get('adults') ?? '1'); ?>" name="adults" id="adults-data" />
                              <input type="hidden" value="<?php echo e(Request::get('child') ?? '0'); ?>" name="child" id="child-data" />
                              
                              
                              <div class="adult-popup">
                             <div class="modal-bodyss" id="guestsss">
                                 <p class="close1" onclick=""><i class="fa fa-times"></i></p>
                                  <div class="ac-box">
                                     <div class="adult">
                                        <span id="adults-data-show">
                                            <?php if(Request::get('adults')): ?>
                                               <?php if(Request::get('adults')>1): ?>
                                                   <?php echo e(Request::get('adults')); ?> Adults
                                               <?php else: ?>
                                                   <?php echo e(Request::get('adults')); ?> Adult
                                               <?php endif; ?>
                                            <?php else: ?>
                                            1 Adult
                                            <?php endif; ?>
                                        </span>
                                        <p>(18+)</p>
                                     </div>
                                     <div class="btnssss">
                                        <div class="button button1 btnnn" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Increment Value">-</div>  
                                        <div class="button11 button1" onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</div>
                                     </div>
                                  </div>
                                   <div class="ac-box">
                                     <div class="adult">
                                        <span id="child-data-show">
                                             <?php if(Request::get('adults')): ?>
                                               <?php if(Request::get('adults')>1): ?>
                                                   <?php echo e(Request::get('adults')); ?> Children
                                               <?php else: ?>
                                                   <?php echo e(Request::get('adults')); ?> Child
                                               <?php endif; ?>
                                            <?php else: ?>
                                            Child
                                            <?php endif; ?>
                                        </span>
                                        <p>(0-17)</p>
                                     </div>
                                     <div class="btnssss btnsss">
                                        <div class="button button1" onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Increment Value">-</div> 
                                        <div class="button11 button1" onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</div>
                                     </div>
                                  </div>
                                  <button type="button" class="btn main-btn close1 btn-22" data-dismiss="modal" onclick=""><span>Apply</span></button>
                              </div>
                         </div>
                       <i class="fa-solid fa-users"></i>
                    </div>

                    

                          <div id="gaurav-new-data-area">
                            
                           </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="ovabrw-book-now" style="display:none;" id="submit-button-gaurav-data">
                                            <button type="submit" class="btn-25">
                                             <span>Reserve</span></button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="ovabrw-book-now" >
                                            <button type="button" style="display:none;" class="btn-25"  id="reset-button-gaurav-data">
                                             <span>Reset</span></button>
                                        </div>
                                    </div>
                                    
                                </div>
                              
                              <!--<p>Or<br>Contact Owner</p>-->
                              <!--<p><a href="mailto:<?php echo e($data->email); ?>"><i class="fa-solid fa-envelope"></i> <?php echo e($data->email); ?></a></p>-->
                 </form>
              </div>
           </div>
        </div>
     </div>




           
            </div>
         </div>
      </section>
<?php if($data->map): ?>
<div class="map" id="#map">
    <iframe src="<?php echo $data->map; ?>" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<?php endif; ?>
 <?php
                $related_list=App\Models\Property::query();
                $related_list->where("location_id",$data->location_id);
                $related_list->where("id","<>",$data->id);
                $related_list->where("status","true");
                $related_list=$related_list->limit(4)->orderBy("id","desc")->get();
            ?>
<?php if(count($related_list)>0): ?>
<section class="related-property">
    <div class="container">
        <h6 class="head-title">Camping RV Rentals</h6>
        <h3 class="heading-2">Our Top RV Picks For You</h3>
        <div class="row">
           <?php $__currentLoopData = $related_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3">
                <a href="<?php echo e(url('properties/detail/'.$c->seo_url)); ?>">
                     <div class="img-section">
                    <img src="<?php echo e(asset($c->feature_image)); ?>" class="img-fluid" alt="">
                    <p class="pr"><?php echo $setting_data['payment_currency']; ?><?php echo e(Helper::getPriceAmountData($c->id)); ?> / Night</p>
                    </div>
                    <div class="content">
                        <h3 itemprop="name"><?php echo e($c->name); ?></h3>
                        <ul class="property-room-features">
                              
                                   
                                    <li><span><img src="<?php echo e(asset('front/images/camper-van.png')); ?>" class="img-fluid"> <?php echo e(App\Models\Location::find($c->location_id)->name ?? ''); ?></span></li>
                                            <?php if($c->address): ?>
                                            <li><span><i class="bi bi-geo-alt-fill"></i> <?php echo e($c->address); ?></span></li>
                                            <?php endif; ?>
                                            <?php if($c->sleeps): ?>
                                            <li><span><i class="bi bi-person-fill-add"></i> <?php echo e($c->sleeps); ?> adults</span></li>
                                            <?php endif; ?>
                                            <?php if($c->beds): ?>
                                            <li><span><i class="fa-solid fa-gas-pump"></i> <?php echo e($c->beds); ?> Seats</span></li>
                                            <?php endif; ?>
                                </ul>
                                
                    </div>
                </a>
            </div>
            
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>  
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-days-area">
        Modal body..
      </div>

    </div>
  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Additional Fee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-service-area">
        Modal body..
      </div>



    </div>
  </div>
</div>







<script src="<?php echo e(asset('front/jquery.royalslider.minf76d.js')); ?>"></script> 
<script src="https://rawgit.com/jedfoster/Readmore.js/master/readmore.js"></script>
<script>
    function functiondec($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        if(val>0){
            val=val-1;
        }
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        $($show).val($show_actual_data);
        ajaxCallingData();
    }
    function functioninc($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        
            val=val+1;
      
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        $($show).val($show_actual_data);
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        ajaxCallingData();
    }
</script>
<script>
  $('.more').readmore({
    speed: 75, //Açılma Hızı
    collapsedHeight:312, // 100px sonra yazının kesileceğini belirtir.
    moreLink: '<a class="ac" href="#">Show more</a>', // açma linki yazısı
    lessLink: '<a class="kapat" href="#">Show Less</a>', // kapatma linki yazısı
  });
</script>

<script src="<?php echo e(asset('front/js/showmore.js')); ?>"></script>


<script>
  function clearDataForm(){
        $("#start_date").val('');
        $("#end_date").val('');
     
        $("#submit-button-gaurav-data").hide();
        $("#gaurav-new-modal-days-area").html('');
        $("#gaurav-new-modal-service-area").html('');
        $("#gaurav-new-data-area").html('');
     
  }


               

    
    $(document).on("change","#pet_fee_data_guarav",function(){
        ajaxCallingData();
    });
    $(document).on("change","#heating_pool_fee_data_guarav",function(){
        ajaxCallingData();
    });
    
    
    
    function ajaxCallingData(){
        pet_fee_data_guarav=$("#pet_fee_data_guarav").val();
        heating_pool_fee_data_guarav=$("#heating_pool_fee_data_guarav").val();
        adults=$("#adults-data").val();
        childs=$("#child-data").val();
        
        total_guests=parseInt(adults)+parseInt(childs);
        if(total_guests>0){
             if($("#txtFrom").val()!=""){
                 if($("#txtTo").val()!=""){
                     $.post("<?php echo e(route('checkajax-get-quote')); ?>",{start_date:$("#start_date").val(),end_date:$("#end_date").val(),heating_pool_fee_data_guarav:heating_pool_fee_data_guarav,pet_fee_data_guarav:pet_fee_data_guarav,adults:adults,childs:childs,book_sub:true,property_id:<?php echo e($data->id); ?>},function(data){
                        if(data.status==400){
                           
                            $("#gaurav-new-modal-days-area").html(null);
                            $("#gaurav-new-modal-service-area").html(null);
                            $("#gaurav-new-data-area").html(null);
                            $("#submit-button-gaurav-data").hide();
                            toastr.error(data.message);
                        }else{
                            $("#submit-button-gaurav-data").show();
                            $("#gaurav-new-modal-days-area").html(data.modal_day_view);
                            $("#gaurav-new-modal-service-area").html(data.modal_service_view);
                            $("#gaurav-new-data-area").html(data.data_view);
                        }
                    });
                 }
             }
        }else{
             $("#gaurav-new-modal-days-area").html(null);
                            $("#gaurav-new-modal-service-area").html(null);
                            $("#gaurav-new-data-area").html(null);
                            $("#submit-button-gaurav-data").hide();
        }
        
    }
    </script>
    
      <script>
      $(document).ready(function(){
  $("#more").click(function(){
    $("#less").css("display", "block");
    $("#more").css("display", "none");
    $(".overview-content").css("height", "100%");
  });
  
  $("#less").click(function(){
    $("#less").css("display", "none");
    $("#more").css("display", "block");
    $(".overview-content").css("height", "245px");
  });
});
$(document).ready(function(){
   var a = $(".overview-content").height();
   if(a < 245){
$("#more").css("display", "none");
}
else{
    $("#more").css("display", "block");
    $(".overview-content").css("height", "245px");
}
  });

      </script>
            <script src="<?php echo e(asset('datepicker')); ?>/node_modules/fecha/dist/fecha.min.js"></script>
        <script src="<?php echo e(asset('datepicker')); ?>/dist/js/hotel-datepicker.js"></script>
    <script>
    
    <?php
    $new_data_blocked=LiveCart::iCalDataCheckInCheckOutCheckinCheckout($data->id);
 
    

    $checkin=json_encode($new_data_blocked['checkin']);
    
    $checkout=json_encode($new_data_blocked['checkout']);
    $blocked=json_encode($new_data_blocked['blocked']);

?>
    
      var checkin = <?php echo $checkin;  ?>;
    var checkout = <?php echo ($checkout);  ?>;
    var blocked= <?php echo ($blocked);  ?>;
            (function () {
              

                // ------------------- DEMO 17 ------------------- //

    
                        <?php if(Request::get("start_date")): ?>
                            <?php if(Request::get("end_date")): ?>
                         
                                        $("#demo17").val("<?php echo e(request()->start_date); ?> - <?php echo e(request()->end_date); ?>")
                                     
                            
                            <?php endif; ?>
                        <?php endif; ?>

                abc=document.getElementById("demo17");

                var demo17 = new HotelDatepicker(
                    abc,
                    {
                  
                        
                         minNights: 3,
                        <?php if($checkin): ?>
                        noCheckInDates: checkin,
                        <?php endif; ?>
                        <?php if($checkout): ?>
                        noCheckOutDates: checkout,
                        <?php endif; ?>
                        <?php if($blocked): ?>
                         disabledDates: blocked,
                        <?php endif; ?>
                        onDayClick: function() {
                             d = new Date();
                                d.setTime(demo17.start);
                                document.getElementById("start_date").value = getDateData(d);
                                d = new Date();
                                console.log(demo17.end)
                                if(Number.isNaN(demo17.end)){
                                    document.getElementById("end_date").value = '';
                                   
                                }else{
                                     d.setTime(demo17.end);
                                    document.getElementById("end_date").value = getDateData(d);
                                    ajaxCallingData();
                                }
                                
                        },
                        clearButton:function(){

                            return true;
                        },
                        
                        
                      
                        

                    }
                );
                
                
                
                    
                        <?php if(Request::get("start_date")): ?>
                            <?php if(Request::get("end_date")): ?>
                                setTimeout(function(){
                                        $("#demo17").val("<?php echo e(request()->start_date); ?> - <?php echo e(request()->end_date); ?>")
                                        document.getElementById("start_date").value ="<?php echo e(request()->start_date); ?>";
                                        document.getElementById("end_date").value ="<?php echo e(request()->end_date); ?>";
                                           ajaxCallingData();
                                    },1000);
                            
                            <?php endif; ?>
                        <?php endif; ?>
               
                // abc.addEventListener(
                //     "afterClose",
                //     function () {
                //         console.log("hi")
                //     },
                //     false
                // );
         
         
         
         
            })();

            $(document).on("click","#clear",function(){
                $("#clear-demo17").click();
            })
   x=document.getElementById("month-2-demo17");
            x.querySelector(".datepicker__month-button--next").addEventListener("click", function(){
                y=document.getElementById("month-1-demo17");
                y.querySelector(".datepicker__month-button--next").click();
            })  ;


          x=document.getElementById("month-1-demo17");
            x.querySelector(".datepicker__month-button--prev").addEventListener("click", function(){
                y=document.getElementById("month-2-demo17");
                y.querySelector(".datepicker__month-button--prev").click();
            })  ;



          function getDateData(objectDate){

            let day = objectDate.getDate();
            //console.log(day); // 23

            let month = objectDate.getMonth()+1;
            //console.log(month + 1); // 8

            let year = objectDate.getFullYear();
           // console.log(year); // 2022


            if (day < 10) {
                day = '0' + day;
            }

            if (month < 10) {
                month = `0${month}`;
            }
            format1 = `${year}-${month}-${day}`;
            return  format1 ;
            console.log(format1); // 07/23/2022
          }  

</script>


      
<?php $__env->stopSection(); ?>


<?php $__env->startSection("css"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('css'); ?>
<link href="<?php echo e(asset('front/royalslider.css')); ?>" rel="stylesheet">
 <link href="<?php echo e(asset('front/rs-defaulte166.css')); ?>" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('datepicker')); ?>/dist/css/hotel-datepicker.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/datepicker.css" />
    <style>
       input#demo17 {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    opacity: 0;
    height: 42px;
    z-index: 99999999;
    cursor: pointer;
}
.datepicker--topbar-has-close-button .datepicker__info, .datepicker--topbar-has-clear-button .datepicker__info, .datepicker--topbar-has-submit-button .datepicker__info {
    text-align: left;
}
#datepicker-demo17.datepicker {
    z-index: 2;
    margin-top: 40px;
    position: absolute;
    right: 0;
    top: 0;
}
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/property/single.blade.php ENDPATH**/ ?>