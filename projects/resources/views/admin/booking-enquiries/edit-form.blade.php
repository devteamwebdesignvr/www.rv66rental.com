<div class="row">
    <input type="hidden" name="booking_type_admin" value="{{ $data->booking_type_admin }}"/>
    <div class="col-md-12 ">
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


<div class="   {{ $data->booking_type_admin!='manual'?'':'d-none' }}"  id="gaurav-data-new-logic" >

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label("adults") !!}
            {!! Form::selectRange("adults",0,100,null,["class"=>"form-control","required","id"=>"adult_data"]) !!}
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
            {!! Form::selectRange("total_pets",0,100,null,["class"=>"form-control","id"=>"pet_data"]) !!}
            <span class="text-danger">{{ $errors->first("pets")}}</span>
        </div>
    </div>
    <div class="col-md-3 {{ $data->booking_type_admin!='custom-quote'?'':'d-none' }}">
        <div class="form-group">
            {!! Form::label("extra_discount") !!}
            {!! Form::number("extra_discount",null,["class"=>"form-control","id"=>"extra-discount"]) !!}
            <span class="text-danger">{{ $errors->first("extra_discount")}}</span>
        </div>
    </div>
    <div class="col-md-3 {{ $data->booking_type_admin=='custom-quote'?'':'d-none' }}">
        <div class="form-group">
            {!! Form::label("custom_amount") !!}
            {!! Form::number("custom_amount",$data->total_amount,["class"=>"form-control"]) !!}
            <span class="text-danger">{{ $errors->first("custom_amount")}}</span>
        </div>
    </div>
</div>
<div class="row   {{ $data->booking_type_admin=='invoice'?'':'d-none' }}" >
    <div class="col-md-12">
        <a href="javascript:;" class="add-space-data btn btn-info btn-xs"><i class="fa fa-plus"></i> Add Additional Price</a>
             <hr>
    </div>
</div>
<div class="row gaurav-delete-property {{ $data->booking_type_admin=='invoice'?'':'d-none' }}">
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
<div id="space-area-section" class="{{ $data->booking_type_admin=='invoice'?'':' d-none' }}">
    @isset($data)
        @if($data->custom_before_total_fees)
            @php
                $products=json_decode($data->custom_before_total_fees,true);
            @endphp
            @foreach($products as $p)
                @isset($p['product_amount'])
                        <div class="row gaurav-delete-property-space">
                            <div class="col-md-1">
                                <a href="javascript:;" class="delete-space-data btn btn-danger btn-xs" ><i class="fa fa-times"></i> </a>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text("product_name[]",$p['product_name'],["required","class"=>"form-control","placeholder"=>"Name"]) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::text("product_amount[]",$p['product_amount'],["class"=>"form-control product_amount","placeholder"=>"Amount","required"]) !!}
                            </div>
                            <div class="col-md-12">
                                <br>
                            </div>
                        </div>
                @endisset
            @endforeach
        @endif
    @endisset
</div>


