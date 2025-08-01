
             <div class="row">
                
                <div class="col-md-12">
                  <?php if(isset($addbar['add-delete'])): ?>
                    <a class="btn btn-app   delete-checkbox" 
                       href="javaScript:void(0)"><span class="fa fa-times"></span> Delete</a>
                  <?php else: ?>
                      
                  <?php endif; ?>

                  <?php if(isset($addbar['back-anchor'])): ?>
                      <a class="btn btn-app " 
                       href="<?php echo e($addbar['back-anchor']); ?>"><span class="fa fa-arrow-left"></span> Back</a>
                  <?php endif; ?>  
                  <?php if($addbar['add-data']): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e($addbar['add-anchor']); ?>"><span class="fa fa-plus"></span> <?php echo e($addbar['add-name']); ?></a>

                  <?php endif; ?>
                  <?php if(isset($addbar['custom-data'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e($addbar['custom-anchor'] ?? '#'); ?>"><span class="fa fa-retweet"></span> <?php echo e($addbar['custom-name']); ?></a>

                  <?php endif; ?> 
                  <?php if(isset($addbar['review-email'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e(url('send-review-email')); ?>"><span class="fa fa-retweet"></span> Today Review Email </a>

                  <?php endif; ?> 
                  <?php if(isset($addbar['welcome-email'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e(url('send-welcome-packages')); ?>"><span class="fa fa-retweet"></span> Today Welcome Email </a>

                  <?php endif; ?> 
                  <?php if(isset($addbar['reminder-email'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e(url('send-reminder-email')); ?>"><span class="fa fa-retweet"></span> Today Reminder Email </a>

                  <?php endif; ?> 
                  <?php if(isset($addbar['set-pricelab'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e(url('set-pricelab')); ?>"><span class="fa fa-retweet"></span> Run Pricelab </a>

                  <?php endif; ?> 
                  
                  
                  
                  
                  <?php if(isset($addbar['custom-data1'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e($addbar['custom-anchor1'] ?? '#'); ?>"><span class="fa fa-list"></span> <?php echo e($addbar['custom-name1']); ?></a>

                  <?php endif; ?>
                  <?php if(isset($addbar['download-ical'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e($addbar['download-ical-link'] ?? '#'); ?>" download><span class="fa fa-download"></span> Download Ical</a>

                  <?php endif; ?> 
                  
                  
                  <?php if(isset($addbar['expot-data'])): ?>
                    <a class="btn btn-app  " 
                       href="<?php echo e($addbar['expot-data']); ?>"><span class="fa fa-download"></span> Export</a>

                  <?php endif; ?>
                  <?php if(isset($addbar['copy-data'])): ?>
                    <a class="btn btn-app  " 
                       data-href="<?php echo e($addbar['copy-ical-link']); ?>" id="copy-data" onclick="myFunction()"><span class="fa fa-copy"></span> Export Ical Link</a>

                  <?php endif; ?>

                  <?php if(isset($addbar['model-media'])): ?>
                      <a class="btn btn-app " 
                       href="javascript::void(0)" data-toggle="modal" data-target="#myModal"><span class="fa fa-download"></span> upload</a>
                  <?php endif; ?>  
                  <?php if(isset($addbar['model-print'])): ?>
                      <a class="btn btn-app " 
                       href="javascript::void(0)"  onclick="printDiv('printableArea')"><span class="fa fa-print"></span> Print T3his Order</a>
                  <?php endif; ?>  
                  <?php if(isset($addbar['model-download'])): ?>
                      <a class="btn btn-app " 
                       href="<?php echo e($addbar['download-data']); ?>" ><span class="fa fa-download"></span> Download This Order</a>
                  <?php endif; ?>  
                  <?php if(isset($addbar['refresh-calander-data'])): ?>
                      <a class="btn btn-app " 
                       href="<?php echo e(route('refresshCalendar')); ?>" ><span class="fa fa-retweet"></span> Refresh Calendar</a>
                  <?php endif; ?>  
                    <a class="btn   btn-app " 
                       href="javascript::void(0)" onclick="location.href=location.href"><span class="fa fa-retweet"></span> Refresh</a>
                </div>
                
            </div><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/common/add-bar.blade.php ENDPATH**/ ?>