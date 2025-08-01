<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("start_date*"); ?>

            <?php echo Form::text("start_date",null,["class"=>"form-control","required","id"=>"datepicker"]); ?>

            <span class="text-danger"><?php echo e($errors->first("start_date")); ?></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("end_date*"); ?>

            <?php echo Form::text("end_date",null,["class"=>"form-control","required","id"=>"datepicker1"]); ?>

            <span class="text-danger"><?php echo e($errors->first("end_date")); ?></span>
        </div>
    </div>



    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("Season Name*"); ?>

            <?php echo Form::text("name_of_price",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("name_of_price")); ?></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("type_of_price*"); ?>

            <?php echo Form::select("type_of_price",["default"=>"default","weekly"=>"weekly"],null,["class"=>"form-control","required","id"=>"type_of_price","placeholder"=>"Select Type of price"]); ?>

            <span class="text-danger"><?php echo e($errors->first("type_of_price")); ?></span>
        </div>
    </div>
    
</div>
<div id="price-section">
   
</div>


<div class="row">


    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("discount_weekly (%)"); ?>

            <?php echo Form::number("discount_weekly",null,["class"=>"form-control","max"=>100,"min"=>0]); ?>

            <span class="text-danger"><?php echo e($errors->first("discount_weekly")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("discount_monthly (%)"); ?>

            <?php echo Form::number("discount_monthly",null,["class"=>"form-control","max"=>100,"min"=>0]); ?>

            <span class="text-danger"><?php echo e($errors->first("discount_monthly")); ?></span>
        </div>
    </div>

 

    <div class="col-md-3 d-none">
        <div class="form-group">
            <?php echo Form::label("is_available"); ?>

            <?php echo Form::select("is_available",["0"=>"0","1"=>"1"],null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("is_available")); ?></span>
        </div>
    </div>
    <div class="col-md-4 d-none">
        <div class="form-group">
            <?php echo Form::label("platform_type"); ?>

            <?php echo Form::text("platform_type",'airbnb',["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("platform_type")); ?></span>
        </div>
    </div>
    <div class="col-md-4 d-none">
        <div class="form-group">
            <?php echo Form::label("currency"); ?>

            <?php echo Form::text("currency",'USD',["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("currency")); ?></span>
        </div>
    </div>
    
    <div class="col-md-4 d-none">
        <div class="form-group">
            <?php echo Form::label("notes"); ?>

            <?php echo Form::text("notes",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("notes")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("min_stay *"); ?>

            <?php echo Form::text("min_stay",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("min_stay")); ?></span>
        </div>
    </div>
    <div class="col-md-4 d-none">
        <div class="form-group">
            <?php echo Form::label("base_min_stay"); ?>

            <?php echo Form::text("base_min_stay",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("base_min_stay")); ?></span>
        </div>
    </div>
   
	<div class="col-md-6 ">
		<div class="form-group">
			<?php echo Form::label("checkin_day"); ?>

			<?php echo Form::select("checkin_day",Helper::getWeekNameSelect(),null,["class"=>"form-control","placeholder"=>"Checkin Day"]); ?>

		</div>
	</div>
	
	<div class="col-md-6 ">
		<div class="form-group">
			<?php echo Form::label("checkout_day"); ?>

			<?php echo Form::select("checkout_day",Helper::getWeekNameSelect(),null,["class"=>"form-control","placeholder"=>"Checkout Day"]); ?>

		</div>
	</div>
    <input type="hidden" name="property_id" value="<?php echo e($property_id); ?>">
 
     

</div>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties-rates/form.blade.php ENDPATH**/ ?>