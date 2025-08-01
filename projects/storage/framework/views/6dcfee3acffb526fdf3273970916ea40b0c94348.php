
<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name=" Property Rates";$route="properties-rates";
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
            $addbar=["name"=>$name,"add-data"=>true,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create',[$property_id]),"back-anchor"=>route($route,[$property_id])];
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

     
                    <?php echo $__env->make("admin.".$route.".form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               
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
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {

  $('#datepicker,#datepicker1').daterangepicker({
    opens: 'left',autoUpdateInput: false
  }, function(start, end, label) {
    $("#datepicker").val(start.format('YYYY-MM-DD'))
    $("#datepicker1").val(end.format('YYYY-MM-DD'))
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
<script >
  $( function() {
    // $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    // $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
 var default1=` <div class="row default">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo Form::label("price"); ?>

                <?php echo Form::number("price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("price")); ?></span>
            </div>
        </div>
        <div class="col-md-6 d-none">
            <div class="form-group">
                <?php echo Form::label("base_price"); ?>

                <?php echo Form::number("base_price",null,["class"=>"form-control","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("base_price")); ?></span>
            </div>
        </div>
    </div>
  `;
 var  weekly=`
   


     <div class="row default">
        
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label("monday_price"); ?>

                <?php echo Form::number("monday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("monday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label("tuesday_price"); ?>

                <?php echo Form::number("tuesday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("tuesday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label("wednesday_price"); ?>

                <?php echo Form::number("wednesday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("wednesday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("thrusday_price"); ?>

                <?php echo Form::number("thrusday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("thrusday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("friday_price"); ?>

                <?php echo Form::number("friday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("friday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("saturday_price"); ?>

                <?php echo Form::number("saturday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("saturday_price")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("sunday_price"); ?>

                <?php echo Form::number("sunday_price",null,["class"=>"form-control","required","min"=>"0"]); ?>

                <span class="text-danger"><?php echo e($errors->first("sunday_price")); ?></span>
            </div>
        </div>
    </div>
  `;
$(document).on("click","#type_of_price",function(){
 

  if($(this).val()=="default"){
    $("#price-section").html(default1);
  }else if($(this).val()=="weekly"){
    $("#price-section").html(weekly);
  }else{
      $("#price-section").html('');
  }
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties-rates/create.blade.php ENDPATH**/ ?>