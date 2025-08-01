<?php $__env->startSection('title', 'Admin'); ?>
<?php 
    $name="Booking Enquiries";$route="booking-enquiries";
?>           
<?php $__env->startSection('content_header'); ?>
    <h1 class="m-0 text-dark"><?php echo e($name); ?> Management</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php 
            $addbar=["name"=>$name,"add-data"=>false,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create'),"back-anchor"=>route($route.'.index')];
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
              <h3 class="card-title">Edit <?php echo e(Str::singular($name)); ?></h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <?php echo Form::model($data,['route' => [$route.'.update',$data->id],"files"=>"true","method"=>"put","id"=>"web-form-data"]); ?>

     
                    <?php echo $__env->make("admin.".$route.".edit-form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               
                    <button class="btn btn-success"><span class="fa fa-save"></span> Update</button>
                
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
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 <script>
   var checkin = '';
    var checkout = '';
     $(function(){
       //alert('hello')
        data={_token:"<?php echo e(csrf_token()); ?>",id:$("#property-selector").val()};
        url="<?php echo e(route('get-checkin-checkout-data-gaurav')); ?>";
        $.post(url,data,function(data){
           //console.log(data); 
              checkin = data.checkin;
              checkout = data.checkout;
            
                $("#txtFrom").datepicker({
                    numberOfMonths: 1,
                    minDate: '@minDate',
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [checkin.indexOf(string) == -1];
        
                    },
        
                    onSelect: function(selected) {
                        $("#submit-button-gaurav-data").hide();
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() + 1);
                        $("#txtTo").datepicker("option", "minDate", dt);
                        $("#txtTo").val('');
                    },
                    onClose: function() {
                        $("#txtTo").datepicker("show");
                    }
                });
        
                $("#txtTo").datepicker({
                    numberOfMonths: 1,
                    dateFormat: 'yy-mm-dd', 
                    beforeShowDay: function(date) {
        
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        
                        return [checkout.indexOf(string) == -1]
        
                    },
        
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#txtFrom").datepicker("option", "maxDate", dt);
                       ajaxCallingData();
        
                    },
                    onClose: function() {
                        $('.popover-1').addClass('opened');
                    }
                });
                
               // ajaxCallingData();
    
        });
     });
       $(document).on("change","#property-selector",function(){
       $("#txtFrom").val(''),
       $("#txtTo").val(''),  
         
        data={_token:"<?php echo e(csrf_token()); ?>",id:$(this).val()};
        url="<?php echo e(route('get-checkin-checkout-data-gaurav')); ?>";
        $.post(url,data,function(data){
             //alert('ok')
              console.log(data.checkin); 
              console.log(data.checkout); 
              checkin = [];
              checkout = [];
              checkin = data.checkin;
              checkout = data.checkout;
          
               ajaxCallingData();
            
                $("#txtFrom").datepicker({
                    numberOfMonths: 1,
                    minDate: '@minDate',
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [checkin.indexOf(string) == -1];
        
                    },
        
                    onSelect: function(selected) {
                        $("#submit-button-gaurav-data").hide();
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() + 1);
                        $("#txtTo").datepicker("option", "minDate", dt);
                        $("#txtTo").val('');
                    },
                    onClose: function() {
                        $("#txtTo").datepicker("show");
                    }
                });
        
                $("#txtTo").datepicker({
                
                    numberOfMonths: 1,
                    dateFormat: 'yy-mm-dd', 
                    beforeShowDay: function(date) {
        
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        
                        return [checkout.indexOf(string) == -1]
        
                    },
        
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#txtFrom").datepicker("option", "maxDate", dt);
                        ajaxCallingData();
        
                    },
                    onClose: function() {
                        $('.popover-1').addClass('opened');
                    }
                });
          
             
    
        });
     });
     
     

     
     
    function ajaxCallingData(){
        //alert('hekllo')
        pet_fee_data_guarav=$("#pet_data").val();
        adults=$("#adult_data").val();
        childs=$("#child_data").val();
        if($("#property-selector").val()!=""){
             if($("#txtFrom").val()!=""){
                 if($("#txtTo").val()!=""){
                    if($("#adult_data").val()>0){
                         url='<?php echo e(route("admin-checkajax-get-quote-edit")); ?>?property_id:'+$("#property-selector").val();
                        data={
                            start_date:$("#txtFrom").val(),
                            end_date:$("#txtTo").val(),
                            pet_fee_data_guarav:pet_fee_data_guarav,
                            adults:adults,
                            childs:childs,
                            book_sub:true,
                            property_id:$("#property-selector").val(),
                            extra_discount:$("#extra-discount").val(),
                            coupon_discount:$("#coupon_discount").val(),
                            coupon_discount_code:$("#coupon_discount_code").val()
                        };
                        data=$("#web-form-data").serialize();
                         $.post(url,data,function(data){
                            if(data.status==400){
                                $("#submit-button-gaurav-data").hide();
                                toastr.error(data.message);
                            }else{
                               $("#pricedata-gaurav").html(data.data_view);
                            }
                        });
                    }
                 }
             }  
        }
    }
    $(document).on("change","#adult_data,#child_data,#pet_data",function(){
        ajaxCallingData();
    });
    
    $(document).on("keyup","#extra-discount,.product_name,.product_amount",function(){
        ajaxCallingData();
    });

    
 </script>
 <script>
    $(document).on("change",".common-field-show-rate",function(){
        var target=$(this).data("target");
        console.log(target)
        $("#"+target).val(0);
        $("#"+target).toggleClass("d-none");
        ajaFunction();
    });
</script>

<script>
$(document).on("blur",".rate-calculateion-data",function(){
    ajaFunction();
});

function ajaFunction(){
    <?php if(Request::get("coupon")): ?>
    url="<?php echo e(route('admin-checkajax-get-quote-edit')); ?>?coupon=<?php echo e(Request::get('coupon')); ?>";
    <?php else: ?>
    url='<?php echo e(route("admin-checkajax-get-quote-edit")); ?>?property_id:'+$("#property-selector").val();
    <?php endif; ?>
    data=$("#web-form-data").serialize();

    $.post(url,data,function(data){
       // console.log(data)
        $("#pricedata-gaurav").html(data.data_view);
     
    });
}


    $(document).on("click",".delete-space-data",function(){
        $(this).parents(".gaurav-delete-property-space").remove();
    });
    $(document).on("click",".add-space-data",function(){
        html=`
            <div class="row gaurav-delete-property-space">
                
                <div class="col-md-1">
                    <a href="javascript:;" class="delete-space-data btn btn-danger btn-xs" ><i class="fa fa-times"></i> </a>
                </div>
                <div class="col-md-8">
                    <?php echo Form::text("product_name[]",null,["required","class"=>"form-control product_name","placeholder"=>"Name"]); ?>

                </div>
                
                <div class="col-md-3">
                    <?php echo Form::text("product_amount[]",null,["class"=>"form-control product_amount","required","placeholder"=>"Amount"]); ?>

                </div>
                
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;
        $("#space-area-section").append(html);
        //alert("hi")
    });

      
    $(document).on("change","#booking-selector",function(){
        if($("#booking-selector").val()=="invoice"){
            $("#gaurav-data-new-logic").removeClass("d-none");
        }else{
            $("#gaurav-data-new-logic").addClass("d-none");
            $("#pricedata-gaurav").html(null);
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/booking-enquiries/edit.blade.php ENDPATH**/ ?>