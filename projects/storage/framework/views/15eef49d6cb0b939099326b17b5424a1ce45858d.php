
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("logo",$data->image); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>

    <?php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
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
    <a href="#check1" class="sticky btn-25 book1 check">
<span class="button-text">SEARCH</span>
</a>
<?php
    $list=App\Models\Property::query();
    $list->where("location_id",$data->id);
        $yes_is_pet='';
    $no_is_pet='';
    $total_sleep=0;
    if(Request::get("is_pet")){
        if(Request::get("is_pet")=="Yes"){
            $list->where("pet_fee",">",0);
            $yes_is_pet="checked";
        }else{
            $no_is_pet="checked";
        }
    }else{
        $no_is_pet="checked";
    }
       if($total_sleep!=0)
    $list->where("sleeps",">=",$total_sleep);
     if(Request::get("start_date")){
        if(Request::get("end_date")){
            
           
            $ids=Helper::getPropertyList(Request::get("start_date"),Request::get("end_date"));
            $list->whereNotIn("id",$ids);
        }
    }
    $list->where("status","true");
    $list=$list->orderBy("id","desc")->get();
?>


<section class="filter rv-class" id="check1">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12 left">
                <div class="container booking-area">
    	<form action="" method="get">
	    
		<div class="row">
			<div class="col-lg-12 md-12 icns mb-lg-0 position-relative">
			    <div class="row">
			        <div class='col-6'>
			            
				<?php echo Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in"]); ?>

				<i class="fa-solid fa-calendar-days"></i>
			        </div>
			         <div class='col-6'>
			          
				<?php echo Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out" ]); ?>

				<i class="fa-solid fa-calendar-days"></i>
			        </div>
			        
			         <div class='col-4 d-none'>
			            
            				<?php echo Form::select("location_id",ModelHelper::getLocationSelectList(),$data->id,["class"=>"","placeholder"=>"Choose Vehicle Type"]); ?>

			        </div>

        	        <div class="col-lg-4 md-4 md-lg-0 srch-btn">
        				<button type="submit" class="btn-25"><span>Search</span></button>
        			</div>
			    </div>
			  
			</div>
		
			
							<div class="ovabrw_service_wrap" style="display:none;">
                                <label>
                                Guests  
                                </label>
                                <div class="row ovabrw_service">
                                   <div class="ovabrw_service_select rental_item">
                                       <input type="text" name="Guests" value="<?php echo e(Request::get('Guests') ?? '1 Guests'); ?>" readonly class="form-control gst" id="show-target-data" placeholder="Guests">
                    
                                        <i class="fa-solid fa-users "></i>
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
                    	                               <?php if(App\Models\Property::where(["status"=>"true"])->count()>1): ?>
                                        	            <div class="ac-box">
                                                          <div class="adult">
                                                             <span id="child-data-show">Pet</span>
                                                          </div>
                                                          <div class="btnsssss btnsss">
                                                             <input type="radio" id="pet1" name="pet" value="Yes"  <?php echo e($yes_is_pet); ?>>
                                                            <label for="pet1">Yes</label>
                                                            <input type="radio" id="pet2" name="pet" value="No"  <?php echo e($no_is_pet); ?>>
                                                            <label for="pet2">No</label> 
                                                          </div>
                                                       </div>
                                                       <?php endif; ?>
                    	                               <button type="button" class="btn main-btn close1" data-dismiss="modal" onclick="">Apply</button>
                    	                           </div>
                    	                      </div>
                                     
                                   </div>
                                </div>
                             </div>
		
		</div>
	</form>
</div>
            </div>
            
        
        </div>
       
    </div>
