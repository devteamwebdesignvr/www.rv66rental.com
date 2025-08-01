
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="Properties Calendar";$route="properties-calendar";
?>          
<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><span class="badge badge-primary"><?php echo $property->name; ?></span> <i class='fa fa-arrow-right'></i> <?php echo $name; ?> Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php 
            $addbar=["name"=>$name,"back-anchor"=>route($route.'.index',[$property_id]),"add-data"=>false];
          ?>
          <?php echo $__env->make("admin.common.add-bar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-12">
         
          <div class="card  ">
            <div class="card-header">
              <h3 class="card-title"><span class="badge badge-primary"><?php echo $property->name; ?></span> <i class='fa fa-arrow-right'></i> Create <?php echo e(Str::singular($name)); ?></h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <?php echo Form::open(['route' => [$route.'.store',[$property_id]],"files"=>"true"]); ?>

     
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label("ical_link"); ?>

                                <?php echo Form::text("ical_link",null,["class"=>"form-control","required"]); ?>

                                <span class="text-danger"><?php echo e($errors->first("ical_link")); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6 d-none">
                            <div class="form-group">
                                <?php echo Form::label("color"); ?>

                                <?php echo Form::select("color",["red"=>"red","orange"=>"orange","pink"=>"pink","brown"=>"brown","purple"=>"purple","yellow"=>"yellow"],null,["class"=>"form-control","required"]); ?>

                                <span class="text-danger"><?php echo e($errors->first("color")); ?></span>
                            </div>
                        </div>
                   
                      </div>
               
                    <button class="btn btn-success"><span class="fa fa-save"></span> Save</button>
                
                <?php echo Form::close(); ?>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties-calendar/create.blade.php ENDPATH**/ ?>