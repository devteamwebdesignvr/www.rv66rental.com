<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("welcome_package_attachment") !!}
            {!! Form::file("welcome_package_attachment",["class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("welcome_package_attachment")}}</span>
             @isset($data)
                @if($data->welcome_package_attachment!="")
                     <a href="{{ asset(($data->welcome_package_attachment)) }}" target="_BLANK" >Attachment</a>  <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_welcome_package_attachment" value="yes" type="checkbox" id="remove_welcome_package_attachment" >
                        <label for="remove_welcome_package_attachment" class="custom-control-label">Remove Welcome Package Attachment</label>
                    </div>
                @endif
            @endisset
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("welcome_package_description") !!}
            {!! Form::textarea("welcome_package_description",null,["class"=>"form-control","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("welcome_package_description")}}</span>
        </div>
    </div>
 
</div>

