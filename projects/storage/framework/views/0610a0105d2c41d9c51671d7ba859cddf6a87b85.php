
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
   <?php
  $list=App\Models\Attraction::orderBy("id","desc")->paginate(10);
  ?>  
	<!-- end banner sec -->





   
<section class="summary-section">
        <div class="container"> 
           <?php $i=0; ?>
              <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($i%2==0): ?>
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="<?php echo e(asset($c->image)); ?>" alt="<?php echo e($c->name); ?>"  class="attachment-full size-full aos-init aos-animate" loading="lazy" data-aos="fade-right" data-aos-duration="1500">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content">
                        <h3 data-aos="fade-left" data-aos-duration="1500"><a href="<?php echo e(url('attractions/detail/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></h3>
                        <div class="line"></div>
                        <p style="text-align: justify;" data-aos="fade-up" data-aos-duration="1500"><?php echo e($c->description); ?></p>
                    </div>
                </div>
                <div class="dot">
                  <img src="<?php echo e(asset('front')); ?>/img/dot-shape.png">
                </div>
            </div>
            <?php else: ?>
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 order-lg-2 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="<?php echo e(asset($c->image)); ?>" alt="<?php echo e($c->name); ?>"  class="attachment-full size-full aos-init aos-animate" loading="lazy" data-aos="fade-right" data-aos-duration="1500">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-1 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content">
                        <h3 data-aos="fade-left" data-aos-duration="1500"><a href="<?php echo e(url('attractions/detail/'.$c->seo_url)); ?>"><?php echo e($c->name); ?></a></h3>
                        <div class="line"></div>
                        <p style="text-align: justify;" data-aos="fade-up" data-aos-duration="1500"><?php echo e($c->description); ?></p>
                    </div>
                </div>
                <div class="dot">
                  <img src="<?php echo e(asset('front')); ?>/img/dot-shape.png">
                </div>
            </div>


               <?php endif; ?>
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row align-items-center">
               <?php echo e($list->links()); ?>

            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/static/attractions.blade.php ENDPATH**/ ?>