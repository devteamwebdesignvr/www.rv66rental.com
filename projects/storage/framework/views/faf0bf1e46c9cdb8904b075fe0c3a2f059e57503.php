
<a href="<?php echo e(route('properties-group-amenities'.'.create', [$data->id])); ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add Amenity Group </a>
<br>
<div class="alert"></div>
<table  class="table table-bordered table-striped">
<thead>
    <tr>
        <th>#</th>
        
        <th>Group Name</th>
        <th>Status</th>
        <th>Sorting</th>
        <th>Image</th>
        <th>Amenity </th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
        <?php $sno=1; $property_id=$data->id;?>
    <?php $__currentLoopData = App\Models\PropertyAmenityGroup::where("property_id",$data->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
           
            <td><?php echo e($sno++); ?></td>

       
            <td><?php echo e($client->name); ?></td>
            
            <td>
                <?php if($client->status == "true"): ?>
                    <i class="fa fa-check text-success"></i>
                <?php else: ?>
                    <i class="fa fa-times text-danger"></i>
                <?php endif; ?>
            </td>
            <td><?php echo e($client->sorting); ?></td>
            
            <td>
                <?php if($client->image): ?>
                    <img src="<?php echo e(asset($client->image)); ?>" width="100"> 
                <?php endif; ?>
            </td>
            <td>
                <?php $__currentLoopData = App\Models\PropertyAmenity::where("property_amenity_id",$client->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge badge-warning"><?php echo e($c->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr>
                  <a href="<?php echo route('properties-amenities', [$property_id,$client->id]); ?>" class="btn btn-success btn-xs raw-margin-right-8 "><i
                            class="fa fa-plus"></i> Amenities</a>
            </td>
            <td>
                <a href="<?php echo route('properties-group-amenities'.'.edit', [$property_id,$client->id]); ?>" class="btn btn-outline-success btn-xs raw-margin-right-8 btn-block"><i
                            class="fa fa-pencil-alt"></i> Edit</a>
                <?php if($client->status == "true"): ?>
                    <a href="<?php echo route('properties-group-amenities'.'.deactive', [$property_id,$client->id]); ?>" class="btn btn-warning btn-xs raw-margin-right-8 btn-block"><i
                            class="fa fa-times"></i> Deactive</a>
                <?php else: ?>
                    <a href="<?php echo route('properties-group-amenities'.'.active', [$property_id,$client->id]); ?>" class="btn btn-warning btn-xs raw-margin-right-8 btn-block"><i
                            class="fa fa-check"></i> Active</a>
                <?php endif; ?>
                <br>
           
               
                    <a href="<?php echo e(route('properties-group-amenities'.'.destroy', [$property_id,$client->id])); ?>" class="btn btn-outline-danger btn-xs raw-margin-right-8  btn-block"
                            onclick="return confirm('Are you sure you want to delete this Amenities Group, Destroy All child data?')"><i
                                class="fa fa-trash"></i> Delete
                    </a>
               
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/amenities.blade.php ENDPATH**/ ?>