<div class="row {{ $data->booking_type_admin=='invoice'?'':'d-none' }}" id="pricedata-gaurav">
      @php
        $start_date=$data->checkin;
        $end_date=$data->checkout;
        $adults=$data->adults;
        $child=$data->child;
        $total_guests=$adults+$child;
        $gross_amount=$data->gross_amount;
        $day=$data->total_night;
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;
        $before_total_fees=[];
        $after_total_fees=[];
         $custom_before_total_fees=[];
        
        
        
        $total_pets=$data->pet_fee_data_guarav;
        
        $pet_fee=0;
        $guest_fee=0;
        $rest_guests=0;
        $single_guest_fee=0;
        $extra_discount=0;
        
    @endphp

            <div class="col-md-12">
            <table class="table table-bordered">
            <tr>
              <th>Check IN</th>
              <th>Check Out</th>
              <th>Total Guests</th>
              <th>Total Nights</th>
              <th   align="right" style="text-align: right !important;">Gross Amount</th>
           </tr>
            <tr>
              <td>{{date('F jS, Y',strtotime($start_date))}}</td>
              <td>{{date('F jS, Y',strtotime($end_date))}}</td>
              <td>{{$total_guests}} Guests   ({{ $adults }} Adults , {{ $child }} Child)</td>
              <td>{{$day}}</td>
              <td  align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($gross_amount,2)}}</td>
           </tr>
           

     	@if($data->rest_guests)
		    @if($data->rest_guests>0)
		        @if($data->guest_fee)
		            @if($data->guest_fee>0)
		            <tr>
						<td align="left" colspan="4" style="padding: 10px;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">({{$data->total_night}} nights * {!! $setting_data['payment_currency'] !!}{{$data->single_guest_fee}} * {{$data->rest_guests}} Guests)</span></strong></td>
						<td align="right" style="padding: 10px; " valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($data->guest_fee,2) }}</td>
					</tr>
		            @endif
		        @endif
		    @endif
		@endif
								    
  

			@if($data->total_pets)
			    @if($data->total_pets>0)
			        @if($data->pet_fee)
			            @if($data->pet_fee>0)
			            <tr>
							<td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Pet Fee :</strong></td>
							<td align="right" style="padding: 10px; " valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($data->pet_fee,2) }}</td>
						</tr>
			            @endif
			        @endif
			    @endif
			@endif
           
           @if($data->before_total_fees)   
             @foreach(json_decode($data->before_total_fees) as $c)
            <tr>
                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                <td align="right" style="padding: 10px;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($c->amount,2) }}</td>
            </tr>
            @endforeach
            @endif

               @if($data->custom_before_total_fees)
            @php
                $products=json_decode($data->custom_before_total_fees,true);
            @endphp
            @foreach($products as $p)
                @isset($p['product_amount'])
               
         
                    <tr>
                      <td colspan="4"  align="left">{{ $p['product_name']}}</td>
                      <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{$p['product_amount']}}</td>
                   </tr>
                        @endisset
            @endforeach
        @endif


            @php
                $payment_currency=$setting_data['payment_currency'];
            @endphp
          
          
                                    @if($data['accessories_rate_ids'])
                                    @php //dd($data['accessories_rate_ids']) @endphp
                                    @foreach(json_decode($data['accessories_rate_ids']) as $c)
                                	@php //dd(json_decode($data['accessories_rate_ids'])); @endphp
                             
                                      <tr>
                                                <th colspan="4">
                                                    <input type="checkbox" checked name="accessories_rate_id[id][{{$c->id}}]" value="{{ $c->id }}" class="common-field-show-rate accessories-rate" data-target="accessories_rate_id{{$c->id}}field" >
                                                   @if($c->accessories_helping_text=='per night')
                                                   <input type="hidden" value="{{ $c->value }}" name="accessories_rate_id[field][{{$c->id}}]" id="accessories_rate_id{{$c->id}}field" class="  rate-calculateion-data"> 
                                                    {{$c->accessories_name}}<sub>{{$c->accessories_helping_text}}</sub>
                                                  @else
                                                    <input type="text" value="{{ $c->value }}" name="accessories_rate_id[field][{{$c->id}}]" id="accessories_rate_id{{$c->id}}field" class="  rate-calculateion-data"> 
                                                    {{$c->accessories_name}}<sub>{{$c->accessories_helping_text}}</sub>
                                                  @endif
                                                </th>
                                                <td align="right">
                                                    {!! $payment_currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}
                                                </td>
                                             </tr>
                                    @endforeach
                                    @endif
                                    @if($data['mileage_rate_ids'])
                                    @foreach(json_decode($data['mileage_rate_ids']) as $c)
                                
                                   
                                          <tr>
                                            <th colspan="4">
                                                <input type="checkbox" checked name="mileage_rate_id[id][{{$c->id}}]" value="{{ $c->id }}" class="common-field-show-rate mileage-rate" data-target="mileage_rate_id{{$c->id}}field" >
                                                <input type="text" value="{{ $c->value }}" name="mileage_rate_id[field][{{$c->id}}]" id="mileage_rate_id{{$c->id}}field" class="  rate-calculateion-data"> {{$c->milleage_name}} 
                                            @isset($c->message)
                                                <small>( {{ $c->message }} )</small>
                                            @endisset
                                        
                                            </th>
                                            <td align="right">
                                                {!! $payment_currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}
                                            </td>
                                         </tr>
                                        
                                    @endforeach
                                    @endif
                                    @if($data['option_rate_ids'])
                                    @foreach(json_decode($data['option_rate_ids']) as $c)
                                
                                     
                                          <tr>
                                            <th colspan="4">
                                                <input type="checkbox" name="option_rate_id[id][{{$c->id}}]" checked value="{{ $c->id }}" class="common-field-show-rate option-rate" data-target="option_rate_id{{$c->id}}field" >
                                                <input type="text" value="{{ $c->value }}" name="option_rate_id[field][{{$c->id}}]" id="option_rate_id{{$c->id}}field" class=" rate-calculateion-data"> {{$c->option_name}}
                                            </th>
                                            <td align="right">
                                              
                                                    {!! $payment_currency !!}{{number_format(($c->option_rate*$c->value),2) }}
                                                
                                            </td>
                                         </tr>
                                    @endforeach
                                    @endif
                                   
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($data->sub_amount,2) }}</td>
                                    </tr>
              
              						 @if($data['tax'])
                                        <tr>
                                            <td  align="left" colspan="4" style="padding: 10px;"><strong>Tax ({{ $data['define_tax'] ?? '' }}%): </strong></td>
                                            <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($data['tax'],2) }}</td>
                                        </tr>
                                    @endif
                                     
                                    @if($data->after_total_fees)   
                                    @foreach(json_decode($data->after_total_fees) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
              						@endif					
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($data->total_amount,2) }}</td>
                                    </tr>
                        
                                    
                                    	@php $gaurav_discount=0;@endphp
							    @if($data->discount)
                                    @if($data->discount!="")
                                        @if($data->discount!=0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Discount ({{ $data->discount_coupon }}):</strong></td>
                                            <td align="right" style="padding: 10px; " valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($data->discount,2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
							    @if($data->extra_discount)
                                    @if($data->extra_discount!="")
                                        @if($data->extra_discount>0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; " valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($data->extra_discount,2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
								@if($gaurav_discount==1)
								    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; " valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; " valign="top">{!! $setting_data['payment_currency']  !!}{{number_format($data->after_discount_total,2) }}</td>
                                    </tr>
								@endif
              
                               @php
                                $payments=App\Models\Payment::where(["booking_id"=>$data['id'],"status"=>"complete"])->get();
                            @endphp
                                     @foreach($payments as $c)
                                <tr>
                                        <td colspan="4"  align="left"><strong>{{ $c->type }}-{{ $c->tran_id }}  <span class="text-success">(Paid)</span></strong></td>
                                        <td align="right">- {!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($c->amount,2)}}</td>
                                   </tr>
                                
                            @endforeach
                                    
                                    @if($data->amount_data)
                                        @php
                                            $amount_data=json_decode($data->amount_data,true);
                                            //dd($amount_data);  
                                        @endphp
                                        @if(is_array($amount_data))
                                            @foreach($amount_data as $c)
                                                @php $status='';@endphp
                                                @if(isset($c['status']))
                                                    @php $status='(<span style="color:green;">Paid</span>)'; @endphp
                                                @endif
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c['message']}} {!! $status !!}:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($c['amount'],2) }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif

       </table>
            </div>

  
    <input type="hidden" name="accessories_rate_ids" value="{{ $data->accessories_rate_ids }}">
    <input type="hidden" name="mileage_rate_ids" value="{{ $data->mileage_rate_ids }}">
    <input type="hidden" name="option_rate_ids" value="{{ $data->option_rate_ids }}">
    <input type="hidden" name="discount" value="{{ $data->discount }}" id="coupon_discount"  />
    <input type="hidden" name="discount_coupon" value="{{ $data->discount_coupon }}" id="coupon_discount_code" />
    <input type="hidden" name="after_discount_total" value="{{ $data->remaining_total_amount }}" />
    <input type="hidden" name="total_pets" value="{{ $data->total_pets }}">
    <input type="hidden" name="pet_fee" value="{{ $data->pet_fee }}">
    <input type="hidden" name="guest_fee" value="{{ $data->guest_fee }}">
    <input type="hidden" name="rest_guests" value="{{ $data->rest_guests }}">
    <input type="hidden" name="single_guest_fee" value="{{ $data->single_guest_fee }}">
    <input type="hidden" name="total_payment" value="{{ $data->total_payment }}">
    <input type="hidden" name="amount_data" value="{{ ($data->amount_data) }}">
    <!--<input type="hidden" name="property_id" value="{{ $data->property_id }}"> -->
    <input type="hidden" name="start_date" value="{{ $data->checkin }}" >
    <input type="hidden" name="end_date" value="{{ $data->checkout }}" >
    <input type="hidden" name="total_guests" value="{{ $data->total_guests }}" >
    <input type="hidden" name="adults" value="{{ $data->adults }}" >
    <input type="hidden" name="child" value="{{ $data->child }}" >
    <input type="hidden" name="gross_amount" value="{{ $data->gross_amount }}" >
    <input type="hidden" name="total_night" value="{{ $data->total_night }}" >
    <input type="hidden" name="sub_amount" value="{{ $data->sub_amount }}" >
    <input type="hidden" name="total_amount" value="{{ $data->total_amount }}" >
    <input type="hidden" name="after_total_fees" value="{{ ($data->after_total_fees) }}">
    <input type="hidden" name="custom_before_total_fees" value="{{ ($data->custom_before_total_fees) }}">
    <input type="hidden" name="before_total_fees" value="{{ ($data->before_total_fees) }}">
    <input type="hidden" name="request_id" value="{{ $data->request_id }}" >
    <input type="hidden" name="tax" value="{{ $data->tax }}" >
    <input type="hidden" name="define_tax" value="{{ $data->define_tax }}" >
    <input type="hidden" name="booking_id" value="{{ $data->id }}" >
    
    
    
    

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
