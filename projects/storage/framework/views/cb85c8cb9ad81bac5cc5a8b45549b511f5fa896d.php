<div class="row">
	 
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("name*"); ?>

			<?php echo Form::text("name",null,["class"=>"form-control","placeholder"=>"Enter name","required"=>"required"]); ?>

			<span class="text-danger"><?php echo e($errors->first("name")); ?></span>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("heading*"); ?>

			<?php echo Form::text("heading",null,["class"=>"form-control","placeholder"=>"Enter heading","required"=>"required"]); ?>

			<span class="text-danger"><?php echo e($errors->first("heading")); ?></span>
		</div>
	</div>
	
	
	<div class="col-md-4">
		<div class="form-group">
			   <label>SEO URL ( Only A-z,0-9,_,- are allowed)*</label>
            <?php echo Form::text("seo_url",null,["class"=>"form-control", "pattern"=>"[a-zA-Z0-9-_]+", "title"=>"Enter Valid SEO URL", "oninvalid"=>"this.setCustomValidity('SEO URL is not Valid Please enter first letter must be a-z and only accept chars a-z 0-9,-,_')" ,"onchange"=>"try{setCustomValidity('')}catch(e){}", "oninput"=>"setCustomValidity(' ')","required"=>"required"]); ?>

			<span class="text-danger"><?php echo e($errors->first("seo_url")); ?></span>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label(" Vehicle Type*"); ?>

			<?php echo Form::select("location_id",ModelHelper::getLocationSelectList(),null,["class"=>"form-control","placeholder"=>"Choose Vehicle Type","required"=>"required"]); ?>

			<span class="text-danger"><?php echo e($errors->first("heading")); ?></span>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("property_status"); ?>

			<?php echo Form::select("property_status",Helper::getPropertyStatus(),null,["class"=>"form-control","placeholder"=>"Choose Property Status","required"]); ?>

			<span class="text-danger"><?php echo e($errors->first("property_status")); ?></span>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("status"); ?>

			<?php echo Form::select("status",Helper::getBooleanDataActual(),null,["class"=>"form-control","required"]); ?>

		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("Display price"); ?>

			<?php echo Form::text("price",null,["class"=>"form-control","placeholder"=>"Enter price"]); ?>

			<span class="text-danger"><?php echo e($errors->first("price")); ?></span>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("mobile"); ?>

			<?php echo Form::text("mobile",null,["class"=>"form-control","placeholder"=>"Enter mobile"]); ?>

			<span class="text-danger"><?php echo e($errors->first("mobile")); ?></span>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<?php echo Form::label("email"); ?>

			<?php echo Form::email("email",null,["class"=>"form-control","placeholder"=>"Enter email"]); ?>

			<span class="text-danger"><?php echo e($errors->first("email")); ?></span>
		</div>
	</div>
</div>
<div class="row">
	
	<div class="col-md-4 ">
		<div class="form-group">
			<?php echo Form::label("instant_booking_button"); ?>

			<?php echo Form::select("instant_booking_button",Helper::getBooleanDataActual(),null,["class"=>"form-control","required"]); ?>

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("standard_rate"); ?>

			<?php echo Form::number("standard_rate",null,["class"=>"form-control","placeholder"=>"Enter Standard Rate"]); ?>

			<span class="text-danger"><?php echo e($errors->first("standard_rate")); ?></span>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("min_stay"); ?>

			<?php echo Form::number("min_stay",null,["class"=>"form-control","placeholder"=>"Enter Min Stay"]); ?>

			<span class="text-danger"><?php echo e($errors->first("min_stay")); ?></span>
		</div>
	</div>
	
	<div class="col-md-2 ">
		<div class="form-group">
			<?php echo Form::label("checkin_day"); ?>

			<?php echo Form::select("checkin_day",Helper::getWeekNameSelect(),null,["class"=>"form-control","placeholder"=>"Checkin Day"]); ?>

		</div>
	</div>
	
	<div class="col-md-2 ">
		<div class="form-group">
			<?php echo Form::label("checkout_day"); ?>

			<?php echo Form::select("checkout_day",Helper::getWeekNameSelect(),null,["class"=>"form-control","placeholder"=>"Checkout Day"]); ?>

		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("feature_image"); ?>

            <?php echo Form::file("feature_image",["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("feature_image")); ?></span>
             <?php if(isset($data)): ?>
                <?php if($data->feature_image!=""): ?>
                     <img src="<?php echo e(asset(($data->feature_image))); ?>" width="200" > <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_feature_image" value="yes" type="checkbox" id="remove_feature_image" >
                        <label for="remove_feature_image" class="custom-control-label">Remove Feature Image</label>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
	<div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("banner_image"); ?>

            <?php echo Form::file("banner_image",["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("banner_image")); ?></span>
             <?php if(isset($data)): ?>
                <?php if($data->banner_image!=""): ?>
                     <img src="<?php echo e(asset(($data->banner_image))); ?>" width="200" > <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_banner_image" value="yes" type="checkbox" id="remove_banner_image" >
                        <label for="remove_banner_image" class="custom-control-label">Remove Banner Image</label>
                    </div> 
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="row">
    
   <?php  //put third party listing url only use for admin see ?>
	<div class="col-md-12 d-none">
		<div class="form-group">
			<?php echo Form::label("website"); ?>

			<?php echo Form::text("website",null,["class"=>"form-control","placeholder"=>"Enter website"]); ?>

			<span class="text-danger"><?php echo e($errors->first("website")); ?></span>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="form-group">
			<?php echo Form::label("address"); ?>

			<?php echo Form::textarea("address",null,["class"=>"form-control","placeholder"=>"Enter address","rows"=>2]); ?>

			<span class="text-danger"><?php echo e($errors->first("address")); ?></span>
		</div>
	</div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("map iframe src"); ?>

            <?php echo Form::textarea("map",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("map")); ?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("listing description"); ?>

            <?php echo Form::textarea("description",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("description")); ?></span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("Property Detail Description"); ?>

            <?php echo Form::textarea("long_description",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("long_description")); ?></span>
        </div>
    </div>
   

 
</div>




<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/main.blade.php ENDPATH**/ ?>