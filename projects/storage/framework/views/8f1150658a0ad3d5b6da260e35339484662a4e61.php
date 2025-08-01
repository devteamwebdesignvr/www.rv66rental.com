<div class="row">
    <div class="col-md-12 ">
        <div class="form-group">
            <?php echo Form::label("Vehicle *"); ?>

            <?php echo Form::select("property_id",ModelHelper::getProppertySelectList(),null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("property_id")); ?></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("name"); ?>

            <?php echo Form::text("name",null,["class"=>"form-control","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("name")); ?></span>
        </div>
    </div>
 
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("code"); ?>

            <?php echo Form::text("code",null,["class"=>"form-control","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("code")); ?></span>
        </div>
    </div>
 
 
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("Valid for booking start date"); ?>

            <?php echo Form::text("start_date",null,["class"=>"form-control datepicker","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("start_date")); ?></span>
        </div>
    </div>
 
 
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label("Valid for booking end date"); ?>

            <?php echo Form::text("end_date",null,["class"=>"form-control datepicker","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("end_date")); ?></span>
        </div>
    </div>
 



    <div class="col-md-6 ">
        <div class="form-group">
            <?php echo Form::label("type"); ?>

            <?php echo Form::select("type",["per"=>"%","excat"=>"excat"],null,["class"=>"form-control","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("type")); ?></span>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="form-group">
            <?php echo Form::label("amount"); ?>

            <?php echo Form::number("amount",null,["class"=>"form-control","required"=>"required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("amount")); ?></span>
        </div>
    </div>

   
</div>

<div class="row ">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("description"); ?>

            <?php echo Form::textarea("description",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("description")); ?></span>
        </div>
    </div>
</div>

<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/coupons/form.blade.php ENDPATH**/ ?>