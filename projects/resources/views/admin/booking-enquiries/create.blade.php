@extends('admin.layouts')
@section('title', 'Admin')
@php 
    $name="Booking Enquiries";$route="booking-enquiries";
@endphp            
@section('content_header')
    <h1 class="m-0 text-dark">{{$name}} Management</h1>
@stop
@section('content')
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @parent
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          @php 
            $addbar=["name"=>$name,"add-data"=>false,"add-name"=>"Add ". Str::singular($name),"add-anchor"=>route($route.'.create'),"back-anchor"=>route($route.'.index')];
          @endphp
          @include("admin.common.add-bar")
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card  ">
            <div class="card-header">
              <h3 class="card-title">Create {{ Str::singular($name) }}</h3>
               <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               {!! Form::open(['route' => $route.'.store',"files"=>"true","id"=>"web-form-data"]) !!}
     
                    @include("admin.".$route.".form")
               
                    <button class="btn btn-success"><span class="fa fa-save"></span> Save</button>
                
                {!! Form::close() !!}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
@section("js")
@parent
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 <script>
   var checkin = '';
    var checkout = '';
     $(document).on("change","#property-selector",function(){
        data={_token:"{{ csrf_token() }}",id:$(this).val()};
        url="{{ route('get-checkin-checkout-data-gaurav') }}";
        $.post(url,data,function(data){
           console.log(data); 
              checkin = data.checkin;
             checkout = data.checkout;
            
                $("#txtFrom").datepicker({
                    numberOfMonths: 1,
                    minDate: '@minDate',
                    dateFormat: 'yy-mm-dd',
                    beforeShowDay: function(date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [checkin.indexOf(string) == -1];
        
                    },
        
                    onSelect: function(selected) {
                        $("#submit-button-gaurav-data").hide();
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() + 1);
                        $("#txtTo").datepicker("option", "minDate", dt);
                        $("#txtTo").val('');
                    },
                    onClose: function() {
                        $("#txtTo").datepicker("show");
                    }
                });
        
                $("#txtTo").datepicker({
                    numberOfMonths: 1,
                    dateFormat: 'yy-mm-dd', 
                    beforeShowDay: function(date) {
        
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        
                        return [checkout.indexOf(string) == -1]
        
                    },
        
                    onSelect: function(selected) {
                        var dt = new Date(selected);
                        dt.setDate(dt.getDate() - 1);
                        $("#txtFrom").datepicker("option", "maxDate", dt);
                       ajaxCallingData();
        
                    },
                    onClose: function() {
                        $('.popover-1').addClass('opened');
                    }
                });
    
        });
     });
     
     
    function ajaxCallingData(){
        pet_fee_data_guarav=$("#pet_data").val();
        adults=$("#adult_data").val();
        childs=$("#child_data").val();
        if($("#property-selector").val()!=""){
             if($("#txtFrom").val()!=""){
                 if($("#txtTo").val()!=""){
                    if($("#adult_data").val()>0){
                        data=$("#web-form-data").serialize();
                         $.post("{{route('admin-checkajax-get-quote')}}",data,function(data){
                            if(data.status==400){
                                $("#submit-button-gaurav-data").hide();
                                toastr.error(data.message);
                            }else{
                               $("#pricedata-gaurav").html(data.data_view);
                            }
                        });
                    }
                 }
             }  
        }
    }
    $(document).on("change","#adult_data,#child_data,#pet_data",function(){
        ajaxCallingData();
    });
    
  
      $(document).on("keyup","#extra-discount,.product_name,.product_amount",function(){
        ajaxCallingData();
    });

 </script>
 
<script>
    $(document).on("change",".common-field-show-rate",function(){
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
    url="{{route('admin-checkajax-get-quote')}}?coupon={{ Request::get('coupon') }}";
    @else
    url="{{route('admin-checkajax-get-quote')}}";
    @endif
    data=$("#web-form-data").serialize();

    $.post(url,data,function(data){
       // console.log(data)
        $("#pricedata-gaurav").html(data.data_view);
     
    });
}


    $(document).on("click",".delete-space-data",function(){
        $(this).parents(".gaurav-delete-property-space").remove();
    });
    $(document).on("click",".add-space-data",function(){
        html=`
            <div class="row gaurav-delete-property-space">
                
                <div class="col-md-1">
                    <a href="javascript:;" class="delete-space-data btn btn-danger btn-xs" ><i class="fa fa-times"></i> </a>
                </div>
                <div class="col-md-8">
                    {!! Form::text("product_name[]",null,["required","class"=>"form-control product_name","placeholder"=>"Name"]) !!}
                </div>
                
                <div class="col-md-3">
                    {!! Form::text("product_amount[]",null,["class"=>"form-control product_amount","required","placeholder"=>"Amount"]) !!}
                </div>
                
                
                <div class="col-md-12">
                    <br>
                </div>
            </div>
        `;
        $("#space-area-section").append(html);
    });
    
    $(document).on("change","#booking-selector",function(){
        if($("#booking-selector").val()=="invoice"){
            $("#gaurav-data-new-logic").removeClass("d-none");
            $(".custom-amount").removeClass("d-none");
            $(".custom-amount-add").addClass("d-none");
        }else if($("#booking-selector").val()=="custom-quote"){
            $("#gaurav-data-new-logic").removeClass("d-none");
            $("#pricedata-gaurav").html(null);
            $(".custom-amount").addClass("d-none");
            $(".custom-amount-add").removeClass("d-none");
        }else{
            $("#gaurav-data-new-logic").addClass("d-none");
            $("#pricedata-gaurav").html(null);
            $(".custom-amount").addClass("d-none");
            $(".custom-amount-add").addClass("d-none");
        }
    });
</script>
@stop