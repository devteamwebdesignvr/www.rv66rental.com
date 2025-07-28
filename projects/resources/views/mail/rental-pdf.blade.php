<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agreement</title>
        <style>
            body {
            width: 100%;  
            height: 100%; 
            margin: 0 auto; 
            color: #000;
            background: #FFFFFF; 
            font-family: Arial, Helvetica, sans-serif; 
            font-size: 12px; 
            }
            table{
            border-spacing: 0px;
            width:100%;
            width: 100%;
        
            }
            .clearfix:after {
            content: "";
            display: table;
            clear: both;
            }
            a{
            color:#000;
            text-decoration: none;
            }
            p{
            margin-top: 0px;
            margin-bottom: 0px;
            line-height: 1.5;
            font-weight: 400;
            }
            .main-area{
            width:700px;
            margin: auto;
           
            }
            .head {
            margin-bottom: 10px;
            }
            .head th{
            width: 50%;
            text-align: left;
            vertical-align: top;
            }
            .head th.owner-detail{
            text-align: right;
            }
            h1 {
            width: 100%;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            color: #000;
            font-weight: 700;
            }
            .head a {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
            }
            .head a img {
            width: 13px;
            margin-right: 5px;
            }
            h2 {
            padding: 0;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            padding-bottom: 3px;
            border-bottom: 1px solid #dddd;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            width: 100%;
            }
            h2 img{
            width: 15px;
            margin-right: 5px;
            }
            .inner {
            gap: 2%;
            }
            .inner div{
            width:49%;
            }
            .content {
            gap:4%;
            }
            .content tr{
            vertical-align: top;
            }
            .right-content, .left-content {
            width: 50%;
            }
            .left-content{
            padding-right: 20px;
            }
            .right-content{
            padding-left: 20px;
            }
            .right-content img{
            width: 15px;
            margin-right: 5px;
            }
            .right-content a {
            line-height: 1.5;
            display: flex;
            align-items: center;
            }
            .rental.cont {
            margin-top: 0px;
            }
            .rental.cont div{
            margin-bottom: 5px;
            }
            table.reservation.cont {
            margin-bottom: 20px;
            }
            .rental-feature div{
            width: 33.33%;
            }
            .cancel.cont {
            margin-top: 15px;
            }
            p.para {
            margin-bottom: 8px;
            }
            .charges.cont {
            margin-top: 0px;
            }
            .charges-head {
            border-bottom: 1px solid #dddd;
            padding-bottom: 2px;
            margin-bottom: 8px;
            }
            .charges-body div.cont{
            border-bottom: 1px solid #dddd;
            padding-bottom: 3px;
            margin-bottom: 8px;
            }
            .tl{
            margin-bottom: 0px;
            }
            .tl div.left {
            width: 70%;
            text-align: right;
            }
            .tl div.right {
            width: 30%;
            text-align: right;
            }
            .total.tl b{
            font-size: 14px;
            }
            .terms {
            margin-top: 20px;
            margin-bottom: 10px;
            }
            .rental.cont td {
            width: 33.33%;
            padding-bottom: 5px;
            }
            .desc {
            text-align: left;
            }
            table.charges-cont th, table.charges-cont td{
            border-bottom: 1px solid #dddd;
            padding-bottom: 5px;
            padding-top: 5px;
            }
            table.charges-cont .amt {
            text-align: right;
            }
            table.charges-cont td.sub.right, td.total.right {
            text-align: right;
            border-bottom: 0px;
            }
            table.charges-cont td.sub.left, td.total.left {
            border-bottom: 0px;
            text-align: right;
            }
            th.logo {
            text-align: left;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            }
            th.logo img {
            width: 130px;
            }
            th.owner-detail {
            text-align: right;
            border-bottom: 0px solid #ddd;
            padding-bottom: 15px;
            }
            .trial th.owner-detail {
                border-bottom: 1px solid #ddd;
            }
            th.owner-detail h1{
            font-size: 20px;
            font-weight: 300;
            }
            table.owner-profile {
            margin-top: 20px;
            margin-bottom: 20px;
            }
            table.owner-profile th, table.owner-profile td{
            text-align: left;
            }
            table.owner-profile th{
            text-transform: uppercase;
            padding-bottom: 5px;
            }
            table.owner-profile td{
            font-size: 12px;
            font-weight: 400;
            padding-bottom: 5px;
            }
            table.owner-profile img{
            width: 10px;
            margin-right: 3px;
            }
            .signed {
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            padding-bottom: 5px;
            }
            b{
            font-weight: 700;
            }
            .history {
            margin-top: 30px;
            }
            .history h2{
            font-weight: 300;
            font-size: 18px;
            border-bottom: 0px solid;
            }
            .document-history td{
            padding-top: 10px;
            padding-bottom: 20px;
            }
            .document-history tr {
            vertical-align: top;
            }
            .document-history td.img {
            text-align: center;
            padding-right: 0px;
            width: 10%;
            }
            .document-history img {
            width: 24px;
            margin-bottom: 5px;
            }
            .document-history td.img p{
            font-size: 10px;
            }
            .document-history td.date {
            padding-left: 15px;
            }
            .document-history td.date p, .document-history td.cont p{
            margin-bottom: 5px;
            }
            .foot {
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            }
            .trial .head th{
            vertical-align: middle;
            }
            .trial {
            margin-top: 60px;
            }
            .page-break {
            page-break-after: always;
            }

            .renter.cont{
                margin-top: 20px;
            }

            .renter.cont img{
                width: 15px;
                margin-right: 5px;
            }
            .renter.cont p{
                margin-bottom: 3px;
            }
        </style>
    </head>
    <body>
        <div class="main-area">
            <div class="agreement">
                <table class="head">
                    <tr>
                        <th class="owner-name">
                            <h1><b>RV66 rental</b></h1>
                        </th>
                        <th class="owner-detail">
                            <p><a href="tel:+1 (630) 854-8949"><img src="{{ asset('front/pdf') }}/images/call.png" alt="Call">(630) 854-8949</a></p>
                            <p><a href="http://www.rv66rental.com/" target="_blank">www.rv66rental.com</a></p>
                        </th>
                    </tr>
                </table>
                <table class="content">
                    <tr>
                        <td class="left-content">
                            <table class="reservation cont">
                                <tr class="inner">
                                    <td class="pickup" colspan="2">
                                        <h2><img src="{{ asset('front/pdf') }}/images/calendar.png" alt="Reservation">RESERVATION #{{$data->id}}</h2>
                                    </td>
                                </tr>
                                <tr class="inner">
                                    <td class="pickup">
                                        <p><b>Renter Pickup</b></p>
                                        <p>{{date('M d, Y',strtotime($data->checkin))}} @ 02:00 PM</p>
                                        <p>150 Anton Dr</p>
                                        <p>Romeoville IL, 60446</p>
                                    </td>
                                    <td class="drop">
                                        <p><b>Renter Dropoff</b></p>
                                        <p>{{date('M d, Y',strtotime($data->checkout))}} @ 09:00 AM</p>
                                        <p>150 Anton Dr</p>
                                        <p>Romeoville IL, 60446</p>
                                    </td>
                                </tr>
                            </table>
                            @php
                            $property=App\Models\Property::find($data->property_id);
                            @endphp
                            <table class="rental cont">
                                <tr>
                                    <td class="rental-name" colspan="3">
                                        <h2><img src="{{ asset('front/pdf') }}/images/van.png" alt="Rental">RENTAL #{{$property->id ?? ''}}</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="rental-name" colspan="3">
                                        <p><b>Name</b></p>
                                        <p>{{$property->name ?? ''}}</p>
                                    </td>
                                </tr>
                                <tr class="rental-feature">
                                    @php
                                    $location=App\Models\Location::where("id",$property->location_id)->first();
                                    @endphp
                                    <td class="rental-type" colspan="3">
                                        <p><b>Type</b></p>
                                        <p>{{$location->name ??''}}</p>
                                    </td>
                                    <td class="rental-sleep">
                                        <p><b>Sleeps</b></p>
                                        <p>{{$property->sleeps ?? ''}}</p>
                                    </td>
                                </tr>
                            </table>
                            <div class="cancel cont">
                                <h2><img src="{{ asset('front/pdf') }}/images/shield.png" alt="Cancellation">CANCELLATION & RULES</h2>
                                <div class="cancel-content">
                                    <p class="para"><b>Security Deposit</b> A security deposit of <b>$1000.00</b> is authorized before two days. It
                                        is released 10 days after the trip ends unless any damages need to be assessed.
                                    </p>
                                    <p style="display:none;"><b>Sc</b></p>
                                    <p style="display:none;" class="para">5 hours included per night</p>
                                    <p style="display:none;" class="para"><b>$5.00</b>/per hour of additional usage</p>
                                    <p style="display:none;"><b>George</b></p>
                                    <p style="display:none;" class="para">100 miles included per night</p>
                                    <p style="display:none;" class="para"><b>$0.54</b>/per mile of additional mileage</p>
                                    <p class="para"><b>Cancellation</b> NO EXCEPTIONS. There are no refunds ( all fees collected) if the
                                        cancellation is made 30 days or less prior to the departure date. For cancellation made
                                        31 days or more, the cancellation must be in writing and is a 50% refund of money
                                        collected plus a $ 99 processing fees and taxes. NO REFUND FOR EARLY RETURNS
                                    </p>
                                    <p><b>Rules of the Road</b> Not Provided</p>
                                </div>
                            </div>
                            <div class="renter cont">
                                <h2><img src="{{ asset('front/pdf') }}/images/user.png" alt="Renter">RENTER</h2>
                                <div class="renter-detail">
                                    <p>{{$data->name}}</p>
                                    @if($data->mobile)
                                    <p><img src="{{ asset('front/pdf') }}/images/call.png" alt="Call">{{$data->mobile}}</p>
                                    @endif
                                    @if($data->email)
                                    <p><img src="{{ asset('front/pdf') }}/images/envelope.png" alt="Email">{{$data->email}}</p>
                                    @endif
                                    <p  style="display:none;"><b>Verified Drivers</b></p>
                                </div>
                            </div>
                        </td>
                        <td class="right-content">
                            
                            @php
                            $currency=ModelHelper::getDataFromSetting('payment_currency');
                            @endphp
                            <div class="charges cont">
                                <h2><img src="{{ asset('front/pdf') }}/images/list.png" alt="Cancellation">RENTER CHARGES</h2>
                                <div class="charges-body">
                                    <table class="charges-cont">
                                        <tr class="charges-head">
                                            <th class="desc">
                                                <p><b>Description</b></p>
                                            </th>
                                            <th class="amt">
                                                <p><b>Total</b></p>
                                            </th>
                                        </tr>
                                        <tr class="rent-amt cont">
                                            <td class="desc">
                                                <p><b>Rental Amount</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>{{$currency}}{{ number_format($data->gross_amount) }}</p>
                                            </td>
                                        </tr>
                                        @foreach(json_decode($data->before_total_fees) as $c)
                                        <tr  class="fee cont">
                                            <td  class="desc">
                                                <p><b>{{$c->name}} :</b></p>
                                            </td>
                                            <td  class="amt">{{$currency}}{{number_format($c->amount,2) }}</td>
                                        </tr>
                                        @endforeach
                                      
                                        @foreach(json_decode($data->mileage_rate_ids) as $c)
                                        <tr class="fee cont">
                                            <td class="desc">
                                                <p><b>{{$c->milleage_name}}</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>{!! $currency !!}{{number_format(($c->milleage_rate*$c->value),2) }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @foreach(json_decode($data->option_rate_ids) as $c)
                                        <tr class="covid cont">
                                            <td class="desc">
                                                <p><b>{{$c->option_name}}</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>{!! $currency !!}{{number_format(($c->option_rate*$c->value),2) }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @foreach(json_decode($data->accessories_rate_ids) as $c)
                                        <tr class="disc cont">
                                            <td class="desc">
                                                <p><b>{{$c->accessories_name}}</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>{!! $currency !!}{{number_format(($c->accessories_rate*$c->value),2) }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($data->tax)
                                        <tr class="pass cont">
                                            <td class="desc">
                                                <p><b>Tax ({{ $data->define_tax ?? '' }}%):</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>{!! $currency !!}{{number_format($data['tax'],2) }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                            
                                        @foreach(json_decode($data->after_total_fees) as $c)
                                         <tr  class="fee cont">
                                            <td  class="desc">
                                                <p><b>{{$c->name}} :</b></p>
                                            </td>
                                            <td  class="amt">{{$currency}}{{number_format($c->amount,2) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="p-d-days cont">
                                            <td class="desc" colspan="2">
                                                <p><b>Pick and Drop Off Days</b></p>
                                                <p>No Pick up or Drop Off on Weekends and Holidays.</p>
                                            </td>
                                        </tr>
                                        @php $gaurav_discount=0;@endphp
                                        @if($data->discount)
                                        @if($data->discount!="")
                                        @if($data->discount!=0)
                                        @php $gaurav_discount=1;@endphp 
                                        <tr class="damage cont">
                                            <td class="desc">
                                                <p><b>Discount ({{ $data->discount_coupon }})</b></p>
                                            </td>
                                            <td class="amt">
                                                <p>- {!! $setting_data['payment_currency']  !!}{{number_format($data->discount,2) }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endif
                                        @if($data->extra_discount)
                                        @if($data->extra_discount!="")
                                        @if($data->extra_discount>0)
                                        @php $gaurav_discount=1;@endphp 
                                        <tr class="sub-total tl">
                                            <td class="sub left">
                                                <p>Extra Discount</p>
                                            </td>
                                            <td class="sub right">
                                                <p>- {!! $setting_data['payment_currency']  !!}{{number_format($data->extra_discount,2) }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endif
                                        @if($gaurav_discount==1)
                                        <tr class="sub-total tl">
                                            <td class="sub left">
                                                <p>Total Amount after Discount: </p>
                                            </td>
                                            <td class="sub right">
                                                <p>{!! $setting_data['payment_currency']  !!}{{number_format($data->after_discount_total,2) }}</p>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($data->amount_data)
                                        @php
                                        $amount_data=json_decode($data->amount_data,true);
                                        @endphp
                                        @if(is_array($amount_data))
                                        @foreach($amount_data as $c)
                                        @php $status='';@endphp
                                        @if(isset($c['status']))
                                        @php $status='(<span style="color:green;">Paid</span>)'; @endphp
                                        @endif
                                        <tr  class="sub-total tl">
                                            <td  class="sub left"><strong>{{$c['message']}} {!! $status !!}:</strong></td>
                                            <td  class="sub right">{!! $setting_data['payment_currency'] !!}{{number_format($c['amount'],2) }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="terms"  style="display:none;">
                    <p>By signing below, you agree to the terms and conditions of this agreement as set forth on the face page and any other attached documents. You acknowledge that you had an
                        opportunity to read the entire agreement before signing; authorize us to process a separate credit/debit card voucher in your name for all charges, including but not limited to tolls
                        and violations; and authorize us to release your billing/rental information to third parties for billing/processing purposes. All charges are subject to final audit.
                    </p>
                </div>
                  <table class="owner-profile">
                    <tr>
                        <td>
                            <div class="sign">
                                <p><b>Renter's Signature</b></p>
                                <img src="{{ asset($data->rental_aggrement_signature) }}" alt="Sign" style="width:100px;">
                            </div>
                        </td>
                        <td>
                            <div class="sign">
                                <p><b>Renter's Proof</b></p>
                                <img src="{{ asset($data->rental_aggrement_images) }}" alt="Proof"  style="width:100px;">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="page-break"></div>
            <div class="trial">
                <table class="head">
                    <tr>
                        <th class="logo">
                            <a href="https://www.rv66rental.com"><img src="{{ asset('front/pdf') }}/images/logo.png" alt="Logo"></a>
                        </th>
                        <th class="owner-detail">
                            <h1>Audit Trail</h1>
                        </th>
                    </tr>
                </table>
                <table class="owner-profile">
                    <tr>
                        <th><b>Title</b></th>
                        <td>Contract Agreement</td>
                    </tr>
                    <tr>
                        <th><b>Rental Agreement </b></th>
                        <td><a href="{{ asset($property->rental_aggrement_attachment)}}" target="_BLANK">{{ str_replace("uploads/properties/","",$property->rental_aggrement_attachment) ?? ''}}</a></td>
                    </tr>
                    <tr>
                        <th><b>File Name</b></th>
                        <td>{{$pdf_name}}</td>
                    </tr>
                    <tr>
                        <th><b>Document ID</b></th>
                        <td>67c3e33ea833ae6e44c6025f0f7110be68f36ec5</td>
                    </tr>
                    <tr  style="display:none;">
                        <th><b>Audit Trail Date Format</b></th>
                        <td>MM / DD / YYYY</td>
                    </tr>
                    <tr>
                        <th><b>Status</b></th>
                        <td><img src="{{ asset('front/pdf') }}/images/circle.png" alt="Circle">Signed</td>
                    </tr>
                </table>
                <div class="signed">
                    <p><b>This document was signed on {{url('/')}}</b></p>
                </div>
                <div class="history">
                    <h2>Document History</h2>
                    <table class="document-history">
                        <tr class="sent">
                            <td class="img">
                                <img src="{{ asset('front/pdf') }}/images/log-out.png" alt="Sent">
                                <p><b>SENT</b></p>
                            </td>
                            <td class="date">
                                <p><b>{{$data->sent_date}}</b></p>
                            </td>
                            <td class="cont">
                                <p>Sent for signature to {{$data->name}} ({{$data->email}})</p>
                                <p>from <a href="mailto:{!! $setting_data['email']  !!}" target="_blank"></a>{!! $setting_data['email']  !!}</p>
                                <p>IP: {{$data->sent_ip}}</p>
                            </td>
                        </tr>
                        <tr class="sign">
                            <td class="img">
                                <img src="{{ asset('front/pdf') }}/images/contract.png" alt="Signed">
                                <p><b>SIGNED</b></p>
                            </td>
                            <td class="date">
                                <p><b>{{$data->rental_agreement_date}}</b></p>
                            </td>
                            <td class="cont">
                                <p>Signed by {{$data->name}} ({{$data->email}})</p>
                                <p>IP: {{$data->rental_agreement_ip}}</p>
                            </td>
                        </tr>
                        <tr class="complete">
                            <td class="img">
                                <img src="{{ asset('front/pdf') }}/images/checked.png" alt="Completed">
                                <p><b>COMPLETED</b></p>
                            </td>
                            <td class="date">
                                <p><b>{{$data->rental_agreement_date}}</b></p>
                            </td>
                            <td class="cont">
                                <p>The document has been completed.</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="foot">
                    <p>Powered by <b>RV66 Rental</b></p>
                </div>
            </div>
        </div>
    </body>
</html>