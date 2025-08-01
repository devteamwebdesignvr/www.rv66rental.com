<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("rental_aggrement_attachment"); ?>

            <?php echo Form::file("rental_aggrement_attachment",["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("rental_aggrement_attachment")); ?></span>
             <?php if(isset($data)): ?>
                <?php if($data->rental_aggrement_attachment!=""): ?>
                     <a href="<?php echo e(asset(($data->rental_aggrement_attachment))); ?>" target="_BLANK" >Attachment</a>  <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_rental_aggrement_attachment" value="yes" type="checkbox" id="remove_rental_aggrement_attachment" >
                        <label for="remove_rental_aggrement_attachment" class="custom-control-label">Remove Rental Aggrement Attachment</label>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/rental.blade.php ENDPATH**/ ?>