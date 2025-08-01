
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("logo",$data->image); ?>
<?php $__env->startSection("header-section"); ?>
<?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
<?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>

    <?php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    ?>
	<!-- start banner sec -->
    

    <section class="page-title" style="background-image: url(<?php echo e($bannerImage); ?>);">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate"><?php echo e($name); ?></h1>
            <div class="checklist">
                <p>
                    <a href="<?php echo e(url('/')); ?>" class="text"><span>Home</span></a>
                    <a class="g-transparent-a"><?php echo e($name); ?></a>
                </p>
            </div>
        </div>
    </section>
	<!-- end banner sec -->



<section class="rent rentals-req">
    <div class="container">
        <h2>Rentals Requirements</h2>
        <!--<div class="row">-->
           
            
        <!--    <div class="col-2">-->
        <!--        <a href="#in">-->
        <!--            <div class="icon-area">-->
                        
        <!--                <img src="<?php echo e(asset('front/images/ins-blue.png')); ?>" class="img-fluid blue" alt="">-->
        <!--                <img src="<?php echo e(asset('front/images/ins-white.png')); ?>" class="img-fluid white" alt="">-->
        <!--            </div>-->
        <!--            <h3>Insurance</h3>-->
        <!--        </a>-->
        <!--    </div>-->
            
            
            
           
            
        <!--    <div class="col-2">-->
        <!--        <a href="#can">-->
        <!--            <div class="icon-area">-->
                        
        <!--                <img src="<?php echo e(asset('front/images/policy-blue.png')); ?>" class="img-fluid blue" alt="">-->
        <!--                <img src="<?php echo e(asset('front/images/policy-white.png')); ?>" class="img-fluid white" alt="">-->
        <!--            </div>-->
        <!--            <h3>Cancellation Policy</h3>-->
        <!--        </a>-->
        <!--    </div>-->
            
            
        <!--</div>-->
    </div>
</section>

    <section class="rentals">
         <div class="container">
            <div class="row">
                
                
                    <?php echo $data->mediumDescription; ?>

                 </div>
         </div>
      </section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
<script>
$(document).on("click",".loc-img",function(){
    $(".map-view-gaurav").hide();
    $($(this).data("id")).show();
})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/static/map.blade.php ENDPATH**/ ?>