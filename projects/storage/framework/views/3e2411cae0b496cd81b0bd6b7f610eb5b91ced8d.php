


<div class="row d-none">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("tags"); ?>

            <?php echo Form::text("tags",null,["class"=>"form-control","data-role"=>"tagsinput"]); ?>

            <span class="text-danger"><?php echo e($errors->first("tags")); ?></span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("cancellation_policy"); ?>

            <?php echo Form::textarea("cancellation_policy",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("cancellation_policy")); ?></span>
        </div>
    </div>
   
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("booking_policy"); ?>

            <?php echo Form::textarea("booking_policy",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("booking_policy")); ?></span>
        </div>
    </div>
   
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("Damage and Incidentals"); ?>

            <?php echo Form::textarea("short_description",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("short_description")); ?></span>
        </div>
    </div>
 
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("notes"); ?>

            <?php echo Form::textarea("notes",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("notes")); ?></span>
        </div>
    </div>
   
</div>



<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/extra.blade.php ENDPATH**/ ?>