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
    @php $payment_currency= $setting_data['payment_currency'];@endphp
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

<section class="About-sec payment">
    <div class="container">
        <div class="row">
            <div class="table-box">
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
                                     
                                        <td  align="left" style="padding: 10px;text-align:center;" valign="top" colspan="2" >
                                                <a href="{{ url('properties/detail/'.$property->seo_url) }}" target="_BLANK">
                                                        <img src="{{asset($property->feature_image)}}" class="img-fluid" style="height:200px;" alt="">
                                               </a> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>Fleet Name :</strong></td>
                                        <td align="left" style="padding: 10px;" valign="top"><strong>{{$property->name }}</strong></td>
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

                                @if($booking['custom_before_total_fees'])
                                    @foreach(json_decode($booking['custom_before_total_fees'],true) as $p)
                                        @isset($p['product_amount'])
                                            <tr>
                                                <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$p['product_name']}} :</strong></td>
                                                <td align="right" style="padding: 10px; " valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($p['product_amount'],2) }}</td>
                                            </tr>
                                        @endisset
                                    @endforeach
                                @endif
                                @foreach(json_decode($booking['accessories_rate_ids']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->accessories_name}}:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}</td>
                                    </tr>
                                @endforeach
                                @foreach(json_decode($booking['mileage_rate_ids']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->milleage_name}}
                                            @isset($c->message)
                                                <small>( {{ $c->message }} )</small>
                                            @endisset
                                        :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}</td>
                                    </tr>
                                @endforeach
                                @foreach(json_decode($booking['option_rate_ids']) as $c)
                                    <tr>
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>{{$c->option_name}}:</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->option_rate*$c->value),2) }}</td>
                                    </tr>
                                @endforeach
                           
                                    <tr style="display:none;">
                                        <td align="left" colspan="4" style="padding: 10px;" valign="top"><strong>Sub Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['sub_amount'],2) }}</td>
                                    </tr>
                                @foreach(json_decode($booking['after_total_fees']) as $c)
                                    <tr >
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
            </div>
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true" style="font-size:20px">×</span>
                                    </button>
                                    {{ session('success_msg') }}
                                </div>
                                @endif
                                @if(session('error_msg'))
                                <div class="alert alert-danger fade in alert-dismissible show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true" style="font-size:20px">×</span>
                                    </button>    
                                    {{ session('error_msg') }}
                                </div>
                                @endif
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4><strong>Payment</strong></h4>
                                    </div>                       
                                </div>    
                                <div class="row">                        
                                    <div class="col-xs-12 col-md-12" style=" border-radius: 5px; padding: 10px;">
                                        <div class="panel panel-primary">                                       
                                            <div class="creditCardForm">                                    
                                                <div class="payment">
                                                    <form id="payment-card-info" method="post" action="{{ route('instapay.submit',[$booking['id']]) }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group first_name col-md-6">
                                                                <label for="first_name">First Name</label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                                            </div>
                                                            <div class="form-group last_name col-md-6">
                                                                <label for="last_name">Last Name</label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group street col-md-12">
                                                                <label for="street">Street</label>
                                                                <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}" required>
                                                            </div>
                                                            <div class="form-group street2 col-md-6 " style="display:none;">
                                                                <label for="street2">Street2</label>
                                                                <input type="text" class="form-control" id="street2" name="street2" value="{{ old('street2') }}" >
                                                            </div>
                                                        </div> 
                                                        <div class="row">
                                                            <div class="form-group city col-md-6">
                                                                <label for="city">city</label>
                                                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                                            </div>
                                                            <div class="form-group state col-md-6">
                                                                <label for="state">state</label>
                                                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
                                                            </div>
                                                            <div class="form-group country col-md-6">
                                                                <label for="country">country</label>
                                                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required>
                                                            </div>
                                                            <div class="form-group zip col-md-6">
                                                                <label for="zip">zip</label>
                                                                <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}" required>
                                                            </div>
                                                            <div class="form-group mobile col-md-6">
                                                                <label for="mobile">mobile</label>
                                                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                                                            </div>
                                                        </div> 
                                                        
                                                        

                                                        
                                                        
                                                        <div class="row">
                                                            <div class="form-group col-md-4" id="card-number-field">
                                                                <label for="cardNumber">Card Number</label>
                                                                <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" required>
                                                            </div>
                                                            <div class="form-group col-md-4 d-none" >
                                                                <label for="amount">Amount</label>
                                                                <input type="text" class="form-control" id="amount" name="amount" min="1" value="{{ $amount }}" required>
                                                            </div>
                                                            <div class="form-group CVV col-md-4">
                                                                <label for="cvv">CVV</label>
                                                                <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                                            </div>
                                                            <div class="form-group col-md-4" id="expiration-date">
                                                                <label>Expiration Date</label><br/>
                                                                <select class="form-control" id="expiration-month" name="expiration-month" style="float: left; width: 45%; margin-right: 10px;">
                                                                    @foreach($months as $k=>$v)
                                                                        <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                                    @endforeach
                                                                </select>  
                                                                <select class="form-control" id="expiration-year" name="expiration-year"  style="float: left; width: 45%;">
                                                                    @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>            
                                                                    @endfor
                                                                </select>
                                                            </div> 
                                                        </div>    
                                                        <div class="form-group mt-4" id="pay-now">
                                                            <button type="submit" class="btn-success themeButton btn-25" id="confirm-purchase"><span>Confirm Payment</span></button>
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

@stop
@section("css")

@stop