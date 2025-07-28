
<div class="row " >
	<div class="col-md-12">
		<a href="javascript:;" class="add-milleage-data btn btn-info"><i class="fa fa-plus"></i> Add  MILEAGE</a>
		 	 <hr>
	</div>
</div>
<div class="row gaurav-delete-milleage">
    <div class="col-md-3">
        <strong> Name</strong>
    </div>
    <div class="col-md-1">
        <strong>Rate</strong>
    </div>
   
    <div class="col-md-1">
        <strong>Free(per day)</strong>
    </div>
    <div class="col-md-4">
        <strong>Type</strong>
    </div>
    <div class="col-md-2">
        <strong>Status</strong>
    </div>
    <div class="col-md-1">
        <strong>Action</strong>
    </div>
    
    <div class="col-md-12">
        <br>
    </div>
</div>
<div id="milleage-area-section">
    @isset($data)
        @php $i=0;@endphp
        @foreach(App\Models\PropertyMillageRate::where("property_id",$data->id)->get() as $c)
                    <input type="hidden" name="millage_id[]" value="{{ $c->id }}">
            <div class="row gaurav-delete-milleage">
                <div class="col-md-3">
                    {!! Form::text("milleage_name[]",$c->milleage_name,["required","class"=>"form-control","placeholder"=>" Name"]) !!}
                </div>
                <div class="col-md-1">
                    {!! Form::text("milleage_rate[]",$c->milleage_rate,["required","class"=>"form-control","placeholder"=>" Rate"]) !!}
                </div>
                <div class="col-md-1">
                    {!! Form::text("milleage_free[]",$c->milleage_free,["required","class"=>"form-control","placeholder"=>" Free"]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::select("milleage_format[]",["millage"=>"Millage","generator_hour"=>"Generator Hours"],$c->milleage_format,["required","class"=>"form-control"]) !!}
                </div>
                
                <div class="col-md-2">
                    {!! Form::select("milleage_status[]",["active"=>"active","deactive"=>"deactive"],$c->milleage_status,["required","class"=>"form-control"]) !!}
                </div>
                <div class="col-md-1">
               
                    <a href="javascript:;" class="delete-fee-milleage-delete-db btn btn-danger " data-id="{{ $c->id }}"  ><i class="fa fa-trash"></i> </a>
         
                </div>
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
            @php $i++;@endphp
        @endforeach
            
    @endisset
</div>