</section>
<section class="list-area">
    <div class="container">
        <div class="row">
          
                
               
                      <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-4 left">
                            <div class="main">
                                        <a href="<?php echo e(url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all())); ?>" class="img-anc">
                                            <div class="image-sec">
                                                <img src="<?php echo e(asset($c->feature_image)); ?>" class="img-fluid" alt="">
                                            </div>
                         
                                       </a> 
                                        <div class="content-sec">
                                        <div class="content-top">
                                             <a href="<?php echo e(url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all())); ?>">
                                            <h2><?php echo e($c->name); ?></h2>
                                             </a>
                                           
                                        </div>
                                        
                                        <ul class="hammenities">
                                            <li><img src="<?php echo e(asset('front/images/camper-van.png')); ?>" class="img-fluid"> <?php echo e(App\Models\Location::find($c->location_id)->name ?? ''); ?></li>
                                            <?php if($c->address): ?>
                                            <li><i class="bi bi-geo-alt-fill"></i> <?php echo e($c->address); ?></li>
                                            <?php endif; ?>
                                            <?php if($c->sleeps): ?>
                                            <li><i class="bi bi-person-fill-add"></i> <?php echo e($c->sleeps); ?> adults</li>
                                            <?php endif; ?>
                                            <?php if($c->beds): ?>
                                            <li><i class="fa-solid fa-gas-pump"></i> <?php echo e($c->beds); ?> Seats</li>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="bottom-area">
                                            <a href="<?php echo e(url('properties/detail/'.$c->seo_url).'?'.http_build_query(request()->all())); ?>" class="btn-25">
                                                <span>Details</span>
                                            </a>
                                             <p class="price"><span><?php echo $setting_data['payment_currency']; ?><?php echo e($c->price); ?></span> / Night</p>
                                         </div>
                                </div>
                            </div>
                        </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </div>
    </div>
</section>
    

<?php $__env->stopSection(); ?>


<?php $__env->startSection("js"); ?>
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
    }
    
    
      $("#reset-button-gaurav-data").click(function(){
            $("#txtFrom").val('');
            $("#txtTo").val('');
            $("#adults-area").val('');
            $("#child-area").val('');
             $("#adults-data").val(0);
            $("#child-data").val(0);
            $("#show-target-data").val(null);
            $("#submit-button-gaurav-data").hide();
            $("#gaurav-new-modal-days-area").html('');
            $("#gaurav-new-modal-service-area").html('');
            $("#gaurav-new-data-area").html('');
            $("#adults-data-show").html("Adult");
            $("#child-data-show").html("Child");
           
            
           $("#txtFrom").datepicker("option", "maxDate",  '2043-10-10');

       });
</script>

<?php
$new_data_blocked=LiveCart::iCalDataCheckInCheckOut(0);
    $checkin=$new_data_blocked['checkin'];
    
    $checkout=$new_data_blocked['checkout'];

?>
<script type="text/javascript">
    var checkin = <?php echo json_encode($checkin);  ?>;
    var checkout = <?php echo json_encode($checkout);  ?>;
    $(function() {
        $("#txtFrom").datepicker({
            numberOfMonths: 1,
            minDate: '@minDate',
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [checkin.indexOf(string) == -1];

            },

            onSelect: function(selected) {
                $("#submit-button-gaurav-data").hide();
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#txtTo").datepicker("option", "minDate", dt);
                $("#txtTo").val('');
            },
            onClose: function() {
                $("#txtTo").datepicker("show");
            }
        });

        $("#txtTo").datepicker({
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd', 
            beforeShowDay: function(date) {

                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

                return [checkout.indexOf(string) == -1]

            },

            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#txtFrom").datepicker("option", "maxDate", dt);
                $.post("<?php echo e(route('checkajax-get-quote')); ?>",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),book_sub:true,property_id:<?php echo e($data->id); ?>},function(data){
                    if(data.status==400){
                     //   $("#submit-button-gaurav-data").hide();
                       // toastr.error(data.message);
                    }else{
                        // $("#submit-button-gaurav-data").show();
                        // $("#gaurav-new-modal-days-area").html(data.modal_day_view);
                        // $("#gaurav-new-modal-service-area").html(data.modal_service_view);
                        // $("#gaurav-new-data-area").html(data.data_view);
                    }
                })

            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/property/location.blade.php ENDPATH**/ ?>