
<div class="row" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-option-data btn btn-info"><i class="fa fa-plus"></i> Add  Extra Option</a>
             <hr>
    </div>




</div>



<div class="row gaurav-delete-option">
  <div class="col-md-4">
        <strong> Name</strong>
    </div>
    <div class="col-md-4">
        <strong>Rate</strong>
    </div>
    <div class="col-md-2">
        <strong>Status</strong>
    </div>
    <div class="col-md-2">
        <strong>Action</strong>
    </div>
    
    <div class="col-md-12">
        <br>
    </div>
</div>
<div id="option-area-section">
    <?php if(isset($data)): ?>
            
        <?php $__currentLoopData = App\Models\PropertyExtraOptionRate::where("property_id",$data->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="option_id[]" value="<?php echo e($c->id); ?>">
            <div class="row gaurav-delete-option">
                <div class="col-md-4">
                    <?php echo Form::text("option_name[]",$c->option_name,["required","class"=>"form-control","placeholder"=>" Name"]); ?>

                </div>
                <div class="col-md-4">
                    <?php echo Form::text("option_rate[]",$c->option_rate,["required","class"=>"form-control","placeholder"=>" Rate"]); ?>

                </div>
                
                <div class="col-md-2">
                    <?php echo Form::select("option_status[]",["active"=>"active","deactive"=>"deactive"],$c->option_status,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-fee-option-delete-db btn btn-danger " data-id="<?php echo e($c->id); ?>" ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
    <?php endif; ?>
</div>




<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/option.blade.php ENDPATH**/ ?>