
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="Payments";$route="payments";
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
            $addbar=["name"=>$name,"add-data"=>false,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create')];
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
                        <th> #</th>
                        <th>Booking ID</th>
                        <th>Property Name</th>
                        <th>Customer Name</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Tran ID</th>
                        <th>Request of Date</th>
                      
                        
                 
                    </tr>
                </thead>
                <tbody>
                        <?php $sno=1;?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $booking=App\Models\BookingRequest::find($client->booking_id);
                        ?>
                        <tr>
                           
                            <td><?php echo e($sno++); ?></td>
                            <td>
                                <?php echo e($booking->id ?? 'Booking Not Available'); ?>

                            </td>

                            <?php
                                if($booking)
                                $property=App\Models\Property::find($booking->property_id);
                            ?>
                            <td> 
                                <?php echo e($property->name ?? 'Property Not Available'); ?>

                            </td>
                            <td> 
                                <?php echo e($booking->name ?? 'Booking Not Available'); ?>

                            </td>
                            <td>
                                <?php echo e($client->type); ?>

                            </td>
                            <td>
                                <?php echo e($client->amount); ?>

                            </td>
                            <td>
                                <?php echo e($client->tran_id); ?>

                            </td>
                            <td>
                                <?php echo e($client->created_at); ?>

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
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/payments/index.blade.php ENDPATH**/ ?>