@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("container")
    @php
        $name=$data->name;
        $bannerImage=asset('front/images/breadcrumb.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
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
	<!-- start about section -->
   @php
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
        $adults=$main_data["adults"];
        $child=$main_data["child"];
        $total_guests=$adults+$child;
        $gross_amount=$main_data['gross_amount'];
        $day=$main_data['total_night'];
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;
        $before_total_fees=[];
        $after_total_fees=[];
        
        
        
        $total_guests=$main_data["adults"]+$main_data["childs"];
        $total_pets=$main_data['pet_fee_data_guarav'];
        
        $pet_fee=0;
        $guest_fee=0;
        $rest_guests=0;
        $single_guest_fee=0;
        $tax=0;
        $define_tax=$property->tax;
    @endphp
  <section class="get-quote-sec" id="main-section-change-data">
          <div class="container">
           <div class="row">
              <div class="col-md-12 text-center">
                  <a href="{{ url('properties/detail/'.$property->seo_url) }}" class="img-anc">
                        <div class="image-sec">
                            <img src="{{asset($property->feature_image)}}" class="img-fluid" style="height:200px;" alt="">
                        </div>
     
                   </a> 
                  <h2>{{$property->name ?? ''}} : Booking Quote</h2>
                   
              </div>
            </div>
            <div class="table-box">
            <table class="table table-bordered">
            <tr>
              <th>Check IN</th>
              <th>Check Out</th>
              <th class="d-none">Total Guests</th>
              <th>Total Nights</th>
              <th>Gross Amount</th>
           </tr>
            <tr>
              <td>{{date('F jS, Y',strtotime($start_date))}}</td>
              <td>{{date('F jS, Y',strtotime($end_date))}}</td>
              <td class="d-none">{{$total_guests}} Guests   ({{ $adults }} Adults , {{ $child }} Child)</td>
              <td>{{$day}}</td>
              <td  align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($gross_amount,2)}}</td>
           </tr>
           
          @if($property->guest_fee)
                @if($property->guest_fee>0)
                    @if($property->no_of_guest)
                        @if($property->no_of_guest<$total_guests)
                        
                            @php $single_guest_fee=$property->guest_fee; @endphp
                            @php $rest_guests=$total_guests-$property->no_of_guest; @endphp
                            @php $guest_fee=$single_guest_fee*$day*$rest_guests;   @endphp
                            @php $sub_total+=$guest_fee;$total_amount+=$guest_fee; @endphp
            
                    
                                <tr>
                                  <td colspan="3"  align="left">Additional Guest Fee <br> <span style="font-size:13px;">({{$day}} nights * {!! $setting_data['payment_currency'] !!}{{$single_guest_fee}} * {{$rest_guests}} Guests)</span></td>
                                  <td align="right"> {!! $setting_data['payment_currency'] !!} {{number_format($guest_fee,2)}}</td>
                               </tr>
                        @endif
                    @endif
                @endif
            @endif

            @if($property->pet_fee)
                @if($property->pet_fee>0)
                    @if($total_pets>0)
                        @php 
                            if($property->pet_fee_interval=="per_pet")
                            {
                                $pet_fee=$property->pet_fee*$total_pets;
                            }else{
                                $pet_fee=$property->pet_fee;
                            }
                             
                            $sub_total+=$pet_fee;$total_amount+=$pet_fee; 
                        @endphp
                     
                            
                            <tr>
                                <td colspan="3"  align="left"> Pet Fee</td>
                                <td align="right"> {!! $setting_data['payment_currency'] !!} {{number_format($pet_fee,2)}}</td>
                            </tr>
                    @endif
                @endif
            @endif 
           
           @foreach(App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get() as $c)
                @php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); @endphp
                @if($fee['status']==true)
                    <tr>
                      <td colspan="3"  align="left">{{ $fee['name'] }}</td>
                      <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($fee['amount'],2)}}</td>
                   </tr>
                    @php 

                        $sub_total+=$fee['amount'];$total_amount+=$fee['amount']; 
                        $before_total_fees[]=[
                            "name"=>$fee['name'],
                            "amount"=>$fee['amount'],
                            "fee_name"=>$c->fee_name,
                            "fee_rate"=>$c->fee_rate,
                            "fee_type"=>$c->fee_type,
                            "fee_apply"=>$c->fee_apply,
                            "fee_status"=>$c->fee_status
                        ];
                    @endphp
                @endif
           @endforeach
       </table>
               <form  id="web-form-data">
                  <table class="table table-bordered">
                  @php $ids=[];
                    if((Request::get("mileage_rate_id"))){

                        if(isset(Request::get("mileage_rate_id")['id'])){
                            $ids=Request::get("mileage_rate_id")['id'];
                        }

                    }
                    $fields=[];
                    if((Request::get("mileage_rate_id"))){

                        if(isset(Request::get("mileage_rate_id")['field'])){
                            $fields=Request::get("mileage_rate_id")['field'];
                        }

                    }
                 //dd($fields,Request::get("mileage_rate_id")); 
                 @endphp
            @php
                $listData=App\Models\PropertyMillageRate::where(["property_id"=>$property->id,"milleage_status"=>"active"])->get();
            @endphp
            @if(count($listData)>0)
                <tr>
                    <th colspan="3">
                        <p><strong>Add additional Mileage.</strong></p>
                    </th>
                    <td align="right"></td>
                </tr>
                 @foreach($listData as $c)
                  @php

                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=0;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->milleage_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
                        $message_data_new=preg_replace("/{DYNAMIC-DATA}/", $c->milleage_free*$day ,$c->milleage_format);
                       if($c->milleage_format=="millage"){
                            $total_free_miles=$c->milleage_free*$day;
                            $total_paid_miles=$value_1;
                            $total_miles=$total_free_miles+$total_paid_miles;
                            if($total_paid_miles>0){
                                $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                            }else{
                                $paid_message='';
                            }
                            $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                            
                        }else{
                             $total_free_hours=$c->milleage_free*$day;
                            $total_paid_hours=$value_1;
                            $total_hours=$total_free_hours+$total_paid_hours;
                            if($total_paid_hours>0){
                                $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                            }else{
                                $paid_message='';
                            }
                            $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                        }
                    @endphp
                 <tr>
                    <th colspan="3">
                        <input type="checkbox" {{ in_array($c->id,$ids)?'checked':'' }} name="mileage_rate_id[id][{{$c->id}}]" value="{{ $c->id }}" class="common-field-show-rate mileage-rate" data-target="mileage_rate_id{{$c->id}}field" >
                        <input type="text" value="{{ $value_1 }}" name="mileage_rate_id[field][{{$c->id}}]" id="mileage_rate_id{{$c->id}}field" class="{{ in_array($c->id,$ids)?'':'d-none' }}  rate-calculateion-data"> {{$c->milleage_name}}   <small>( {{$message_data_new}} )</small>
                    </th>
                    <td align="right">
                         @if(isset($abc_amount))
                            {!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($abc_amount,2)}}
                        @endif
                    </td>
                 </tr>
                 @endforeach
             @endif


            @php
                $listData=App\Models\PropertyExtraOptionRate::where(["property_id"=>$property->id,"option_status"=>"active"])->get();
            @endphp
            @if(count($listData)>0)



                <tr>
                    <th colspan="3">
                        <p><strong>Extra Option</strong><br></p>
                    </th>
                    <td align="right"> </td>
                </tr>
                 @php $ids=[];
                    if((Request::get("option_rate_id"))){
                        if(isset(Request::get("option_rate_id")['id'])){
                            $ids=Request::get("option_rate_id")['id'];
                        }
                    }
                    $fields=[];
                    if((Request::get("option_rate_id"))){
                        if(isset(Request::get("option_rate_id")['field'])){
                            $fields=Request::get("option_rate_id")['field'];
                        }
                    }
                 @endphp

                 @foreach($listData as $c)
                    @php
                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=1;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->option_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
                    @endphp
                    <tr>
                        <th colspan="3">
                            <input type="checkbox" name="option_rate_id[id][{{$c->id}}]" {{ in_array($c->id,$ids)?'checked':'' }} value="{{ $c->id }}" class="common-field-show-rate1 option-rate" data-target="option_rate_id{{$c->id}}field" >
                            <!--{!! Form::selectRange("name",1,5,null,["class"=>"option"]) !!}-->
                            <input type="text" value="{{ $value_1 }}" name="option_rate_id[field][{{$c->id}}]" id="option_rate_id{{$c->id}}field" class="d-none rate-calculateion-data">
                            {{$c->option_name}}
                        </th>
                        <td align="right">
                            @if(isset($abc_amount))
                                {!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($abc_amount,2)}}
                            @endif
                        </td>
                    </tr>
                 @endforeach
             @endif
             
                @php $ids=[];
                    if((Request::get("accessories_rate_id"))){
                        if(isset(Request::get("accessories_rate_id")['id'])){
                            $ids=Request::get("accessories_rate_id")['id'];
                        }
                    }
                    $fields=[];
                    if((Request::get("accessories_rate_id"))){
                        if(isset(Request::get("accessories_rate_id")['field'])){
                            $fields=Request::get("accessories_rate_id")['field'];
                        }
                    }
                 @endphp
            @php
                $listData=App\Models\PropertyAccessoriesRate::where(["property_id"=>$property->id,"accessories_status"=>"active"])->get();
            @endphp
            @if(count($listData)>0)
                <tr>
                    <th colspan="3">
                        <p><strong>Rv Rental Accessories</strong><br> </p>
                    </th>
                    <td align="right"></td>
                </tr>
                 @foreach($listData as $c)
                  @php
                        if(isset($abc_amount)){
                            unset($abc_amount);
                        }
                        $value_1=1;
                        if(isset($fields[$c->id])){
                            $value_1=$fields[$c->id];
                        }
                        if(in_array($c->id,$ids)){
                            $abc_amount=$c->accessories_rate*$value_1;
                            $sub_total+=$abc_amount;$total_amount+=$abc_amount; 
                        }
                        $d_none_class=in_array($c->id,$ids)?'':'d-none';
                        $type="per_person";
                        if($c->accessories_type=="per stay"){
                            $type="per_stay";
                            $d_none_class='d-none';
                        }
                        if($c->accessories_type=="per night"){
                            $type="per_night";
                            $d_none_class='d-none';
                        }
                    @endphp
                 <tr>
                    <th colspan="3">
                        <input type="checkbox" {{ in_array($c->id,$ids)?'checked':'' }} name="accessories_rate_id[id][{{$c->id}}]" value="{{ $c->id }}" class="common-field-show-rate-demo accessories-rate-{{ $type }}" data-target="accessories_rate_id{{$c->id}}field" >
                        <input type="text" value="{{ $value_1 }}" name="accessories_rate_id[field][{{$c->id}}]" id="accessories_rate_id{{$c->id}}field" class="{{ $d_none_class }}  rate-calculateion-data">
                        {{$c->accessories_name}}<sub>{{$c->accessories_helping_text}}</sub>
                    </th>
                    <td align="right">
                        @if(isset($abc_amount))
                            {!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($abc_amount,2)}}
                        @endif
                    </td>
                 </tr>
                 @endforeach
             @endif

          
           @foreach(App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->get() as $c)
                @php  $fee=Helper::getFeeAmountAndName($c,$sub_total); @endphp
                @if($fee['status']==true)
                    <tr >
                      <td colspan="3"  align="left">{{ $fee['name'] }}</td>
                      <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($fee['amount'],2)}}</td>
                   </tr>
                    @php 
                        $total_amount+=$fee['amount'];
                        $after_total_fees[]=[
                            "name"=>$fee['name'],
                            "amount"=>$fee['amount'],
                            "fee_name"=>$c->fee_name,
                            "fee_rate"=>$c->fee_rate,
                            "fee_type"=>$c->fee_type,
                            "fee_apply"=>$c->fee_apply,
                            "fee_status"=>$c->fee_status
                        ];
                     @endphp
                @endif
           @endforeach
             @if($define_tax)
  
            
                @php
                    $tax=round(($total_amount*$define_tax)/100,2);
                    $total_amount+=$tax; 
                @endphp
                    <tr>
                      <td colspan="3"  align="left"> Tax </td>
                      <td align="right">{!! $setting_data['payment_currency'] !!} {{number_format($tax,2)}}</td>
                   </tr>
            @endif
            <tr>
                <td colspan="3"  align="left"><strong>Total</strong></td>
                <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($total_amount,2)}}</td>
           </tr>
            @php
                $apply_button_name="Apply";
                $apply=0;
                $discount=0;
                $error=0;
                if(Request::get("coupon")){
                    
                     $Checkcoupon=App\Models\Coupon::where(["code"=>Request::get("coupon")])->whereDate("start_date","<=",$start_date)->whereDate("end_date",">=",$end_date)->first();
                     if($Checkcoupon->property_id == 'ALL'){
                     $property_id = 'ALL';
                    
                    }else{
                        $property_id = $property->id;
                    }
                    
                    $coupon=App\Models\Coupon::where(["code"=>Request::get("coupon"),"property_id"=>$property_id])->whereDate("start_date","<=",$start_date)->whereDate("end_date",">=",$end_date)->first();
                    if($coupon){
                        if($coupon->type=="excat"){
                            if($gross_amount<$coupon->amount){
                                $error=1;
                            }else{
                                $apply=1;
                                $discount=$coupon->amount;
                                $apply_button_name="Applied";
                            }
                        }else{
                            if($coupon->amount>100){
                             $error=1;
                            }else{
                                $apply=1;
                                $discount=($gross_amount*$coupon->amount)/100;
                                $apply_button_name="Applied";
                            }
                        }
                    }else{
                        $error=1;
                    }
                }
            @endphp
            <tr>
                <td colspan="3"  align="left">
                    <strong><input type="checkbox" {{ $apply==1?'disabled':'' }} name="is_coupon" id="is_coupon" /> Do you have coupon code?</strong>
                </td>
                <td align="right"></td>
           </tr>
            <tr  id="coupon-form" style="display:none;">
                <td colspan="3"  align="left">
                    @if(Request::get("coupon"))
                        <input type="text" style="" value="{{Request::get('coupon')}}">
                    @else
                        <input type="text" name="coupon" style="" value="{{Request::get('coupon')}}"  placeholder="Enter Coupon Code" />
                    @endif
                        <button type="submit" {{ $apply==1?'disabled':'' }} class="btn-success btn-25 {{ $apply==1?'d-none':'' }}" ><span>{{ $apply_button_name }}</span></button>
                    @if($apply==0)
                        @foreach(Request::except(["coupon","mileage_rate_id","option_rate_id","accessories_rate_id"]) as $key=>$c_gaurav)
                            <input type="hidden" name="{{  $key }}" value="{{ $c_gaurav }}" />
                        @endforeach
                    @endif
                    @if($apply==1)
                        @foreach(Request::except(["coupon","mileage_rate_id","option_rate_id","accessories_rate_id"]) as $key=>$c_gaurav)
                            <input type="hidden" name="{{  $key }}" value="{{ $c_gaurav }}" />
                        @endforeach
                        <button type="submit"  class="btn btn-danger" > <i class="fa fa-times"></i> Remove</button>
                        @if($apply==1)
                            <div class="text-success">Coupon code applied successfully</div>
                        @endif
                    @endif
                    @if($error==1)
                        <div class="text-danger">Invalid Coupon</div>
                    @endif
                </td>
                <td align="right">@if($apply==1) {!! ModelHelper::getDataFromSetting('payment_currency') !!} {{number_format($discount,2)}} @endif</td>
           </tr>

           </form>
       </table>
         <table class="table table-bordered">
           @php $remaining_total_amount=$total_amount-$discount; @endphp
            @if($apply==1)
                  <tr>
                        <td colspan="3"  align="left"><strong>Total Amount after Discount</strong></td>
                        <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($remaining_total_amount,2)}}</td>
                   </tr>
            @endif

