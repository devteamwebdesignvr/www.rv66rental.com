
    <footer>
      <div class="container-fluid">
        <div class="upper-row">
          <div class="row">
            <div class="col-3 left">
              <img src="<?php echo e(asset('front')); ?>/images/footer-logo.png" alt="" class="img-fluid">
              <div class="trusted">
                    <h3>Trusted By More Than
                      100 Travelers Every Year</h3>
                  </div>
             
            </div>
            <div class="col-9 right">
              <!--<div class="top-bar">-->
              <!--  <div class="office">-->
              <!--    <h2>Top Destinations</h2>-->
              <!--    <ul class="hours">-->
              <!--       <?php $__currentLoopData = App\Models\Location::orderBy("id","desc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
              <!--      <li> <a href="<?php echo e(url('/properties/location/'.$c->seo_url)); ?>"> <i class="fa-solid fa-mountain"></i> <?php echo e($c->name); ?></a></li>-->
              <!--      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
              <!--    </ul>-->
              <!--  </div>-->
              <!--  <div class="contact-bar">-->
              <!--    <h2>Useful Links</h2>-->
              <!--    <ul class="hours">-->
                 
              <!--      <li> <a href="<?php echo e(url('properties')); ?>"> <i class="fa-solid fa-mountain"></i> View Listings</a></li>-->
              <!--      <li> <a href="<?php echo e(url('gallery')); ?>"> <i class="fa-solid fa-mountain"></i> Memories</a></li>-->
              <!--      <li> <a href="<?php echo e(url('faq')); ?>"> <i class="fa-solid fa-mountain"></i> FAQ’s</a></li>-->
              <!--      <li> <a href="<?php echo e(url('about-us')); ?>"> <i class="fa-solid fa-mountain"></i> About RV 66 Rental</a></li>-->
               
              <!--      <li> <a href="<?php echo e(url('contact-us')); ?>"> <i class="fa-solid fa-mountain"></i> Contact us</a></li>-->
              <!--    </ul>-->
              <!--  </div>-->
              <!--</div>-->
              <div class="bottom-bar">
                <div class="content">
                  <div class="about-rv">
                <h2>About RV 66 Rental</h2>
                <p><?php echo $setting_data['about'] ?? '#'; ?></p>
              </div>
              <div class="center">
                  <div class="call">
                    <p>For Bookings, Call us</p>
                    <a href="tel:<?php echo $setting_data['mobile'] ?? '#'; ?>"><?php echo $setting_data['mobile'] ?? '#'; ?></a>
                  </div>

                  <div class="email">
                    <p>Email us</p>
                    <a href="mailto:<?php echo $setting_data['email'] ?? '#'; ?>"><?php echo $setting_data['email'] ?? '#'; ?></a>
                  </div>
              </div>
                  

                  <div class="social">
                    <p>Social Icons</p>
                    <a href="<?php echo $setting_data['facebook'] ?? '#'; ?>" target="_BLANK"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo $setting_data['instagram'] ?? '#'; ?>" target="_BLANK"><i class="fa-brands fa-instagram"></i></a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright">
          <div class="row">
          <div class="col-3 left">
            <a href="https://www.webdesignvr.com/" target="_blank">
              <img src="<?php echo e(asset('front')); ?>/images/webdesign.png" alt="">
            </a>
          </div>
          <div class="col-9 right">
              <div class="left-copy">
            <p><?php echo $setting_data['copyright'] ?? '#'; ?></p>
            </div>
            <div class="right-copy">
                <p>
                    <a href="<?php echo e(url('rentals-requirements')); ?>">
                        Rental Requirements
                    </a>
                     | 
                    <a href="<?php echo e(url('privacy-policy')); ?>">
                        Privacy Policy
                    </a>
                </p>
            </div>
          </div>
          
        </div>
        </div>
      </div>
    </footer>
<div class="fixed-action">
    <ul>
        <li><a href="https://www.facebook.com/rv66rental" title="Facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
        <li><a href="https://www.instagram.com/rv66rentals/" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
        <li><a href="mailto:info@rv66rental.com" title="Write us"><i class="fa-solid fa-envelope" data-label="Write us"></i></a></li>
        <li><a href="tel:+16308548949" title="Call us" target="_blank"><i class="fa-solid fa-phone" data-label="Call us"></i></a></li>
    </ul>
</div>

<?php echo $__env->make("front.layouts.js", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent("js"); ?>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/layouts/footer.blade.php ENDPATH**/ ?>