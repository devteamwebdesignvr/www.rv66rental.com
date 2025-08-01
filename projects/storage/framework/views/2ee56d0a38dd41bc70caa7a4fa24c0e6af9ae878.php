

<?php $__env->startSection("css"); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo e(asset('toastr/toastr.css')); ?>">
<style>
    .table td, .table th {
        padding: 6px;
        font-size: 14px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="<?php echo e(asset("ckeditor/ckeditor.js")); ?>"></script>
<script src="<?php echo e(asset("toastr/toastr.js")); ?>"></script>
<script>
$(function(){


    <?php if(Session::has("success")): ?>
        toastr.success("<?php echo e(Session::get("success")); ?>");
    <?php endif; ?>
    <?php if(Session::has("danger")): ?>
        toastr.error("<?php echo e(Session::get("danger")); ?>");
    <?php endif; ?>

    $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
 $(document).on("change",".all-select",function(){

    select=$(this).prop("checked");
    if(select){
        $(".single-select").each(function(){
            $(this).prop("checked",true);
        });
    }else{
        $(".single-select").each(function(){
            $(this).prop("checked",false);
        });
    }
});


$(document).on("change",".single-select",function(){
    flag=0;
    $(".single-select").each(function(){
        if($(this).prop("checked")){

        }else{
            flag=1;
        }
    });
    if(flag==1){
        $(".all-select").prop("checked",false);
    }else{
        $(".all-select").prop("checked",true);
    }
})

function ajaxCallCheckBoxDelete(url,indexPage,indexName){
    id=[];
        flag=0;
        $(".single-select").each(function(){
            if($(this).prop("checked")){
                id.push($(this).val());
            }else{
                flag=1;
            }
        });
        if(id.length>0){
            if(confirm("Are you sure you want to delete this "+indexName+"?")){
                
                data={_token:"<?php echo e(csrf_token()); ?>",id:id};
                $.post(url,data,function(data){
                    if(flag==1)
                        location.href=location.href;
                    else
                        location.href=indexPage;                    
                })
            }
        }else{
            alert("please select checkbox")
        }
}

</script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("footer"); ?>
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>">Administrator</a>.</strong> All rights
    reserved.
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/layouts.blade.php ENDPATH**/ ?>