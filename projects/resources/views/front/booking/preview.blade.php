@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)

@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
          $payment_currency= $setting_data['payment_currency'];
    @endphp
	<!-- start banner sec -->
  
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


    <section class="About-sec preview">
        <div class="container">
            <div class="row">
                            <div class="t1">
                            <h4 style="font-size: 17px; color: #000; font-weight: 600">Hey {{$booking['name']}},</h4>

                            <p style=" font-size: 15px; color: #454545; line-height: 24px; font-weight: 400; margin: 0 0 15px 0; text-align: left">Your booking request has been submitted successfully. You will receive an email for the booking request. <br> We will contact you shortly.</p>
                            <div class="table-box">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="2" align="center" style="padding: 10px;" valign="top"><strong>Fleet Detail </strong></th>
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
                            </div>
                            <div class="table-box">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <th colspan="4" align="center" style="padding: 10px;" valign="top" class="book"><strong>Booking Details </strong></th>
                                    </tr>

                                    <tr>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Check In :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Check Out :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top" class="d-none"><strong>Total Guest :</strong></th>
                                        <th align="left" style="padding: 10px;" valign="top"><strong>Total Night :</strong></th>
                                        <th align="center" style="padding: 10px;" valign="top"><strong>Gross Amount :</strong></th>
                                        
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkin'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['checkout'] }}</td>
                                        <td align="left" style="padding: 10px;" valign="top" class="d-none">{{$booking['total_guests'] }} ({{$booking['adults']}} Adults, {{$booking['child']}} Child)</td>
                                        <td align="left" style="padding: 10px;" valign="top">{{$booking['total_night'] }}</td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['gross_amount'],2) }}</td>
                                    </tr>
                                    		
								@if($booking['rest_guests'])
								    @if($booking['rest_guests']>0)
								        @if($booking['guest_fee'])
								            @if($booking['guest_fee']>0)
								            <tr>
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><strong> Additional Guest Fee <br> <span style="font-size:13px;">({{$booking['total_night']}} nights * {!! $setting_data['payment_currency'] !!}{{$booking['single_guest_fee']}} * {{$booking['rest_guests']}} Guests)</span></strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['guest_fee'],2) }}</td>
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
            									<td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top"><strong>Pet Fee :</strong></td>
            									<td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">{!! $setting_data['payment_currency'] !!}{{number_format($booking['pet_fee'],2) }}</td>
            								</tr>
								            @endif
								        @endif
								    @endif
								@endif
								
								
                                    
                                    
                                    @foreach(json_decode($booking['before_total_fees']) as $c)
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach

                                    @foreach(json_decode($booking['accessories_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c->accessories_name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach(json_decode($booking['mileage_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c->milleage_name}}
                                            @isset($c->message)
                                                <small>( {{ $c->message }} )</small>
                                            @endisset
                                        :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach(json_decode($booking['option_rate_ids']) as $c)
                                
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c->option_name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format(($c->option_rate*$c->value),2) }}</td>
                                    </tr>
                                    @endforeach
                             

                            

                                 

                                    @foreach(json_decode($booking['after_total_fees']) as $c)
                                    <tr >
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c->name}} :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
                                    </tr>
                                    @endforeach
                                           @if($booking['tax'])
                             
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Tax ({{ $booking['define_tax'] ?? '' }}%) :</strong></td>
                                            <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['tax'],2) }}</td>
                                        </tr>
                                  
                                    @endif
                                    
                                    <tr>
                                        <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>Total :</strong></td>
                                        <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($booking['total_amount'],2) }}</td>
                                    </tr>
                                        	@php $gaurav_discount=0;@endphp
							    @if($booking['discount'])
                                    @if($booking['discount']!="")
                                        @if($booking['discount']!=0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Discount ({{ $booking['discount_coupon'] }}):</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
							    @if($booking['extra_discount'])
                                    @if($booking['extra_discount']!="")
                                        @if($booking['extra_discount']>0)
                                               @php $gaurav_discount=1;@endphp 
                                        <tr>
                                            <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Extra Discount :</strong></td>
                                            <td align="right" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">- {!! $setting_data['payment_currency']  !!}{{number_format($booking['extra_discount'],2) }}</td>
                                        </tr>
                                      
                                        @endif
                                    @endif
                                @endif
								@if($gaurav_discount==1)
								    <tr>
                                        <td align="left" colspan="3" style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-right:0px solid #6c3e79 border-bottom:0px solid #6c3e79;;" valign="top"><strong>Total Amount after Discount:</strong></td>
                                        <td align="right"  style="padding: 10px; font-weight: bold; font-size: 15px; color:#000; border: 1px solid #6c3e79; border-bottom:0px solid #6c3e79;" valign="top">{!! $setting_data['payment_currency']  !!}{{number_format($booking['after_discount_total'],2) }}</td>
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
                                                <td align="left" colspan="3" style="padding: 10px;" valign="top"><strong>{{$c['message']}} {!! $status !!}:</strong></td>
                                                <td align="right" style="padding: 10px;" valign="top">{!! $payment_currency !!}{{number_format($c['amount'],2) }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@stop