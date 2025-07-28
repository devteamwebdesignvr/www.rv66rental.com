<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label("type") !!}
            {!! Form::select("type",["date-wise"=>"date-wise","day-wise"=>"day-wise"],null,["class"=>"form-control web-id-changer"]) !!}
            <span class="text-danger">{{ $errors->first("type")}}</span>
        </div>
    </div>


    <div class="col-md-3 date-wise ">
        <div class="form-group">
            {!! Form::label("start_date") !!}
            {!! Form::text("start_date",null,["class"=>"form-control datepicker","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("start_date")}}</span>
        </div>
     
    </div>
    <div class="col-md-3 date-wise ">
   
        <div class="form-group">
            {!! Form::label("end_date") !!}
            {!! Form::text("end_date",null,["class"=>"form-control datepicker","rows"=>"2"]) !!}
            <span class="text-danger">{{ $errors->first("end_date")}}</span>
        </div>
    </div>


    <div class="col-md-6 day-wise d-none">
        <div class="form-group">
            {!! Form::label("day name") !!}
            {!! Form::select("name",Helper::getWeekNameSelect(),null,["class"=>"form-control","placeholder"=>"Choose Day Name"]) !!}
            <span class="text-danger">{{ $errors->first("name")}}</span>
        </div>
    </div>
 


</div>