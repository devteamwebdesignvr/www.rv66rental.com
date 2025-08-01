

<?php $__env->startSection('title', 'Admin '); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark">Settings</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
		<?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Main</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Social Media</a>
                  </li>
                  <li class="nav-item d-none">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Mail</a>
                  </li>
                  <li class="nav-item d-none">
                    <a class="nav-link" id="custom-tabs-three-admin-tab" data-toggle="pill" href="#custom-tabs-three-admin" role="tab" aria-controls="custom-tabs-three-admin" aria-selected="false">API </a>
                  </li>
                  <li class="nav-item d-none">
                    <a class="nav-link" id="custom-tabs-three-artisan-tab" data-toggle="pill" href="#custom-tabs-three-artisan" role="tab" aria-controls="custom-tabs-three-artisan" aria-selected="false">Booking Setting</a>
                  </li>
              
                </ul>
              </div>
              <?php echo Form::open(["files"=>"true"]); ?>

              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <?php echo $__env->make("admin.dashboard.sub.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                     <?php echo $__env->make("admin.dashboard.sub.social", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                     <?php echo $__env->make("admin.dashboard.sub.mail", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-admin" role="tabpanel" aria-labelledby="custom-tabs-three-admin-tab">
                     <?php echo $__env->make("admin.dashboard.sub.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-artisan" role="tabpanel" aria-labelledby="custom-tabs-three-artisan-tab">
                     <?php echo $__env->make("admin.dashboard.sub.artisan", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                
                </div>
                <div class="alert"></div>
                <button class="btn btn-success" type="submit" ><i class="fa fa-save"></i> Save</button>
              </div>
              <?php echo Form::close(); ?>

              <!-- /.card -->
            </div>
          </div>
    

<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>

<script>
  $(function(){
    
    //CKEDITOR.replace( "input['booking-second-data']",{ allowedContent:true} );
  });

   $(document).on("click",".nav-item",function(){
      var target_gaurav=$(this).find(".nav-link").attr("id");
      document.cookie = "target_jhon_data1="+target_gaurav;
  });


  <?php if(isset($_COOKIE['target_jhon_data1'])): ?>
    $(function(){
      $("#<?php echo e($_COOKIE['target_jhon_data1']); ?>").click();
    })
  <?php endif; ?>
</script>

<script>
//Swal.fire('Good job!','You clicked the button!','success')
<?php if(ModelHelper::getDataFromSetting('payment_interval')): ?>
    <?php if(ModelHelper::getDataFromSetting('payment_interval')==2): ?>
        $("#second-payment").removeClass("d-none");
    <?php endif; ?>
    <?php if(ModelHelper::getDataFromSetting('payment_interval')==3): ?>
        $("#second-payment").removeClass("d-none");
        $("#third-payment").removeClass("d-none");
        
        $("#third-second-payment").removeClass("d-none");
    <?php endif; ?>
<?php endif; ?>

$(document).on("change","#payment_interval",function(){
    if($(this).val()==1){
        $("#second-payment").addClass("d-none");
        $("#third-payment").addClass("d-none");
        $("#third-second-payment").addClass("d-none");
    }
    if($(this).val()==2){
        $("#second-payment").removeClass("d-none");
        $("#third-payment").addClass("d-none");
        $("#third-second-payment").addClass("d-none");
    }
    if($(this).val()==3){
        $("#second-payment").removeClass("d-none");
        $("#third-payment").removeClass("d-none");
        $("#third-second-payment").removeClass("d-none");
    }
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/dashboard/setting.blade.php ENDPATH**/ ?>