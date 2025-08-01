
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

	<!-- start about section -->
     
   <section class="about-sec faq">
       <div class="container">
          
           <h2 class="head">FREQUENTLY ASKED QUESTIONS</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <?php $i=1; ?>
                <?php $__currentLoopData = App\Models\Faq::orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <?php if($i==1): ?>
                  <div class="accordion-item">
                  
                    <h2 class="accordion-header" id="headingOne">
                      <button class="ui-accordion__link accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <span class="ui-accordion__number"><?php echo e($i); ?></span> <?php echo $c->question; ?>

                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                         <?php echo $c->answer; ?>

                      </div>
                    </div>
                  </div>
               <?php else: ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo<?php echo e($i); ?>">
                      <button class="ui-accordion__link  accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo<?php echo e($i); ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo e($i); ?>">
                        <span class="ui-accordion__number"><?php echo e($i); ?></span>   <?php echo $c->question; ?>

                      </button>
                    </h2>
                    <div id="collapseTwo<?php echo e($i); ?>" class="accordion-collapse collapse" aria-labelledby="headingTwo<?php echo e($i); ?>" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                         <?php echo $c->answer; ?>

                      </div>
                    </div>
                  </div>
                    <?php endif; ?>
                    <?php $i++; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                </div>
              </div>
           </div>
       </div>
   </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("front.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/static/faq.blade.php ENDPATH**/ ?>