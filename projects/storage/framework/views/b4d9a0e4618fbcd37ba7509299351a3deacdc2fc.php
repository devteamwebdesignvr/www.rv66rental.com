
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="RV/Vehicle";$route="properties";
?>            
<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e($name); ?> Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php 
            $addbar=["name"=>$name,"add-data"=>true,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create'),"refresh-calander-data"=>"true"];
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
              <h3 class="card-title"><?php echo e($name); ?> Listing</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data-table-gaurav" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>SEO URL</th>
                        <th>Status</th>
                        <th>Instant Booking</th>
                        <th>Calender</th>
                        <th>Rates</th>
                        
                    
                        <th>Created</th>
                        <th>Last Updated</th>
                      
              
                        
                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $sno=1;?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           
                             <td> <?php echo e($sno++); ?></td>
                            <td>
                                <?php echo e($client->name); ?>

                            </td>
                            <td>
                                <?php echo e($client->seo_url); ?>

                            </td>
                            <td>
                                <?php if($client->status == "true"): ?>
                                    <i class="fa fa-check text-success"></i>
                                <?php else: ?>
                                    <i class="fa fa-times text-danger"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($client->instant_booking_button == "true"): ?>
                                    <i class="fa fa-check text-success"></i>
                                <?php else: ?>
                                    <i class="fa fa-times text-danger"></i>
                                <?php endif; ?>
                            </td>

                            
                             <td>
                                 <a href="<?php echo e(route('properties-calendar.index',$client->id)); ?>" class="btn btn-success btn-block btn-xs raw-margin-right-8">View Calender</a>
                            </td>
                            <td>
                                   <a href="<?php echo e(route('properties-rates',[$client->id])); ?>" class="btn btn-warning btn-block btn-xs raw-margin-right-8"><i class="fa fa-eye"></i>  Rates</a>
                            </td>
                          
                         
                        
                            <td>
                                <?php echo e(date('d-F-Y',strtotime($client->created_at))); ?>

                            </td>
                        
                            <td>
                                <?php echo e(date('d-F-Y',strtotime($client->updated_at))); ?>

                            </td>
                        
                            
                   
                           
                        
                            <td>

                                <a href="<?php echo route($route.'.edit', [$client->id]); ?>" 
                                          class="btn btn-success btn-xs raw-margin-right-8 btn-block"><i
                                            class="fa fa-pencil-alt"></i> Edit </a>


                                <a href="<?php echo route($route.'.copyData', [$client->id]); ?>" 
                                            onclick="return confirm('Are you sure you want to copy this <?php echo e($name); ?>?')" class="d-none btn btn-info btn-xs raw-margin-right-8 btn-block"><i
                                            class="fa fa-copy"></i> Copy </a>
                                <?php if($client->status=="true"): ?>

                                    <a href="<?php echo route($route.'.deactive', [$client->id]); ?>" 
                                            onclick="return confirm('Are you sure you want to deactive this <?php echo e($name); ?>?')" class="btn btn-warning btn-xs raw-margin-right-8 btn-block"><i
                                            class="fa fa-times"></i>Deactive </a>
                                <?php else: ?>
                                     <a href="<?php echo route($route.'.active', [$client->id]); ?>" 
                                            onclick="return confirm('Are you sure you want to active this <?php echo e($name); ?>?')" class="btn btn-outline-warning btn-xs raw-margin-right-8 btn-block"><i
                                            class="fa fa-check"></i>Active </a>
                                <?php endif; ?>
                                <form method="post" class="d-none" action="<?php echo route($route.'.destroy', [$client->id]); ?>"
                                      style="margin-top: 5px;">
                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit" class="btn btn-danger btn-block btn-xs raw-margin-right-8"
                                            onclick="return confirm('Are you sure you want to delete this <?php echo e($name); ?>, Destroy All child data?')"><i
                                                class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                                
                              
                              <br>
                            
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
           
              </table>
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
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<script>
  
  $("#data-table-gaurav").DataTable({"lengthMenu": [[ 50, -1], [ 50, "All"]],dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row'<'col-sm-5'i><'col-sm-7'p>>",});

 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/index.blade.php ENDPATH**/ ?>