

 <div class="input-images-2" style="padding-top: .5rem;padding-bottom: .5rem;"></div>


<?php if(isset($data)): ?>	
	<?php if(count(ModelHelper::getImageByProduct($data->id))>0): ?>
  	<div id="gallery">
  		 
        
        <div id="image-container">
        <h2>Change Order of Images in Photo Gallery with Drag and Drop </h2>
        <div id="txtresponse" class="text-success"> </div>
         <div id="submit-container"> 
            <input type='button' class="btn btn-info" value='Update Caption and ordering' id='submit' />
        </div>
        
            <div class="row" id="image-list" >
              
                <?php $__currentLoopData = ModelHelper::getImageByProduct($data->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     
                     
                    <div class="col-md-3 " >
                    	<div class="gaurav-class" id="image_<?php echo e((($image->id))); ?>">
				            <img src="<?php echo e(asset(($image->image))); ?>"  class="img-responsive" width="100%" ><br>
				            <a href="javaScript:void(0)" class="text-danger delete-image-product" data-id="<?php echo e($image->id); ?>"> <i class="fa fa-times"></i> Delete</a>
				            <input type="text" id="caption_<?php echo e((($image->id))); ?>" class="caption_name form-control" placeholder="caption name"  value="<?php echo e($image->caption); ?>" >
				        </div>
			        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>            
      
    </div>

<?php endif; ?>
<?php endif; ?>        <?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/properties/sub/gallery-images.blade.php ENDPATH**/ ?>