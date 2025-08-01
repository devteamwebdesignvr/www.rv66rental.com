<div class="row" >
	<div class="col-md-12">
		<a href="javascript:;" class="add-space-data btn btn-info"><i class="fa fa-plus"></i> Add Property Space</a>
		 	 <hr>
	</div>




</div>
<div class="row gaurav-delete-property">
    <div class="col-md-4">
        <strong>Space Name</strong>
    </div>
    <div class="col-md-4">
        <strong>Image</strong>
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
<div id="space-area-section">
    <?php if(isset($data)): ?>
<?php $__currentLoopData = App\Models\PropertySpace::where("property_id",$data->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row gaurav-delete-property-space">
        <input type="hidden" name="space_id[]" value="<?php echo e($c->id); ?>" >
                <div class="col-md-4">
                    <?php echo Form::text("space_name[]",$c->space_name,["required","class"=>"form-control","placeholder"=>"Space Name"]); ?>

                </div>
            
                <div class="col-md-4">
                    <?php echo Form::file("space_image[]",["class"=>"form-control"]); ?>

                    <?php if($c->space_image): ?>
                    <img src="<?php echo e(asset($c->space_image)); ?>" style="height:100px;" >
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::select("space_status[]",["active"=>"active","deactive"=>"deactive"],$c->space_status,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-space-data-from-db btn btn-danger " data-id="<?php echo e($c->id); ?>" ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</div>




<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/space.blade.php ENDPATH**/ ?>