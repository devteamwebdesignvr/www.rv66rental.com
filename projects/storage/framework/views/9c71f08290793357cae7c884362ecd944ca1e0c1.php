 <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Main</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Gallery Images</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Extra</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-features-tab" data-toggle="pill" href="#custom-tabs-three-features" role="tab" aria-controls="custom-tabs-three-features" aria-selected="false">Features</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-fee-tab" data-toggle="pill" href="#custom-tabs-three-fee" role="tab" aria-controls="custom-tabs-three-fee" aria-selected="false">Additional Fee</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-milleage-tab" data-toggle="pill" href="#custom-tabs-three-milleage" role="tab" aria-controls="custom-tabs-three-milleage" aria-selected="false">ADDITIONAL MILEAGE</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-accessories-tab" data-toggle="pill" href="#custom-tabs-three-accessories" role="tab" aria-controls="custom-tabs-three-accessories" aria-selected="false">RV RENTAL ACCESSORIES</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-option-tab" data-toggle="pill" href="#custom-tabs-three-option" role="tab" aria-controls="custom-tabs-three-option" aria-selected="false">Extra Option</a>
                  </li>
                  <li class="nav-item  d-none">
                    <a class="nav-link" id="custom-tabs-three-space-tab" data-toggle="pill" href="#custom-tabs-three-space" role="tab" aria-controls="custom-tabs-three-space" aria-selected="false">Property Space</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-welcome-tab" data-toggle="pill" href="#custom-tabs-three-welcome" role="tab" aria-controls="custom-tabs-three-welcome" aria-selected="false">Welcome Package</a>
                  </li>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-rental-tab" data-toggle="pill" href="#custom-tabs-three-rental" role="tab" aria-controls="custom-tabs-three-rental" aria-selected="false">Rental Aggrement</a>
                  </li>
                  <li class="nav-item  d-none">
                    <a class="nav-link" id="custom-tabs-three-pms-tab" data-toggle="pill" href="#custom-tabs-three-pms" role="tab" aria-controls="custom-tabs-three-pms" aria-selected="false">PMS Integration</a>
                  </li>
                  <?php if(isset($data)): ?>
                  <li class="nav-item  ">
                    <a class="nav-link" id="custom-tabs-three-amenities-tab" data-toggle="pill" href="#custom-tabs-three-amenities" role="tab" aria-controls="custom-tabs-three-amenities" aria-selected="false">Amenities </a>
                  </li>
                  <?php endif; ?>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-artisan-tab" data-toggle="pill" href="#custom-tabs-three-artisan" role="tab" aria-controls="custom-tabs-three-artisan" aria-selected="false">SEO</a>
                  </li>
              
                </ul>
              </div>
              
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <?php echo $__env->make("admin.properties.sub.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                     <?php echo $__env->make("admin.properties.sub.gallery-images", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                     <?php echo $__env->make("admin.properties.sub.extra", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-features" role="tabpanel" aria-labelledby="custom-tabs-three-features-tab">
                     <?php echo $__env->make("admin.properties.sub.select", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-fee" role="tabpanel" aria-labelledby="custom-tabs-three-fee-tab">
                     <?php echo $__env->make("admin.properties.sub.fee", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-milleage" role="tabpanel" aria-labelledby="custom-tabs-three-milleage-tab">
                     <?php echo $__env->make("admin.properties.sub.milleage", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-accessories" role="tabpanel" aria-labelledby="custom-tabs-three-accessories-tab">
                     <?php echo $__env->make("admin.properties.sub.accessories", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-option" role="tabpanel" aria-labelledby="custom-tabs-three-option-tab">
                     <?php echo $__env->make("admin.properties.sub.option", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-space" role="tabpanel" aria-labelledby="custom-tabs-three-space-tab">
                     <?php echo $__env->make("admin.properties.sub.space", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-welcome" role="tabpanel" aria-labelledby="custom-tabs-three-welcome-tab">
                     <?php echo $__env->make("admin.properties.sub.welcome", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-rental" role="tabpanel" aria-labelledby="custom-tabs-three-rental-tab">
                     <?php echo $__env->make("admin.properties.sub.rental", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <div class="tab-pane fade  " id="custom-tabs-three-pms" role="tabpanel" aria-labelledby="custom-tabs-three-pms-tab">
                     <?php echo $__env->make("admin.properties.sub.pms", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <?php if(isset($data)): ?>
                  <div class="tab-pane fade  " id="custom-tabs-three-amenities" role="tabpanel" aria-labelledby="custom-tabs-three-amenities-tab">
                     <?php echo $__env->make("admin.properties.sub.amenities", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                  <?php endif; ?>
               
                  <div class="tab-pane fade" id="custom-tabs-three-artisan" role="tabpanel" aria-labelledby="custom-tabs-three-artisan-tab">
                     <?php echo $__env->make("admin.properties.sub.seo", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                  </div>
                
                </div>
                <div class="alert"></div>
               
              </div>
              
              <!-- /.card -->
            </div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/form.blade.php ENDPATH**/ ?>