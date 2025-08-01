<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("Booking Type"); ?>

            <?php echo Form::select("booking_type_admin",["invoice"=>"invoice","manual"=>"manual","custom-quote"=>"Custom Quote"],null,["class"=>"form-control","required","placeholder"=>"Choose Booking Type","id"=>"booking-selector"]); ?>

            <span class="text-danger"><?php echo e($errors->first("booking_type_admin")); ?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("RV"); ?>

            <?php echo Form::select("property_id",ModelHelper::getProperptySelectList(),null,["class"=>"form-control","required","placeholder"=>"Choose RV","id"=>"property-selector"]); ?>

            <span class="text-danger"><?php echo e($errors->first("property_id")); ?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("checkin"); ?>

            <?php echo Form::text("checkin",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in","class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("checkin")); ?></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label("checkout"); ?>

            <?php echo Form::text("checkout",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out","class"=>"form-control lst" ]); ?>

            <span class="text-danger"><?php echo e($errors->first("checkout")); ?></span>
        </div>
    </div>
</div>


<div id="gaurav-data-new-logic">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("adults"); ?>

                <?php echo Form::selectRange("adults",0,100,null,["class"=>"form-control","id"=>"adult_data"]); ?>

                <span class="text-danger"><?php echo e($errors->first("adults")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("child"); ?>

                <?php echo Form::selectRange("child",0,100,null,["class"=>"form-control","id"=>"child_data"]); ?>

                <span class="text-danger"><?php echo e($errors->first("child")); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label("pets"); ?>

                <?php echo Form::selectRange("pets",0,100,null,["class"=>"form-control","id"=>"pet_data"]); ?>

                <span class="text-danger"><?php echo e($errors->first("pets")); ?></span>
            </div>
        </div>
        <div class="col-md-3 custom-amount">
            <div class="form-group">
                <?php echo Form::label("extra_discount"); ?>

                <?php echo Form::number("extra_discount",0,["class"=>"form-control","id"=>"extra-discount"]); ?>

                <span class="text-danger"><?php echo e($errors->first("extra_discount")); ?></span>
            </div>
        </div>
        <div class="col-md-3 custom-amount-add d-none">
            <div class="form-group">
                <?php echo Form::label("custom_amount"); ?>

                <?php echo Form::number("custom_amount",0,["class"=>"form-control"]); ?>

                <span class="text-danger"><?php echo e($errors->first("custom_amount")); ?></span>
            </div>
        </div>
    </div>
    <div class="row  custom-amount" >
        <div class="col-md-12">
            <a href="javascript:;" class="add-space-data btn btn-info btn-xs"><i class="fa fa-plus"></i> Add Additional Price</a>
                 <hr>
        </div>
    </div>
    <div class="row gaurav-delete-property  custom-amount">
         <div class="col-md-2">
            <strong>Action</strong>
        </div>
        <div class="col-md-7">
            <strong>Name</strong>
        </div>
        
    
        <div class="col-md-3">
            <strong>Amount</strong>
        </div>
      
        
        <div class="col-md-12">
            <br>
        </div>
    </div>
    <div id="space-area-section " class="custom-amount">
    </div>
    <div class="row custom-amount" id="pricedata-gaurav">
        
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("name"); ?>

            <?php echo Form::text("name",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("name")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("mobile"); ?>

            <?php echo Form::text("mobile",null,["class"=>"form-control"]); ?>

            <span class="text-danger"><?php echo e($errors->first("mobile")); ?></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label("email"); ?>

            <?php echo Form::email("email",null,["class"=>"form-control","required"]); ?>

            <span class="text-danger"><?php echo e($errors->first("email")); ?></span>
        </div>
    </div>
    
    
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("where they are going as destination"); ?>

            <?php echo Form::textarea("where_they_are",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("where_they_are")); ?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label("message"); ?>

            <?php echo Form::textarea("message",null,["class"=>"form-control","rows"=>"2"]); ?>

            <span class="text-danger"><?php echo e($errors->first("message")); ?></span>
        </div>
    </div>
</div>
<?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/admin/booking-enquiries/form.blade.php ENDPATH**/ ?>