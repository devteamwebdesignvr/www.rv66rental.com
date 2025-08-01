 <h5 class="text-warning ">Payment Type only for instapay</h2>
  <div class="row">
 
	<div class="col-md-12">
		<div class="form-group">
		    
		    <?php echo Form::select("input['payment-type']",["sandbox"=>"sandbox","live"=>"live"],ModelHelper::getDataFromSetting('payment-type'),["class"=>"form-control"]); ?>

		
		</div>
	</div>
</div>
 <h5 class="text-warning ">Which Payment Gateway</h2>
  <div class="row">
 
	<div class="col-md-12">
		<div class="form-group">
		    
		    <?php echo Form::select("input['which_payment_gateway']",["Instapay"=>"Instapay","authorize"=>"authorize","paypal"=>"paypal","stripe"=>"stripe","paypal_and_stripe"=>"Both, Paypal & Stripe"],ModelHelper::getDataFromSetting('which_payment_gateway'),["class"=>"form-control"]); ?>

		
		</div>
	</div>
</div>




 <h5 class="text-warning ">AUTHORIZED.NET</h2>
 <div class="row ">
 	<div class="col-md-3"><strong> MERCHANT LOGIN ID</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['AUTHORIZED_MERCHANT_LOGIN_ID']" value="<?php echo e(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_LOGIN_ID')); ?>" placeholder="MERCHANT LOGIN ID">
		</div>
	</div>

 	<div class="col-md-3"><strong>MERCHANT TRANSACTION KEY</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['AUTHORIZED_MERCHANT_TRANSACTION_KEY']" value="<?php echo e(ModelHelper::getDataFromSetting('AUTHORIZED_MERCHANT_TRANSACTION_KEY')); ?>" placeholder="MERCHANT TRANSACTION KEY">
		</div>
	</div>
</div>
 <h5 class="text-warning d-none">Stripe</h2>
 <div class="row d-none">
 	<div class="col-md-3"><strong>Publish Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['stripe_publish_key']" value="<?php echo e(ModelHelper::getDataFromSetting('stripe_publish_key')); ?>" placeholder="stripe publish key">
		</div>
	</div>

 	<div class="col-md-3"><strong>Secret Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['stripe_secret_key']" value="<?php echo e(ModelHelper::getDataFromSetting('stripe_secret_key')); ?>" placeholder="stripe secret key">
		</div>
	</div>
</div>
 <h5 class="text-warning ">Instapay</h2>
 <div class="row ">
 	<div class="col-md-3"><strong>Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['instapay_key']" value="<?php echo e(ModelHelper::getDataFromSetting('instapay_key')); ?>" placeholder="Instapay key">
		</div>
	</div>

 	<div class="col-md-3"><strong>Pin</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['instapay_pin']" value="<?php echo e(ModelHelper::getDataFromSetting('instapay_pin')); ?>" placeholder="Instapay Pin">
		</div>
	</div>
</div>
 <h5 class="text-warning d-none">Paypal</h2>
 <div class="row d-none">
 	<div class="col-md-3"><strong>Access token Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['paypal_access_token']" value="<?php echo e(ModelHelper::getDataFromSetting('paypal_access_token')); ?>" placeholder="Paypal Access Token">
		</div>
	</div>
</div>

<h5 class="text-warning d-none">IGMS</h2>
<div class="row d-none">
 	<div class="col-md-3"><strong>Access token Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['igms_access_token']" value="<?php echo e(ModelHelper::getDataFromSetting('igms_access_token')); ?>" placeholder="IGMS Access Token">
		</div>
	</div>
</div>

<h5 class="text-warning d-none">PriceLab</h2>
<div class="row d-none">
 	<div class="col-md-3"><strong>Access token Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['pricelab_access_token']" value="<?php echo e(ModelHelper::getDataFromSetting('pricelab_access_token')); ?>" placeholder="Pricelab Access Token">
		</div>
	</div>
</div>
<h5 class="text-warning d-none">Hosttools</h2>
<div class="row d-none">
 	<div class="col-md-3"><strong>Access token Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['hosttools_access_token']" value="<?php echo e(ModelHelper::getDataFromSetting('hosttools_access_token')); ?>" placeholder="Hosttools Access Token">
		</div>
	</div>
</div>
<h5 class="text-warning">Google Captcha</h2>
<div class="row">
 	<div class="col-md-3"><strong>Enable / Disabled</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<?php echo Form::select("input['g_captcha_enabled']",["no"=>"no","yes"=>"yes"],ModelHelper::getDataFromSetting('g_captcha_enabled'),["class"=>"form-control"]); ?>

		</div>
	</div>
</div>
<div class="row">
 	<div class="col-md-3"><strong>Site Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['google_captcha_site_key']" value="<?php echo e(ModelHelper::getDataFromSetting('google_captcha_site_key')); ?>" placeholder="Google Captcha Site Key">
		</div>
	</div>
</div>
<div class="row">
 	<div class="col-md-3"><strong>Secret Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['google_captcha_secret_key']" value="<?php echo e(ModelHelper::getDataFromSetting('google_captcha_secret_key')); ?>" placeholder="Google Captcha Secret Key">
		</div>
	</div>
</div>
<h5 class="text-warning d-none">Google map</h2>
<div class="row d-none">
 	<div class="col-md-3"><strong>Access token Key</strong></div>
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" name="input['google_map_access_token']" value="<?php echo e(ModelHelper::getDataFromSetting('google_map_access_token')); ?>" placeholder="Google map Access Token">
		</div>
	</div>
</div>



<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/dashboard/sub/admin.blade.php ENDPATH**/ ?>