@php
$days=Helper::calculateDays(date('Y-m-d'),$start_date);


$payment_interval=ModelHelper::getDataFromSetting("payment_interval");
if($payment_interval){
}else{
    $payment_interval=1;
}
$total_payment=$payment_interval;
$amount_data=[];
if($payment_interval==1){
        $first_amount=$remaining_total_amount;

        $first_message="Total Amount to be Paid";
        $total_payment=1;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
}
elseif($payment_interval==2){

     $second_days=ModelHelper::getDataFromSetting('second_min_total_days');

    if($days>=$second_days){

        $second_per=ModelHelper::getDataFromSetting('second_payment_per');

        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount;

        $second_days=ModelHelper::getDataFromSetting('second_how_many_days');
        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));


        $first_message="Initial Deposit to be Paid";
        $second_message="Final Remaining Amount Due on ".$second_date;
   
        $total_payment=2;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 

    }else{
        $first_amount=$remaining_total_amount;

        $first_message="Total Amount to be Paid";
        $total_payment=1;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
    } 
}
elseif($payment_interval==3){
    $second_days=ModelHelper::getDataFromSetting('second_min_total_days');
    $third_days=ModelHelper::getDataFromSetting('third_min_total_days');

    if($days>=$third_days){

        $second_per=ModelHelper::getDataFromSetting('second_third_payment_per');
        $third_per=ModelHelper::getDataFromSetting('third_payment_per');


        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $third_amount=round(($remaining_total_amount*$third_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount-$third_amount;


        $second_days=ModelHelper::getDataFromSetting('second_third_how_many_days');
        $third_days=ModelHelper::getDataFromSetting('third_how_many_days');

        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));
        $third_date=date('F jS, Y',strtotime('- '.$third_days.' days',strtotime($start_date)));
        $total_payment=3;
        $first_message="Initial Deposit to be Paid";
        $second_message="Second Remaining Amount Due on ".$second_date;
        $third_message="Final Remaining Amount Due on ".$third_date;

        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 
        $amount_data[]=["amount"=>$third_amount,"type"=>"third","message"=>$third_message]; 

    }elseif($days>=$second_days){

        $second_per=ModelHelper::getDataFromSetting('second_payment_per');

        $second_amount=round(($remaining_total_amount*$second_per)/100,2);
        $first_amount=$remaining_total_amount-$second_amount;

        $second_days=ModelHelper::getDataFromSetting('second_how_many_days');
        $second_date=date('F jS, Y',strtotime('- '.$second_days.' days',strtotime($start_date)));


        $first_message="Initial Deposit to be Paid";
        $second_message="Final Remaining Amount Due on ".$second_date;
   
        $total_payment=2;
        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
        $amount_data[]=["amount"=>$second_amount,"type"=>"second","message"=>$second_message]; 

    }else{
        $first_amount=$remaining_total_amount;
        $total_payment=1;
        $first_message="Total Amount to be Paid";

        $amount_data[]=["amount"=>$first_amount,"type"=>"first","message"=>$first_message];
    }   
}
@endphp
        @foreach($amount_data as $c)
            <tr>
                <td colspan="3"  align="left"><strong>{{$c['message']}}</strong></td>
                <td align="right">{!! ModelHelper::getDataFromSetting('payment_currency') !!}{{number_format($c['amount'],2)}}</td>
            </tr>
        @endforeach

       </table>
            </div>
            
          

       {!! Form::open(["url"=>"save-booking-data","class"=>"","id"=>"save-booking-data"]) !!}
             @php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('accessories_rate_id')){
            if(isset(Request::get('accessories_rate_id')['id'])){
                $ids=array_keys(Request::get('accessories_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyAccessoriesRate::where("id",$id_one)->first();
            if($pay_assco){
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "accessories_name"=>$pay_assco->accessories_name,
                    "accessories_helping_text"=>$pay_assco->accessories_helping_text,
                    "accessories_rate"=>$pay_assco->accessories_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('accessories_rate_id')['field'][$id_one]

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       @endphp
       <input type="hidden" name="accessories_rate_ids" value="{{ json_encode($ar_new_data_web) }}">
              @php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('mileage_rate_id')){
            if(isset(Request::get('mileage_rate_id')['id'])){
                $ids=array_keys(Request::get('mileage_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyMillageRate::where("id",$id_one)->first();
            if($pay_assco){
                 if($pay_assco->milleage_format=="millage"){
                    $total_free_miles=$pay_assco->milleage_free*$day;
                    $total_paid_miles=0;
                    $total_miles=$total_free_miles+$total_paid_miles;
                    if($total_paid_miles>0){
                        $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                    
                }else{
                     $total_free_hours=$pay_assco->milleage_free*$day;
                    $total_paid_hours=0;
                    $total_hours=$total_free_hours+$total_paid_hours;
                    if($total_paid_hours>0){
                        $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                }
            
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "milleage_name"=>$pay_assco->milleage_name,
              
                    "milleage_rate"=>$pay_assco->milleage_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('mileage_rate_id')['field'][$id_one],
                     "message"=>$message_data_new

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
        if(count($ids)<=0){
        //$property->id
            foreach(App\Models\PropertyMillageRate::where("property_id",$property->id)->get() as $pay_assco){
                if($pay_assco->milleage_format=="millage"){
                    $total_free_miles=$pay_assco->milleage_free*$day;
                    $total_paid_miles=0;
                    $total_miles=$total_free_miles+$total_paid_miles;
                    if($total_paid_miles>0){
                        $paid_message='+ '.$total_paid_miles.' additional miles purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total miles : '.$total_miles.' (Includes '.$total_free_miles.' free miles '.$paid_message.')';
                    
                }else{
                     $total_free_hours=$pay_assco->milleage_free*$day;
                    $total_paid_hours=0;
                    $total_hours=$total_free_hours+$total_paid_hours;
                    if($total_paid_hours>0){
                        $paid_message='+ '.$total_paid_hours.' additional hours purchased';
                    }else{
                        $paid_message='';
                    }
                    $message_data_new= 'Total generator hours : '.$total_hours.' (Includes '.$total_free_hours.' free hours  '.$paid_message.')';
                }
            
                 
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "milleage_name"=>$pay_assco->milleage_name,
              
                    "milleage_rate"=>$pay_assco->milleage_rate,
                    'id'=>$pay_assco->id,
                    "value"=>0,
                     "message"=>$message_data_new

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       @endphp
       <input type="hidden" name="mileage_rate_ids" value="{{ json_encode($ar_new_data_web) }}">
              @php
        $ar_new_data_web=[];
        $ids=[];
        if(Request::get('option_rate_id')){
            if(isset(Request::get('option_rate_id')['id'])){
                $ids=array_keys(Request::get('option_rate_id')['id']);
            }
        }
        foreach($ids as $id_one){
            $pay_assco=App\Models\PropertyExtraOptionRate::where("id",$id_one)->first();
            if($pay_assco){
                $ar_new_web=[
                    "property_id"=>$pay_assco->property_id,
                    "option_name"=>$pay_assco->option_name,
              
                    "option_rate"=>$pay_assco->option_rate,
                    'id'=>$id_one,
                    "value"=>Request::get('option_rate_id')['field'][$id_one]

                ];
                $ar_new_data_web[]=$ar_new_web;
            }
        }
       @endphp
       <input type="hidden" name="option_rate_ids" value="{{ json_encode($ar_new_data_web) }}">
       
      <input type="hidden" name="discount" value="{{ $discount }}" />
      <input type="hidden" name="discount_coupon" value="{{ Request::get('coupon') }}" />
      <input type="hidden" name="after_discount_total" value="{{ $remaining_total_amount }}" />
      
  
        
        <input type="hidden" name="total_pets" value="{{ $total_pets }}">
        
        <input type="hidden" name="pet_fee" value="{{ $pet_fee }}">
        
        <input type="hidden" name="guest_fee" value="{{ $guest_fee }}">
        
        <input type="hidden" name="rest_guests" value="{{ $rest_guests }}">
        
        <input type="hidden" name="single_guest_fee" value="{{ $single_guest_fee }}">
        
        
        <input type="hidden" name="total_payment" value="{{ $total_payment }}">
        <input type="hidden" name="amount_data" value="{{ json_encode($amount_data) }}">
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        <input type="hidden" name="checkin" value="{{ $start_date }}" >
        <input type="hidden" name="checkout" value="{{ $end_date }}" >
        <input type="hidden" name="total_guests" value="{{ $total_guests }}" >
        <input type="hidden" name="adults" value="{{ $adults }}" >
        <input type="hidden" name="child" value="{{ $child }}" >
        <input type="hidden" name="gross_amount" value="{{ $gross_amount }}" >
        <input type="hidden" name="total_night" value="{{ $day }}" >
        <input type="hidden" name="sub_amount" value="{{ $sub_total }}" >
        <input type="hidden" name="total_amount" value="{{ $total_amount }}" >
        <input type="hidden" name="after_total_fees" value="{{ json_encode($after_total_fees) }}">
        <input type="hidden" name="before_total_fees" value="{{ json_encode($before_total_fees) }}">
        <input type="hidden" name="request_id" value="{{ uniqid() }}" >
        <input type="hidden" name="tax" value="{{ $tax }}" >

        <input type="hidden" name="define_tax" value="{{ $define_tax }}" >
        <div class="row">
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
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("name") !!}
                            {!! Form::text("name",null,["class"=>"form-control","required","placeholder"=>"Enter Name"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("email") !!}
                            {!! Form::email("email",null,["class"=>"form-control","required","placeholder"=>"Enter email"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("mobile") !!}
                            {!! Form::text("mobile",null,["class"=>"form-control","placeholder"=>"Enter mobile"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("where they are going as destination") !!}
                            {!! Form::textarea("where_they_are",null,["class"=>"form-control","placeholder"=>"Enter where they are going as destination","rows"=>"2"])!!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label("message") !!}
                            {!! Form::textarea("message",null,["class"=>"form-control","placeholder"=>"Enter message","rows"=>"2"])!!}
                        </div>
                    </div>
                    
                    
                </div>
                <div class="row text-center mt-4 bttn">
                    {{--<div class="d-none">
                        <div class="form-group">
                            <button type="submit" class=" btn-success btn-25" name="operation" value="send-quote"><span>Submit Request</span></button>
                        </div>
                    </div>--}}
                    @if($property->instant_booking_button=="true")
                    <div class="">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class=" btn-success btn-25 pay" name="operation" value="direct-booking"><span>Pay Now</span></button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
       {!! Form::close() !!}
       </div>
   </section>
@stop

@section("js")
<script>
    $(document).on("change","#is_coupon",function(){
        if($(this).prop("checked")==true){
            $("#coupon-form").show();
        }else{
            $("#coupon-form").hide();
        }
    });
    $(function(){
        @if(Request::get("coupon"))
            $("#is_coupon").prop("checked","true");
            $("#coupon-form").show();
        @endif
    });


    $(document).on("change",".common-field-show-rate",function(){
        var target=$(this).data("target");
        if($(this).prop("checked")==false)
        $("#"+target).val(0);
        $("#"+target).toggleClass("d-none");
        ajaFunction();
    });
    $(document).on("change",".common-field-show-rate1",function(){
        var target=$(this).data("target");
       // $("#"+target).toggleClass("d-none");
        ajaFunction();
    });




    $(document).on("change",".accessories-rate-per_night",function(){
        var target=$(this).data("target");
        $("#"+target).val("{{ $main_data['total_night'] }}");
        ajaFunction();
    });

    $(document).on("change",".accessories-rate-per_stay",function(){
        var target=$(this).data("target");
        $("#"+target).val(0);
        ajaFunction();
    });

    $(document).on("change",".accessories-rate-per_person",function(){
        var target=$(this).data("target");
        $("#"+target).toggleClass("d-none");
        ajaFunction();
    });
    
    
    
    
</script>

<script>
$(document).on("blur",".rate-calculateion-data",function(){
    ajaFunction();
});

function ajaFunction(){
    @if(Request::get("coupon"))
    url="{{ url('get-quote-post') }}?coupon={{ Request::get('coupon') }}";
    @else
    url="{{ url('get-quote-post') }}";
    @endif
    data=$("#web-form-data").serialize();

    $.post(url,data,function(data){
        $("#main-section-change-data").html(data);
        @if(Request::get("coupon"))
            $("#is_coupon").prop("checked","true");
            $("#coupon-form").show();
        @endif
    });
}
</script>
@stop