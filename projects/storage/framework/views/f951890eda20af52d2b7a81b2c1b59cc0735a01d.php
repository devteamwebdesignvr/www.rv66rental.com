
<?php $__env->startSection("title",$data->meta_title); ?>
<?php $__env->startSection("keywords",$data->meta_keywords); ?>
<?php $__env->startSection("description",$data->meta_description); ?>
<?php $__env->startSection("header-section"); ?>
    <?php echo $data->header_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("footer-section"); ?>
    <?php echo $data->footer_section; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("container"); ?>
    <?php
        $name=$data->title;
        $bannerImage='https://ga4prozbj7-flywheel.netdna-ssl.com/wp-content/themes/aspenhomes/dist/images/trees-bg-600x350.jpg';
        if($data->image){
            $bannerImage=asset($data->image);
        }
    ?>
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
<section class="blog-detail-wrapper mt-5">
    <div class="container">
        <div class="row">
           <div class="col-lg-8 col-xs-12 col-md-12">
                <div class="blog-detail-left">
                    <div class="blog-detail-image">
                        <?php if($data->featureImage): ?>
                        <img src="<?php echo e(asset($data->featureImage)); ?>" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="blog-detail-title">
                       <h3><?php echo e($data->title); ?></h3>
                    </div>
                    <div class="feat_blog_con">
                        <p>
                        	<span><i class="fas fa-calendar-alt" aria-hidden="true"></i> <?php echo e(date('d M Y',strtotime($data->created_at))); ?></span>
							<?php $category=App\Models\Blogs\BlogCategory::where("id",$data->blog_category_id)->first(); ?>
			                <?php if($category): ?>
                        	   <span><i class="fas fa-globe" aria-hidden="true"></i><a href="<?php echo e(url('blogs/category/'.$category->seo_url)); ?>/"> <?php echo e($category->title); ?></a></span>
                        	<?php endif; ?>
                        </p>
                      </div>
                    <div class="blod-detail-description mb-5">
                       <?php echo $data->longDescription; ?>

                    </div>
              </div>
        </div>
        <div class="col-lg-4 col-xs-12 col-md-12">
            <section id="categories-4" class="widget widget_categories">
                <h2 class="widget-title">Categories</h2>
                <ul>
                	<?php $__currentLoopData = App\Models\Blogs\BlogCategory::orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="cat-item cat-item-2"><a href="<?php echo e(url('blogs/category/'.$category->seo_url)); ?>/"><?php echo e($category->title); ?></a> <span>(<?php echo e(App\Models\Blogs\Blog::where("blog_category_id",$category->id)->count()); ?>)</span></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
            <section id="recent-posts-2" class="widget widget_recent_entries">
                <h2 class="widget-title"><span class="first">Recent</span> Posts</h2>
                <ul>
                	<?php $__currentLoopData = App\Models\Blogs\Blog::where("id","!=",$data->id)->orderBy("id","desc")->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="item-recent-post">
                        <div class="thumbnail-post">
                            <img src="<?php echo e(asset($b->featureImage)); ?>" class="attachment-editech-thumbnail size-editech-thumbnail wp-post-image" alt="<?php echo e($b->title); ?>">
                        </div>
                        <div class="title-post"><a href="<?php echo e(url('blog/'.$b->seo_url)); ?>/"><?php echo e($b->title); ?></a> <span class="post-date"><i class="far fa-calendar-check" aria-hidden="true"></i> <?php echo e(date('d M Y',strtotime($b->created_at))); ?></span></div>
                    </li>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
           </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/group/single.blade.php ENDPATH**/ ?>