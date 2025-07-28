<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("Booking Type") !!}
            {!! Form::select("booking_type_admin",["invoice"=>"invoice","manual"=>"manual","custom-quote"=>"Custom Quote"],null,["class"=>"form-control","required","placeholder"=>"Choose Booking Type","id"=>"booking-selector"]) !!}
            <span class="text-danger">{{ $errors->first("booking_type_admin")}}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("RV") !!}
            {!! Form::select("property_id",ModelHelper::getProperptySelectList(),null,["class"=>"form-control","required","placeholder"=>"Choose RV","id"=>"property-selector"]) !!}
            <span class="text-danger">{{ $errors->first("property_id")}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("checkin") !!}
            {!! Form::text("checkin",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom","placeholder"=>"Check in","class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("checkin")}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("checkout") !!}
            {!! Form::text("checkout",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo","placeholder"=>"Check Out","class"=>"form-control lst" ]) !!}
            <span class="text-danger">{{ $errors->first("checkout")}}</span>
        </div>
    </div>
</div>


<div id="gaurav-data-new-logic">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("adults") !!}
                {!! Form::selectRange("adults",0,100,null,["class"=>"form-control","id"=>"adult_data"]) !!}
                <span class="text-danger">{{ $errors->first("adults")}}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("child") !!}
                {!! Form::selectRange("child",0,100,null,["class"=>"form-control","id"=>"child_data"]) !!}
                <span class="text-danger">{{ $errors->first("child")}}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("pets") !!}
                {!! Form::selectRange("pets",0,100,null,["class"=>"form-control","id"=>"pet_data"]) !!}
                <span class="text-danger">{{ $errors->first("pets")}}</span>
            </div>
        </div>
        <div class="col-md-3 custom-amount">
            <div class="form-group">
                {!! Form::label("extra_discount") !!}
                {!! Form::number("extra_discount",0,["class"=>"form-control","id"=>"extra-discount"]) !!}
                <span class="text-danger">{{ $errors->first("extra_discount")}}</span>
            </div>
        </div>
        <div class="col-md-3 custom-amount-add d-none">
            <div class="form-group">
                {!! Form::label("custom_amount") !!}
                {!! Form::number("custom_amount",0,["class"=>"form-control"]) !!}
                <span class="text-danger">{{ $errors->first("custom_amount")}}</span>
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
            {!! Form::label("name") !!}
            {!! Form::text("name",null,["class"=>"form-control","required"]) !!}
            <span class="text-danger">{{ $errors->first("name")}}</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("mobile") !!}
            {!! Form::text("mobile",null,["class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("mobile")}}</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("email") !!}
            {!! Form::email("email",null,["class"=>"form-control","required"]) !!}
            <span class="text-danger">{{ $errors->first("email")}}</span>
        </div>
    </div>
    
    
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("where they are going as destination") !!}
            {!! Form::textarea("where_they_are",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("where_they_are")}}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("message") !!}
            {!! Form::textarea("message",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("message")}}</span>
        </div>
    </div>
</div>
