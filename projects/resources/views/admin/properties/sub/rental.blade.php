<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label("rental_aggrement_attachment") !!}
            {!! Form::file("rental_aggrement_attachment",["class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("rental_aggrement_attachment")}}</span>
             @isset($data)
                @if($data->rental_aggrement_attachment!="")
                     <a href="{{ asset(($data->rental_aggrement_attachment)) }}" target="_BLANK" >Attachment</a>  <br>
                     
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" name="remove_rental_aggrement_attachment" value="yes" type="checkbox" id="remove_rental_aggrement_attachment" >
                        <label for="remove_rental_aggrement_attachment" class="custom-control-label">Remove Rental Aggrement Attachment</label>
                    </div>
                @endif
            @endisset
        </div>
    </div>

</div>
