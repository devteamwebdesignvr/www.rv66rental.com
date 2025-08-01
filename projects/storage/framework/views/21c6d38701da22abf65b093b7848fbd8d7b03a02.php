<div class="row">
  

	<div class="col-md-3  d-none">
		<div class="form-group">
			<?php echo Form::label("bedroom"); ?>

			<?php echo Form::selectRange("bedroom",1,100,null,["class"=>"form-control","placeholder"=>"Select bedroom"]); ?>

			<span class="text-danger"><?php echo e($errors->first("bedroom")); ?></span>
		</div>
	</div>
	<div class="col-md-3  d-none">
		<div class="form-group">
			<?php echo Form::label("bathroom"); ?>

			<?php echo Form::selectRange("bathroom",1,100,null,["class"=>"form-control","placeholder"=>"select bathroom"]); ?>

			<span class="text-danger"><?php echo e($errors->first("bathroom")); ?></span>
		</div>
	</div>


	<div class="col-md-3 d-none">
		<div class="form-group">
			<?php echo Form::label("full_bath"); ?>

			<?php echo Form::selectRange("full_bath",1,100,null,["class"=>"form-control","placeholder"=>"Select full bath"]); ?>

			<span class="text-danger"><?php echo e($errors->first("full_bath")); ?></span>
		</div>
	</div>
	<div class="col-md-3 d-none">
		<div class="form-group">
			<?php echo Form::label("half_bath"); ?>

			<?php echo Form::selectRange("half_bath",1,100,null,["class"=>"form-control","placeholder"=>"Select half bath"]); ?>

			<span class="text-danger"><?php echo e($errors->first("half_bath")); ?></span>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
			<?php echo Form::label("sleeps"); ?>

			<?php echo Form::selectRange("sleeps",1,100,null,["class"=>"form-control","placeholder"=>"select sleeps"]); ?>

			<span class="text-danger"><?php echo e($errors->first("sleeps")); ?></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<?php echo Form::label("class"); ?>

			<?php echo Form::text("spaces",null,["class"=>"form-control","placeholder"=>"Enter class"]); ?>

			<span class="text-danger"><?php echo e($errors->first("spaces")); ?></span>
		</div>
	</div>


	<div class="col-md-3 ">
		<div class="form-group">
			<?php echo Form::label("size"); ?>

			<?php echo Form::text("area",null,["class"=>"form-control","placeholder"=>"Enter size"]); ?>

			<span class="text-danger"><?php echo e($errors->first("area")); ?></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<?php echo Form::label("make"); ?>

			<?php echo Form::text("property_view",null,["class"=>"form-control","placeholder"=>"Enter make"]); ?>

			<span class="text-danger"><?php echo e($errors->first("property_view")); ?></span>
		</div>
	</div>
	<div class="col-md-3  d-none">
		<div class="form-group">
			<?php echo Form::label("checkin day "); ?>

			<?php echo Form::text("checkin",null,["class"=>"form-control","placeholder"=>"Enter checkin"]); ?>

			<span class="text-danger"><?php echo e($errors->first("checkin")); ?></span>
		</div>
	</div>
	<div class="col-md-3  d-none">
		<div class="form-group">
			<?php echo Form::label("checkout day "); ?>

			<?php echo Form::text("checkout",null,["class"=>"form-control","placeholder"=>"Enter checkout"]); ?>

			<span class="text-danger"><?php echo e($errors->first("checkout")); ?></span>
		</div>
	</div>
	<div class="col-md-3 ">
		<div class="form-group">
			<?php echo Form::label("Model"); ?>

			<?php echo Form::text("category",null,["class"=>"form-control","placeholder"=>"Enter Model"]); ?>

			<span class="text-danger"><?php echo e($errors->first("category")); ?></span>
		</div>
	</div>
	
	<div class="col-md-3  ">
		<div class="form-group">
			<?php echo Form::label("seats"); ?>

			<?php echo Form::selectRange("beds",1,100,null,["class"=>"form-control","placeholder"=>"select seats"]); ?>

			<span class="text-danger"><?php echo e($errors->first("beds")); ?></span>
		</div>
	</div>
	<div class="col-md-3  d-none">
		<div class="form-group">
			<?php echo Form::label("king_beds"); ?>

			<?php echo Form::selectRange("king_beds",1,100,null,["class"=>"form-control","placeholder"=>"select king_beds"]); ?>

			<span class="text-danger"><?php echo e($errors->first("king_beds")); ?></span>
		</div>
	</div>
	<div class="col-md-3 d-none">
		<div class="form-group">
			<?php echo Form::label("queen_beds"); ?>

			<?php echo Form::selectRange("queen_beds",1,100,null,["class"=>"form-control","placeholder"=>"select queen_beds"]); ?>

			<span class="text-danger"><?php echo e($errors->first("queen_beds")); ?></span>
		</div>
	</div>
	
	<div class="col-md-3 d-none">
		<div class="form-group">
			<?php echo Form::label("extra_bed"); ?>

			<?php echo Form::text("extra_bed",null,["class"=>"form-control","placeholder"=>"Enter extra_bed"]); ?>

			<span class="text-danger"><?php echo e($errors->first("extra_bed")); ?></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<?php echo Form::label("display on home page"); ?>

			<?php echo Form::select("is_home",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>

</div>

<div class="row d-none">
	
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("is_trending"); ?>

			<?php echo Form::select("is_trending",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("is_top"); ?>

			<?php echo Form::select("is_top",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("is_feature"); ?>

			<?php echo Form::select("is_feature",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("is_bestseller"); ?>

			<?php echo Form::select("is_bestseller",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<?php echo Form::label("is_hot"); ?>

			<?php echo Form::select("is_hot",Helper::getBooleanDataActual(),null,["class"=>"form-control"]); ?>

		</div>
	</div>
	
</div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/select.blade.php ENDPATH**/ ?>