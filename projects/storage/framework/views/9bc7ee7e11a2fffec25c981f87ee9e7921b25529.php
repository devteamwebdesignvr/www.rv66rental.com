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
               <?php echo Form::model($data,['route' => [$route.'.update',$data->id],"files"=>"true","method"=>"put"]); ?>

     
                    <?php echo $__env->make("admin.".$route.".form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               
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

<?php $__env->startSection("css"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('drag-drop-image-uploader/src/image-uploader.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .gaurav-class{
    border:1px solid black;
    margin:10px;
    padding: 10px;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo e(asset('drag-drop-image-uploader/src/image-uploader.js')); ?>"></script>
<script>
  $(function(){


      var dropIndex;
      $("#image-list").sortable({
            update: function(event, ui) { 
              dropIndex = ui.item.index();
          }
      });
       $('#submit').click(function (e) {
          
            var captionIdsArray = [];
            $('#image-list .gaurav-class input').each(function (index) {
                    
                    var id = $(this).attr('id');
                    var split_id = id.split("_");
                    captionIdsArray.push({"id":split_id[1],"value":$(this).val()});
             
            });
            console.log(captionIdsArray)
            $.ajax({
                url: '<?php echo e(route("update-property-caption-and-sorting")); ?>',
                type: 'post',
                data: {captionidsarray: captionIdsArray,_token:"<?php echo e(csrf_token()); ?>"},
                success: function (response) {
                   $("#txtresponse").css('display', 'inline-block'); 
                   $("#txtresponse").text(response);
                }
            });
            e.preventDefault();
        });
     CKEDITOR.replace( 'short_description',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );

     CKEDITOR.replace( 'long_description',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );

     CKEDITOR.replace( 'cancellation_policy',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );

     CKEDITOR.replace( 'booking_policy',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );

     CKEDITOR.replace( 'notes',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );
     
     CKEDITOR.replace( 'welcome_package_description',{ allowedContent:true,filebrowserUploadUrl: "<?php echo e(route('ckeditor.upload', ['_token' => csrf_token() ])); ?>",
        filebrowserUploadMethod: 'form'} );

        $('.input-images-2').imageUploader({
      
            imagesInputName: 'images',
            extensions:['.jpg', '.jpeg', '.png', '.gif', '.svg','.webp'],
            mimes:['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml' ,'image/webp']
        });
  });


  
  $(document).on("click",".delete-image-product",function(){
    
      $id=$(this).data("id");
      data={_token:"<?php echo e(csrf_token()); ?>",id:$id};
      $that=$(this);
      url="<?php echo e(route('image-delete-asset')); ?>";
      $.post(url,data,function(data){
          $that.parent('div').parent('div').remove();
      });
  });
  
    $(document).on("click",".nav-item",function(){
      var target_gaurav=$(this).find(".nav-link").attr("id");
      document.cookie = "target_jhon_data="+target_gaurav;
  });


  <?php if(isset($_COOKIE['target_jhon_data'])): ?>
    $(function(){
      $("#<?php echo e($_COOKIE['target_jhon_data']); ?>").click();
    })
  <?php endif; ?>
</script>

  
<script>
    $(document).on("click",".delete-fee-data",function(){
        $(this).parents(".gaurav-delete-property").remove();
    });

    $(document).on("click",".add-fee-data",function(){
        html=`
            <div class="row gaurav-delete-property">
                <div class="col-md-2">
                    <?php echo Form::text("fee_name[]",null,["required","class"=>"form-control","placeholder"=>"Fee Name"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::text("fee_rate[]",null,["required","class"=>"form-control","placeholder"=>"Fee Rate"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::select("fee_type[]",["Percentage"=>"Percentage","Excat"=>"Excat"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::select("fee_apply[]",["total"=>"Total Amount","gross"=>"Gross Total"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::select("fee_status[]",["active"=>"active","deactive"=>"deactive"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-fee-data btn btn-danger " ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;

        $("#fee-area-section").append(html);
    });

    $(document).on("click",".delete-fee-accessories",function(){
        $(this).parents(".gaurav-delete-accessories").remove();
    });

    $(document).on("click",".add-accessories-data",function(){
        html=`
            <div class="row gaurav-delete-accessories">
                <div class="col-md-2">
                    <?php echo Form::text("accessories_name[]",null,["required","class"=>"form-control","placeholder"=>" Name"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::text("accessories_helping_text[]",null,["required","class"=>"form-control","placeholder"=>" Helping Text"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::text("accessories_rate[]",null,["required","class"=>"form-control","placeholder"=>" Rate"]); ?>

                </div>
                
                <div class="col-md-2">
                    <?php echo Form::select("accessories_type[]",["per night"=>"Per Night","per person"=>"Per Person","per stay"=>"Per Stay"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::select("accessories_status[]",["active"=>"active","deactive"=>"deactive"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-fee-accessories btn btn-danger " ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;

        $("#accessories-area-section").append(html);
    });


    $(document).on("click",".delete-fee-milleage",function(){
        $(this).parents(".gaurav-delete-milleage").remove();
    });

    $(document).on("click",".add-milleage-data",function(){
        html=`
            
               <div class="row gaurav-delete-milleage">
               
            
            
            <div class="col-md-3">
                    <?php echo Form::text("milleage_name[]",null,["required","class"=>"form-control","placeholder"=>" Name"]); ?>

                </div>
                <div class="col-md-1">
                    <?php echo Form::text("milleage_rate[]",null,["required","class"=>"form-control","placeholder"=>" Rate"]); ?>

                </div>
                <div class="col-md-1">
                    <?php echo Form::text("milleage_free[]",null,["class"=>"form-control","placeholder"=>" Free"]); ?>

                </div>
                <div class="col-md-4">
					<?php echo Form::select("milleage_format[]",["millage"=>"Millage","generator_hour"=>"Generator Hours"],null,["required","class"=>"form-control"]); ?>

                </div>
                
                <div class="col-md-2">
                    <?php echo Form::select("milleage_status[]",["active"=>"active","deactive"=>"deactive"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-1">
                  
                    <a href="javascript:;" class="delete-fee-milleage btn btn-danger "  ><i class="fa fa-trash"></i> </a>
               
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
                 </div>
        `;

        $("#milleage-area-section").append(html);
    });




    $(document).on("click",".delete-fee-option",function(){
        $(this).parents(".gaurav-delete-option").remove();
    });

    $(document).on("click",".add-option-data",function(){
     
        html=`
            
            <div class="row gaurav-delete-option">
                <div class="col-md-4">
                    <?php echo Form::text("option_name[]",null,["required","class"=>"form-control","placeholder"=>" Name"]); ?>

                </div>
                <div class="col-md-4">
                    <?php echo Form::text("option_rate[]",null,["required","class"=>"form-control","placeholder"=>" Rate"]); ?>

                </div>
                
                <div class="col-md-2">
                    <?php echo Form::select("option_status[]",["active"=>"active","deactive"=>"deactive"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-fee-option btn btn-danger " ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;

        $("#option-area-section").append(html);
    });



    $(document).on("click",".delete-space-data",function(){
        $(this).parents(".gaurav-delete-property-space").remove();
    });

    $(document).on("click",".add-space-data",function(){
        html=`
            <div class="row gaurav-delete-property-space">
                <div class="col-md-4">
                    <?php echo Form::text("space_name[]",null,["required","class"=>"form-control","placeholder"=>"Space Name"]); ?>

                </div>
            
                <div class="col-md-4">
                    <?php echo Form::file("space_image[]",["class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <?php echo Form::select("space_status[]",["active"=>"active","deactive"=>"deactive"],null,["required","class"=>"form-control"]); ?>

                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-space-data btn btn-danger " ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;

        $("#space-area-section").append(html);
    });


    $(document).on("click",".delete-fee-milleage-delete-db",function(){
        var that=$(this);
        if(confirm("Are you sure want to delete?")){
            url="<?php echo e(route('deleteMillage')); ?>";
            data={_token:"<?php echo e(csrf_token()); ?>",id:$(this).data("id")};
            $.post(url,data,function(data){
                that.parents(".gaurav-delete-milleage").remove();
            });
        }
    });



    $(document).on("click",".delete-fee-option-delete-db",function(){
        var that=$(this);
        if(confirm("Are you sure want to delete?")){
            url="<?php echo e(route('deleteoption')); ?>";
            data={_token:"<?php echo e(csrf_token()); ?>",id:$(this).data("id")};
            $.post(url,data,function(data){
                that.parents(".gaurav-delete-option").remove();
            });
        }
    });

    $(document).on("click",".delete-fee-accessories-delete-db",function(){
        var that=$(this);
        if(confirm("Are you sure want to delete?")){
            url="<?php echo e(route('deleteaccessories')); ?>";
            data={_token:"<?php echo e(csrf_token()); ?>",id:$(this).data("id")};
            $.post(url,data,function(data){
                that.parents(".gaurav-delete-accessories").remove();
            });
        }
    });



</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/edit.blade.php ENDPATH**/ ?>