<div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("PMS NAME"); ?>

            <?php echo Form::text("api_pms",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("api_pms")); ?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("API KEY"); ?>

            <?php echo Form::text("api_id",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("api_id")); ?></span>
        </div>
    </div>
   

   
</div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/pms.blade.php ENDPATH**/ ?>