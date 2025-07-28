 	@php $payment_currency= $setting_data['payment_currency'];   @endphp
<div class="price" style=" padding: 20px 0; border-top: 1px solid #dddddd;">
    <h2 style="font-size: 16px; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; margin: 0; margin-bottom: 15px;">Price details</h2>
    <table class="prices" style="border-spacing: 0px; width:100%;">
        <tr class="price-per-night">
            <td style="padding-bottom: 15px;">Price Per Night x {{$data['total_night'] }} nights</td>
            <td class="amt" style="text-align: right; padding-bottom: 15px;">{!! $payment_currency !!}{{number_format($data['gross_amount'],2) }}</td>
        </tr>
        @if($data['rest_guests'])
            @if($data['rest_guests']>0)
                @if($data['guest_fee'])
                    @if($data['guest_fee']>0)
                        <tr class="admin-fee">
                            <td><strong> Additional Guest Fee <br> <span style="font-size:13px;">({{$data['total_night']}} nights * {!! $setting_data['payment_currency'] !!}{{$data['single_guest_fee']}} * {{$data['rest_guests']}} Guests)</span></strong></td>
                            <td class="amt" style="text-align: right;">{!! $setting_data['payment_currency'] !!}{{number_format($data['guest_fee'],2) }}</td>
                        </tr>
                    @endif
                @endif
            @endif
        @endif
        @if($data['total_pets'])
            @if($data['total_pets']>0)
                @if($data['pet_fee'])
                    @if($data['pet_fee']>0)

                <tr class="admin-fee">
                    <td>Pet Fee :</td>
                    <td class="amt" style="text-align: right;">{!! $setting_data['payment_currency'] !!}{{number_format($data['pet_fee'],2) }}</td>
                </tr>
                    @endif
                @endif
            @endif
        @endif
        @foreach(json_decode($data['before_total_fees']) as $c)
                <tr class="admin-fee">
                    <td>{{$c->name}} :</td>
                    <td class="amt" style="text-align: right;">{!! $setting_data['payment_currency'] !!}{{($c->amount) }}</td>
                </tr>
        @endforeach
        @if($data['custom_before_total_fees'])
            @foreach(json_decode($data['custom_before_total_fees'],true) as $p)
                @isset($p['product_amount'])
                    <tr class="admin-fee">
                        <td>{{$p['product_name']}} : </td>
                        <td class="amt" style="text-align: right;">{!! $setting_data['payment_currency'] !!}{{($p['product_amount']) }}</td>
                    </tr>
                @endisset
            @endforeach
        @endif
        @php
            $payment_currency=$setting_data['payment_currency'] ;
        @endphp
            @if(count(json_decode($data['mileage_rate_ids']))>0) 
            @endif
            @foreach(json_decode($data['mileage_rate_ids']) as $c)
                <tr class="admin-fee millage-data">
                    <td>{{$c->milleage_name}}
                                            @isset($c->message)
                                                <small>( {{ $c->message }} )</small>
                                            @endisset 
                    </td>
                    <td class="amt" style="text-align: right;">{!! $payment_currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}</td>
                </tr>
            @endforeach
            @foreach(json_decode($data['option_rate_ids']) as $c)
                <tr class="admin-fee">
                    <td>{{$c->option_name}}  ({{ $c->value }}*{!! $payment_currency !!}{{$c->option_rate}}): </td>
                    <td class="amt" style="text-align: right;">{!! $payment_currency !!}{{number_format(($c->option_rate*$c->value),2) }}</td>
                </tr>
            @endforeach
            @foreach(json_decode($data['accessories_rate_ids']) as $c)
        
                <tr class="admin-fee">
                    <td>{{$c->accessories_name}} ({{ $c->value }}*{!! $payment_currency !!}{{$c->accessories_rate}}): </td>
                    <td class="amt" style="text-align: right;">{!! $payment_currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}</td>
                </tr>
            @endforeach
        @foreach(json_decode($data['after_total_fees']) as $c)
         <tr class="admin-fee">
                <td>{{$c->name}} :</td>
                <td class="amt" style="text-align: right;">{!! $payment_currency !!}{{number_format($c->amount,2) }}</td>
            </tr>
        @endforeach
            @if($data['tax'])
                <tr class="admin-fee">
                    <td>Tax ({{ $data['define_tax'] ?? '' }}%): </td>
                    <td class="amt" style="text-align: right;">{!! $payment_currency !!}{{number_format($data['tax'],2) }}</td>
                </tr>
            @endif
   		<tr class="total">
            <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Total :</b></td>
            <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>{!! $payment_currency !!}{{number_format($data['total_amount'],2) }}</b></td>
        </tr>
        @php $gaurav_discount=0;@endphp
        @if($data['discount'])
            @if($data['discount']!="")
                @if($data['discount']!=0)
                       @php $gaurav_discount=1;@endphp 
              		<tr class="discount">
                        <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Discount ({{ $data['discount_coupon'] }}) :</b></td>
                        <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>- {!! $payment_currency !!}{{number_format($data['discount'],2) }}</b></td>
                    </tr>
                @endif
            @endif
        @endif
        @if($data['extra_discount'])
            @if($data['extra_discount']!="")
                @if($data['extra_discount']>0)
                       @php $gaurav_discount=1;@endphp
                  <tr class="discount">
                        <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Extra Discount :</b></td>
                        <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>- {!! $payment_currency !!}{{number_format($data['extra_discount'],2) }}</b></td>
                    </tr>
                @endif
            @endif
        @endif
        @if($gaurav_discount==1)
            <tr class="discount">
                <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>Total Amount after Discount :</b></td>
                <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>{!! $payment_currency !!}{{number_format($data['after_discount_total'],2) }}</b></td>
            </tr>
        @endif
           @if($data['amount_data'])
                @php   $amount_data=json_decode($data['amount_data'],true);  @endphp
                @if(is_array($amount_data))
                    @foreach($amount_data as $c)
                        @php $status='';@endphp
                        @if(isset($c['status']))
                            @php $status='(<span style="color:green;">Paid</span>)'; @endphp
                        @endif
                       <tr class="amt-discount">
                            <td style="padding-top: 15px; border-top: 1px solid #dddddd;"><b>{{$c['message']}} {!! $status !!} :</b></td>
                            <td class="amt" style="text-align: right; padding-top: 15px; border-top: 1px solid #dddddd;"><b>{!! $payment_currency !!}{{number_format($c['amount'],2) }}</b></td>
                        </tr>
                    @endforeach
                @endif
            @endif

    </table>
</div>