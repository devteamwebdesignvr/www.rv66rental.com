<!DOCTYPE html>
<html>
	<head>
    <?php echo $__env->make("front.layouts.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldContent("header-section"); ?>
        <?php echo ModelHelper::getDataFromSetting('google-analytics'); ?>

        <?php echo ModelHelper::getDataFromSetting('google-tag-master'); ?>

        <?php echo ModelHelper::getDataFromSetting('facebook-pixel-code'); ?>

        <?php echo ModelHelper::getDataFromSetting('other-thing-on-head'); ?> 
	</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

    

    	<?php echo ModelHelper::getDataFromSetting('after-body-open-tag'); ?>

	  <?php echo $__env->make("front.layouts.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


	  <?php echo $__env->yieldContent('container'); ?>

	<?php echo $__env->make("front.layouts.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	

<?php echo $__env->yieldContent("footer-section"); ?>
    	<?php echo ModelHelper::getDataFromSetting('chat-bot'); ?>

</body>
</html><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/layouts/master.blade.php ENDPATH**/ ?>