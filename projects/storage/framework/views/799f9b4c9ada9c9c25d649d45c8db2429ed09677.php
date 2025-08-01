
<div class="row" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-accessories-data btn btn-info"><i class="fa fa-plus"></i> Add  Accessories</a>
             <hr>
    </div>



</div>




<div class="row gaurav-delete-accessories">
      <div class="col-md-2">
        <strong> Name</strong>
    </div>
    <div class="col-md-2">
        <strong> Helping Text</strong>
    </div>
    <div class="col-md-2">
        <strong>Rate</strong>
    </div>
    <div class="col-md-2">
        <strong>Type</strong>
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
<div id="accessories-area-section">
    <?php if(isset($data)): ?>
        <?php $__currentLoopData = App\Models\PropertyAccessoriesRate::where("property_id",$data->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="accessories_id[]" value="<?php echo e($c->id); ?>">
                    <div class="row gaurav-delete-accessories">
                        <div class="col-md-2">
                            <?php echo Form::text("accessories_name[]",$c->accessories_name,["required","class"=>"form-control","placeholder"=>" Name"]); ?>

                        </div>
                        <div class="col-md-2">
                            <?php echo Form::text("accessories_helping_text[]",$c->accessories_helping_text,["required","class"=>"form-control","placeholder"=>" Helping Text"]); ?>

                        </div>
                        <div class="col-md-2">
                            <?php echo Form::text("accessories_rate[]",$c->accessories_rate,["required","class"=>"form-control","placeholder"=>" Rate"]); ?>

                        </div>

                        <div class="col-md-2">
                            <?php echo Form::select("accessories_type[]",["per night"=>"Per Night","per person"=>"Per Person","per stay"=>"Per Stay"],$c->accessories_type,["required","class"=>"form-control"]); ?>

                        </div>
                        
                        <div class="col-md-2">
                            <?php echo Form::select("accessories_status[]",["active"=>"active","deactive"=>"deactive"],$c->accessories_status,["required","class"=>"form-control"]); ?>

                        </div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="delete-fee-accessories-delete-db btn btn-danger " data-id="<?php echo e($c->id); ?>" ><i class="fa fa-trash"></i> </a>
                        </div>
                        
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
    <?php endif; ?>
</div>




<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/accessories.blade.php ENDPATH**/ ?>