
<div class="row" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-accessories-data btn btn-info"><i class="fa fa-plus"></i> Add  Accessories</a>
             <hr>
    </div>



</div>




<div class="row gaurav-delete-accessories">
      <div class="col-md-2">
        <strong> Name</strong>
    </div>
    <div class="col-md-2">
        <strong> Helping Text</strong>
    </div>
    <div class="col-md-2">
        <strong>Rate</strong>
    </div>
    <div class="col-md-2">
        <strong>Type</strong>
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
<div id="accessories-area-section">
    @isset($data)
        @foreach(App\Models\PropertyAccessoriesRate::where("property_id",$data->id)->get() as $c)
                    <input type="hidden" name="accessories_id[]" value="{{ $c->id }}">
                    <div class="row gaurav-delete-accessories">
                        <div class="col-md-2">
                            {!! Form::text("accessories_name[]",$c->accessories_name,["required","class"=>"form-control","placeholder"=>" Name"]) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::text("accessories_helping_text[]",$c->accessories_helping_text,["required","class"=>"form-control","placeholder"=>" Helping Text"]) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::text("accessories_rate[]",$c->accessories_rate,["required","class"=>"form-control","placeholder"=>" Rate"]) !!}
                        </div>

                        <div class="col-md-2">
                            {!! Form::select("accessories_type[]",["per night"=>"Per Night","per person"=>"Per Person","per stay"=>"Per Stay"],$c->accessories_type,["required","class"=>"form-control"]) !!}
                        </div>
                        
                        <div class="col-md-2">
                            {!! Form::select("accessories_status[]",["active"=>"active","deactive"=>"deactive"],$c->accessories_status,["required","class"=>"form-control"]) !!}
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="delete-fee-accessories-delete-db btn btn-danger " data-id="{{ $c->id }}" ><i class="fa fa-trash"></i> </a>
                        </div>
                        
                        <div class="col-md-12">
                            <br>
                        </div>
                    </div>
        @endforeach
            
    @endisset
</div>




