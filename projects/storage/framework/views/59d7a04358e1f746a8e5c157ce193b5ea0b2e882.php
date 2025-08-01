
<?php $__env->startSection("title","404 - Page not found"); ?>
<?php $__env->startSection("keywords","404 - Page not found"); ?>
<?php $__env->startSection("description","404 - Page not found"); ?>
<?php $__env->startSection("container"); ?>

    <?php
        $name='404 - Page Not Found';
        $bannerImage=asset('front/images/internal-banner.webp');
          $payment_currency= $setting_data['payment_currency'];
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
      <section class="about_wrapper error">
         <div class="container">
            <div class="row m-0">
                    <h1>404</h1>
                    <h2>Oops.. Page Not Found</h2>
                    <p>You can search for the page you want here or return to the homepage.</p>
                    <a href="<?php echo e(url('/')); ?>" class="main-btn">Go Home</a>

              
            </div>
         </div>
      </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/errors/404.blade.php ENDPATH**/ ?>