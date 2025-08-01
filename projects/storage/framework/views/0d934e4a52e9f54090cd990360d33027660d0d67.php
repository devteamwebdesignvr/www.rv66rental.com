<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("welcome_package_attachment"); ?>

            <?php echo Form::file("welcome_package_attachment",["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("welcome_package_attachment")); ?></span>
             <?php if(isset($data)): ?>
                <?php if($data->welcome_package_attachment!=""): ?>
                     <a href="<?php echo e(asset(($data->welcome_package_attachment))); ?>" target="_BLANK" >Attachment</a>  <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_welcome_package_attachment" value="yes" type="checkbox" id="remove_welcome_package_attachment" >
                        <label for="remove_welcome_package_attachment" class="custom-control-label">Remove Welcome Package Attachment</label>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("welcome_package_description"); ?>

            <?php echo Form::textarea("welcome_package_description",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("welcome_package_description")); ?></span>
        </div>
    </div>
 
</div>

<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/welcome.blade.php ENDPATH**/ ?>