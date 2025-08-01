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
            <?php echo Form::label("message"); ?>

            <?php echo Form::textarea("message",null,["class"=>"form-control","required","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("message")); ?></span>
        </div>
    </div>
   
</div>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/contact-us-enquiries/form.blade.php ENDPATH**/ ?>