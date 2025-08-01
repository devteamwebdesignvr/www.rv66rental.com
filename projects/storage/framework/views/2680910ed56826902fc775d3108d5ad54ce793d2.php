
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name=" Property Rates";$route="properties-rates";
?>            
<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><span class="badge badge-primary"><?php echo $property->name; ?></span> <i class='fa fa-arrow-right'></i>  <?php echo $name; ?>  Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php 
            $addbar=["name"=>$name,"add-data"=>true,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create',[$property_id]),"back-anchor"=>route('properties.index')];
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
              <h3 class="card-title"><span class="badge badge-primary"><?php echo $property->name; ?></span> <i class='fa fa-arrow-right'></i>  <?php echo $name; ?>  Listing</h3>
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
                        
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Name</th>
                        <th>Type of Price</th>
                        
                        
                        <th>Min Stay</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $sno=1;?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           
                            <td><?php echo e($sno++); ?></td>

                       
                            <td><?php echo e($client->start_date); ?></td>
                            
                            
                            <td><?php echo e($client->end_date); ?></td>
                            <td><?php echo e($client->name_of_price); ?></td>
                            
                            
                            
                            <td><?php echo e($client->type_of_price); ?></td>
                            <?php
                                $day=Helper::getWeekNameSelect();
                            ?>
                            <td><?php echo e($client->min_stay); ?></td>
                            <td><?php echo e($day[$client->checkin_day] ?? ''); ?></td>
                            <td><?php echo e($day[$client->checkout_day] ?? ''); ?></td>
                            
                           
                         
                            <td>
                                <a href="<?php echo route($route.'.edit', [$property_id,$client->id]); ?>" class="btn btn-outline-success btn-xs raw-margin-right-8 "><i
                                            class="fa fa-pencil-alt"></i> Edit</a>
                              
                                <form method="post" action="<?php echo route($route.'.destroy', [$property_id,$client->id]); ?>"
                                     style="display: inline-block;" >
                                    <?php echo csrf_field(); ?>

                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit" class="btn btn-outline-danger btn-xs raw-margin-right-8"
                                            onclick="return confirm('Are you sure you want to delete this <?php echo e($name); ?>, Destroy All child data?')"><i
                                                class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
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
  $("#data-table-gaurav").DataTable({"lengthMenu": [[ 50, -1], [ 50, "All"]]});
                   




</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties-rates/index.blade.php ENDPATH**/ ?>