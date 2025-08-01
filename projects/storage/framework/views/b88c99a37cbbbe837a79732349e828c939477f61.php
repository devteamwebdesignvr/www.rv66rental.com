
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
        $bannerImage=asset('front/images/b1.jpg');
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

      <!-- About Section -->
 

<section class="abt-sec about">
    <div class="container">
        <div class="row">
        <div class="col-5 left">
            <div class="image-sec">
                <div class="wel-bg"> <img src="https://www.vacarentalhome.com/front/images/accent-bg.jpg" class="img-fluid" alt=""></div>
                <img src="<?php echo e(asset($data->image)); ?>" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-7 right">
            <div class="content-sec">
                <div class="head-area">
                    <em class="widget-num"><?php echo e($data->name); ?></em>
                  
                        <?php echo $data->mediumDescription; ?>

                   <?php echo $data->longDescription; ?>

                    <!--<div class="bttn">-->
                    <!--        <a href="#" class="list">Learn More</a>-->
                    <!--    </div>-->
                </div>
            </div>
        </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/static/about.blade.php ENDPATH**/ ?>