
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="Properties Calendar Import";$route="properties-calendar";
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
            $addbar=[
            "name"=>$name,
            "add-data"=>true,
            "add-name"=>"Add ". Str::singular($name),
            "add-anchor"=>route($route.'.create',[$property_id]),
            "back-anchor"=>route('properties-calendar.index',[$property_id]),
            "refresh-calander-data"=>true
            ];
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
                        
                        <th>Ical Link</th>
               
                        
                        <th>Created At</th>
                        
                     
                        <th  >Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $sno=1;?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           
                            <td><?php echo e($sno++); ?></td>

                       
                            <td><?php echo e($client->ical_link); ?></td>
                         
                            
                            <td><?php echo e($client->created_at); ?></td>
                        
                            
                            
                            <td  >
                                <a href="<?php echo route($route.'.importlistRefresh', [$property_id,$client->id]); ?>" class="btn btn-outline-info btn-xs raw-margin-right-8"> <span class="fa fa-retweet"></span> Refresh</a>
                               
                                <form method="post"  action="<?php echo route($route.'.destroy', [$property_id,$client->id]); ?>"
                                      >
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
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties-calendar/importlist.blade.php ENDPATH**/ ?>