@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        $amount=$booking['total_amount'];
    @endphp
     @if($booking['discount'])
        @if($booking['discount']!="")
            @if($booking['discount']!=0)
            @php $amount=$booking['after_discount_total']; @endphp
            @endif
        @endif
    @endif
    @php
  $payment_currency= $setting_data['payment_currency'];
    @endphp
      @if($booking['amount_data'])
            @php
                $amount_data=json_decode($booking['amount_data'],true);
            @endphp
            @if(is_array($amount_data))
                @foreach($amount_data as $c)
                    @php $status='';@endphp
                    @if(isset($c['status']))
                  
                    @else
                        @php $amount=$c['amount'];break; @endphp
                    @endif
          
                @endforeach
            @endif
        @endif
    <!-- start banner sec -->
    @php //$amount=0.1; @endphp
    
    <section class="page-title" style="background-image: url({{$bannerImage}});">
        <div class="auto-container">
            <h1 data-aos="zoom-in" data-aos-duration="1500" class="aos-init aos-animate">{{$name}}</h1>
            <div class="checklist">
                <p>
                    <a href="{{url('/')}}" class="text"><span>Home</span></a>
                    <a class="g-transparent-a">{{$name}}</a>
                </p>
            </div>
        </div>
    </section>

    <!-- start about section -->
        
      <!-- About Section -->
 
      <section class="About-sec payment">

        <div class="container">

            <div class="row">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="left" valign="top" style="border:0px solid; padding:0px;">
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Property Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>Property Name :</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$property->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="5" align="center" style="padding: 10px;" valign="top" class="book"><strong>Booking Detail </strong></th>
                                    </tr>

                                    <tr>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkin :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Checkout :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Guest :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Night :</strong></th>
                                        <th align="right" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkin'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkout'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_night'] }}</td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['gross_amount'],2) }}</td>
                                    </tr>
                                    
                                    	@if($booking['rest_guests'])
								    @if($booking['rest_guests']>0)
								        @if($booking['guest_fee'])
								            @if($booking['guest_fee']>0)
								            <tr>
            									<td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">({{$booking['total_night']}} nights * {!! $setting_data['payment_currency'] !!}{{$booking['single_guest_fee']}} * {{$booking['rest_guests']}} Guests)</span></strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['guest_fee'],2) }}</td>
            								</tr>
								            @endif
								        @endif
								    @endif
								@endif
								
								
								@if($booking['total_pets'])
								    @if($booking['total_pets']>0)
								        @if($booking['pet_fee'])
								            @if($booking['pet_fee']>0)
								            <tr>
            									<td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top"><strong>Pet Fee :</strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['pet_fee'],2) }}</td>
            								</tr>
								            @endif
								        @endif
								    @endif
								@endif
								
                                    @foreach(json_decode($booking['before_total_fees']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                    
                                    @foreach(json_decode($booking['accessories_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->accessories_name}}  ({{ $c->value }}*{!! $payment_currency !!}{{$c->accessories_rate}}):</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach(json_decode($booking['mileage_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->milleage_name}}  ({{ $c->value }}*{!! $payment_currency !!}{{$c->milleage_rate}}):</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach(json_decode($booking['option_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->option_name}}  ({{ $c->value }}*{!! $payment_currency !!}{{$c->option_rate}}):</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->option_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                              
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['sub_amount'],2) }}</td>
                                    </tr>
                                    
                                    @foreach(json_decode($booking['after_total_fees']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                          @if($booking['tax'])
                             
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Tax ({{ $booking['define_tax'] ?? '' }}%): :</strong></td>
                                            <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['tax'],2) }}</td>
                                        </tr>
                                  
                                    @endif
                                    
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['total_amount'],2) }}</td>
                                    </tr>
                                      	@php $gaurav_discount=0;@endphp
							    @if($booking['discount'])
                                    @if($booking['discount']!="")
                                        @if($booking['discount']!=0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Discount ({{ $booking['discount_coupon'] }}):</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
							    @if($booking['extra_discount'])
                                    @if($booking['extra_discount']!="")
                                        @if($booking['extra_discount']>0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['extra_discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
								@if($gaurav_discount==1)
								    <tr>
                                        <td align="left" colspan="4" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-right:0px solid #02c3ff border-bottom:0px solid #02c3ff;;" valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #02c3ff; border-bottom:0px solid #02c3ff;" valign="top">{!! $setting_data['payment_currency']  !!}{{number_format($booking['after_discount_total'],2) }}</td>
                                    </tr>
								@endif
                                    

                                    @if($booking['amount_data'])
                                        @php
                                            $amount_data=json_decode($booking['amount_data'],true);
                                        @endphp
                                        @if(is_array($amount_data))
                                            @foreach($amount_data as $c)
                                                @php $status='';@endphp
                                                @if(isset($c['status']))
                                                    @php $status='(<span style="color:green;">Paid</span>)'; @endphp
                                                @endif
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c['message']}} {!! $status !!}:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c['amount'],2) }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif



                                </tbody>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
 @php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp
