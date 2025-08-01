<?php $__env->startSection('title', 'Admin '); ?>

<?php $__env->startSection('content_header'); ?>
        <h1 class="m-0 text-dark">Change Password </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>

<?php echo Form::open(['route' => 'change-password-admin','files'=>true]); ?>

<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
      
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
                <div class="row">
                  
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("old password"); ?>

                            <?php echo Form::text("old_password",null,["class"=>"form-control","required"=>"required"]); ?>

                            <span class="text-danger"><?php echo e($errors->first("old_password")); ?></span>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label("New Password"); ?>

                            <?php echo Form::text("new_password",null,["class"=>"form-control","required"=>"required"]); ?>

                            <span class="text-danger"><?php echo e($errors->first("new_password")); ?></span>
                        </div>
                    </div>
                </div>
                
               
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-success"><span class="fa fa-save"></span> Save</button>
      </div>

    </div>
</div>
  <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/dashboard/changePassword.blade.php ENDPATH**/ ?>