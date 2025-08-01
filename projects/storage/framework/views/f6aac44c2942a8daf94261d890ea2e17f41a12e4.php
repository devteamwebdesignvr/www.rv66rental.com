
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

 
  <section class="blog-wrapper">
  <div class="container">
    <div class="home-blog-sec">
      <div class="row  " >
        
  <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="blog-page">
             <?php $date=$b->publish_date; if($date){}else{$date=$b->created_at;} ?>

            <?php if($b->featureImage): ?>
            <div class="home-blog-image">
               <img src="<?php echo e(asset($b->featureImage)); ?>" alt="<?php echo e($b->title); ?>">
            </div>
            <?php endif; ?>
            <div class="blog-content">
              <h4><a href="<?php echo e(url('blog/'.$b->seo_url)); ?>/"> <?php echo e($b->title); ?> </a></h4>
                     <h6 class="blog-feat">
                <span class="blog-date"><i class="far fa-calendar-alt"></i>&nbsp; <?php echo e(date('d-F-Y',strtotime($date))); ?></span>
                  <?php $category=App\Models\Blogs\BlogCategory::where("id",$b->blog_category_id)->first(); ?>

                  <?php if($category): ?>

          
<span class="blog-date"><i class="fas fa-list"></i>&nbsp;<a href="<?php echo e(url('blogs/category/'.$category->seo_url)); ?>/"><?php echo e($category->title); ?></a></span>
                  <?php endif; ?>
                
              </h6>
              <p> <?php echo e(Str::limit($b->shortDescription,100)); ?></p>
              <a href="<?php echo e(url('blog/'.$b->seo_url)); ?>/" class="blog-read btn-25"><span>Read More <i class="fas fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
   

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

         <div class="alert alert-danger">No any Blogs Found.</div>

         <?php endif; ?>

      </div>

      <div class="row"><?php echo e($blogs->links()); ?></div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script>
    // external js: masonry.pkgd.js, imagesloaded.pkgd.js

// init Masonry
var $grid = $('.grid').masonry({
  itemSelector: '.grid-item',
  percentPosition: true,
  columnWidth: '.grid-sizer'
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry();
});  
</script>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/static/blogs.blade.php ENDPATH**/ ?>