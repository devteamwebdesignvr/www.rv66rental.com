    @php
        $start_date=$main_data["start_date"];
        $end_date=$main_data["end_date"];
  


        $gross_amount=$main_data['gross_amount'];
        $day=$main_data['total_night'];
        $sub_total=$gross_amount;
        $total_amount=$gross_amount;

        $before_total_fees=[];
        $after_total_fees=[];
    @endphp
@foreach(App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","gross")->get() as $c)
    @php  $fee=Helper::getFeeAmountAndName($c,$gross_amount); @endphp
    @if($fee['status']==true)
       

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

@php $service_fee=0; @endphp
@foreach(App\Models\PropertyFee::where("property_id",$property->id)->where("fee_apply","total")->get() as $c)
    @php  $fee=Helper::getFeeAmountAndName($c,$sub_total); @endphp
    @if($fee['status']==true)
      <div class="row">
		    <div class="col-md-9">
		        {{ $fee['name'] }}
		    </div>
		    <div class="col-md-3">
		       {!! $setting_data['payment_currency'] !!} {{number_format($fee['amount'],2)}}
		    </div>
		</div>
       
        @php $total_amount+=$fee['amount']; $service_fee+=$fee['amount'];
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
