
<div class="row" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-option-data btn btn-info"><i class="fa fa-plus"></i> Add  Extra Option</a>
             <hr>
    </div>




</div>



<div class="row gaurav-delete-option">
  <div class="col-md-4">
        <strong> Name</strong>
    </div>
    <div class="col-md-4">
        <strong>Rate</strong>
    </div>
    <div class="col-md-2">
        <strong>Status</strong>
    </div>
    <div class="col-md-2">
        <strong>Action</strong>
    </div>
    
    <div class="col-md-12">
        <br>
    </div>
</div>
<div id="option-area-section">
    @isset($data)
            
        @foreach(App\Models\PropertyExtraOptionRate::where("property_id",$data->id)->get() as $c)
                    <input type="hidden" name="option_id[]" value="{{ $c->id }}">
            <div class="row gaurav-delete-option">
                <div class="col-md-4">
                    {!! Form::text("option_name[]",$c->option_name,["required","class"=>"form-control","placeholder"=>" Name"]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::text("option_rate[]",$c->option_rate,["required","class"=>"form-control","placeholder"=>" Rate"]) !!}
                </div>
                
                <div class="col-md-2">
                    {!! Form::select("option_status[]",["active"=>"active","deactive"=>"deactive"],$c->option_status,["required","class"=>"form-control"]) !!}
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" class="delete-fee-option-delete-db btn btn-danger " data-id="{{ $c->id }}" ><i class="fa fa-trash"></i> </a>
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        @endforeach
            
    @endisset
</div>