<!-- Company Overview section START -->
<section class="container-fluid " >
    <div class="card-panel">
        <div class="media wow fadeInUp" data-wow-duration="1s"> 
            <div class="companyIcon">
            </div>
            <div class="media-body">
                
                <div class="container">
                    @if(session('success_msg'))
                    <div class="alert alert-success fade in alert-dismissible show">                
                     
                        {{ session('success_msg') }}
                    </div>
                    @endif
                    @if(session('error_msg'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                      
                        {{ session('error_msg') }}
                    </div>
                    @endif
               
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Payment</h1>
                        </div>
                   
                    </div> 
                 
                    <div class="row">                        
                        <div class="col-xs-12 col-md-12" style=" border-radius: 5px; padding: 10px;">
                            <div class="panel panel-primary">                                       
                                <div class="creditCardForm">                                    
                                    <div class="payment get-quote-sec" style="padding:0px;">
                                        <form id="payment-card-info" method="post" action="{{ route('authorize.submit',[$booking['id']]) }}">
                                            @csrf
                                            <h3>*Check the box to acknowledge</h3>
            @php
                $location=App\Models\Location::find($property->location_id);
            @endphp
            @if($location)
                @if($location->amount)
             <div class="col-md-12 certify">
                <input type="checkbox" name="refund" required="">
                <label for="refund"> A refundable ${{ $location->amount }} security deposit is due 2 days prior to departure</label>
            </div>
                @endif
            @endif
                 <div class="col-md-12 certify">
                <input type="checkbox" name="addt" required="">
                <label for="addt"> Please verify that you will be on time for pick up at 2 pm or additional fees apply.</label>
                </div>
                 <div class="col-md-12 certify">
                <input type="checkbox" name="addt" required="">
                <label for="addt"> Please verify that you will be on time to drop off at 9 am or additional fees apply.</label>
                </div>
                 <div class="col-md-12 certify">
                <input type="checkbox" name="cancl" required="">
                <label for="cancl"> Do you agree to the terms of the cancellation policy? NO EXCEPTIONS. There are no refunds (all fees collected) if the cancellation is made 30 days or less prior to the departure date. For cancellation made 31 days or more, the cancellation must be in writing and is a 50% refund of money collected plus a $99 processing fees and taxes. NO REFUND FOR EARLY RETURNS.</label>
                </div>
            <h3>*Age Requirement Confirmation</h3>
             <div class="col-md-12 certify">
                <input type="checkbox" name="certify" required="">
                <label for="certify"> I certify that I’m at least 25 years old at the time of rental and I have a valid drivers license.</label>
                </div>
                @if($location)
            <h3>*Insurance</h3>
             <div class="col-md-12 certify">
           
                <label for="certify"> {{ $location->shortDescription }}</label>
                </div>
                @endif
                                            <div class="row">
                                                <div class="form-group owner col-md-6">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="company">Company</label>
                                                    <input type="text" class="form-control" id="company" name="company" value="{{ old('company') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="mobile">Mobile</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-12">
                                                    <label for="address">Credit Card Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="zipcode">Zip Code</label>
                                                    <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" required>
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="zipcode">Country</label>
                                                    {!! Form::select("country",ModelHelper::countryDataSelect(),233,["class"=>"form-control","required","id"=>"country-data"]) !!}
                                                    
                                                </div>
                                                <div class="form-group owner col-md-6">
                                                    <label for="zipcode">State</label>
                                                    {!! Form::select("state",[],null,["class"=>"form-control","required","id"=>"state-data"]) !!}
                                                    
                                                </div>
                                               
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-4" id="card-number-field">
                                                    <label for="cardNumber">Card Number</label>
                                                    <input type="number" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" required max="9999999999999999" min="10000000000000" title="Enter Valid Card No" class="form-control" oninvalid="this.setCustomValidity('Card no is not Valid')" onchange="try{setCustomValidity('')}catch(e){}" oninput="setCustomValidity(' ')" >
                                                    
                                                </div>
                                                <div class="form-group col-md-4 d-none" >
                                                    <label for="amount">Amount</label>
                                                    <input type="text" class="form-control" id="amount" name="amount" min="1" value="{{ $amount }}" required>
                                                   
                                                </div>
                                               
                                                <div class="form-group col-md-4" id="expiration-date">
                                                    <label>Expiration Date</label><br/>
                                                    <select class="form-control" id="expiration-month" name="expiration-month" style="float: left; width: 47%; margin-right: 10px;">
                                                        @foreach($months as $k=>$v)
                                                            <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>                                                        
                                                        @endforeach
                                                    </select>  
                                                    <select class="form-control" id="expiration-year" name="expiration-year"  style="float: left; width: 50%;">
                                                        
                                                        @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>            
                                                        @endfor
                                                    </select>
                                                </div>
                                                 <div class="form-group CVV col-md-4">
                                                    <label for="cvv">CVV <span class="icon">!<span class="box-msg">
            														American Express: 4 digits on the Front<br>
Visa, Mastercard, Discover: Last 3 digits on the back of the card.
            													</span></span></label>
                                                    <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                                    
                                                </div>
                                            </div>    
                                          
                                            <div class="form-group mt-4" id="pay-now">
                                                <button type="submit" class="btn btn-success themeButton" id="confirm-purchase">Confirm Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                        </div>   
                      
                           
                    </div>
                </div>
            </div>

        </div>
    </div> 
    <div class="clearfix"></div>
</section>
                


            </div>

        </div>

    </section>

   

@stop
@section("js")
@parent
<script>
    $(document).on("change","#country-data",function(){
        $.post("{{ route('stateDateSelect') }}",{_token:"{{ csrf_token() }}",id:$("#country-data").val()},function(data){
            $("#state-data").html(data)
        });
    });
    $(function(){
         $.post("{{ route('stateDateSelect') }}",{_token:"{{ csrf_token() }}",id:$("#country-data").val()},function(data){
            $("#state-data").html(data)
        });
    });
    $(document).on("submit","#payment-card-info",function(){
        $("#confirm-purchase").attr("disabled",true);
        $("#pay-now").hide();
    });
</script>

@stop
@section("css")

@stop