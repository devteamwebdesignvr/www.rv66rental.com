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
<style>
    .readMore a{
        color:white;
    }
</style>
<!-- Banner slider -->


<section class="banner-wrapper p-0">
    <div class="video-sec">
        <video src="{{ asset('front')}}/images/Renata.mp4" loop="" muted="" autoplay="" id="mob" class="mob__video" playsinline=""></video>
        <button onclick="playVideo()" id="play">
       <i class="fa-solid fa-play"></i>
    </button>
    <button onclick="pauseVideo()" id="pause">
       <i class="fa-solid fa-pause"></i>
    </button>
       
        <div class="overla">
            <div class="container">
            <div class="hero-content">
            
                <h1>Explor your Dream Place <br> With RV66 Rentals</h1>
              
                <div class="subtitle-wrapper about">
 
  <div class="dash1">
  </div>
</div>
<!--<a href="#" class="btn-22"><span>More Info</span></a>-->
<!--<div class="dash-main"></div>-->


            </div>
            </div>
        </div>
    </div>
    
</section>

<!-- banner slider end -->

    <div class="container booking-area home">
    @if(App\Models\Property::where(["status"=>"true"])->count()==1)
	<form action="{{ url('get-quote') }}" method="get">
	    	<input type="hidden" name="property_id" value="{{ App\Models\Property::where(['status'=>'true'])->first()->id ?? 0 }}">
	@else
	<form action="{{ url('properties') }}" method="get">
	@endif
    
		<div class="row">
            <div class="over">
			<div class="col-3 md-3 icns mb-lg-0 position-relative">
			    <!--<label>From</label>-->
				{!! Form::text("start_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date","placeholder"=>"From","class"=>"form-control"]) !!}
				<i class="fa-solid fa-calendar-days"></i>
			</div>
			<div class="col-3 md-3 icns mb-lg-0 position-relative">
			    <!--<label>To</label>-->
				{!! Form::text("end_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date","placeholder"=>"To","class"=>"form-control lst" ]) !!}
				<i class="fa-solid fa-calendar-days"></i>
			</div>
			   <div class="col-12 md-12 sm-12 datepicker-common-2 datepicker-main">
                  <input type="text" id="demo17" value="" aria-label="Check-in and check-out dates" aria-describedby="demo17-input-description" readonly />
                </div>
			</div>
			<div class="col-lg md-3 icns mb-lg-0 position-relative "  style="display:none;">
			<!--<label>Type</label>-->
				{!! Form::select("location_id",ModelHelper::getLocationSelectList(),null,["class"=>"","placeholder"=>"Choose Vehicle Type"]) !!}
			</div>
			@if(App\Models\Property::where(["status"=>"true"])->count()==1)
				@php 
        	        $prop=	App\Models\Property::where(["is_home"=>"true","status"=>"true"])->first();
        		@endphp
                <div class="col-lg md-2 icns mb-lg-0 position-relative pets"   style="{{ ModelHelper::showPetFee($prop->pet_fee) }}">
                     {!! Form::selectRange("no_of_pets",1,$prop->max_pet,null,["class"=>"form-control","style"=>"border: 1px solid #cacaca;margin-top: 0px;","id"=>"pet_fee_data_guarav","placeholder"=>"Pets"]) !!}
                     <i class="fa-solid fa-paw"></i>
                </div>
            @endif
			<div class="col-lg md-3 mb-lg-0 loct icns position-relative" style="display:none;">
				 <input type="text" name="Guests" readonly class="form-control gst" value="1 Guests" id="show-target-data" placeholder="Guests">
                    
                    <input type="hidden" value="1" name="adults" id="adults-data" />
                    <input type="hidden" value="0" name="child" id="child-data" />
                    <div class="adult-popup">
	                          <div class="modal-bodyss" id="guestsss">
	                          		<p class="close1" onclick=""><i class="fa fa-times"></i></p>
	                               <div class="ac-box">
	                                  <div class="adult">
	                                     <span id="adults-data-show">1 Adult</span>
	                                     <p>(18+)</p>
	                                  </div>
	                                  <div class="btnssss">
	                                     <div class="button button1 btnnn" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Increment Value">-</div>  
	                                     <div class="button11 button1" onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</div>
	                                  </div>
	                               </div>
	                                <div class="ac-box">
	                                  <div class="adult">
	                                     <span id="child-data-show">Children</span>
	                                     <p>(0-17)</p>
	                                  </div>
	                                  <div class="btnssss btnsss">
	                                     <div class="button button1" onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Increment Value">-</div> 
	                                     <div class="button11 button1" onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</div>
	                                  </div>
	                               </div>
	                               @if(App\Models\Property::where(["status"=>"true"])->count()>1)
	                               <div class="ac-box">
	                                  <div class="adult">
	                                     <span id="child-data-show">Pet</span>
	                                  </div>
	                                  <div class="btnsssss btnsss">
	                                     <input type="radio" id="pet1" name="is_pet" value="Yes">
                                        <label for="pet1">Yes</label>
                                        <input type="radio" id="pet2" name="is_pet" checked value="No">
                                        <label for="pet2">No</label> 
	                                  </div>
	                               </div>
	                               @endif
	                               <button type="button" class="btn main-btn close1" data-dismiss="modal" onclick="">Apply</button>
	                           </div>
	                      </div>
				<i class="fa-solid fa-users "></i>
			</div> 
			<div class="col-3 md-4 md-lg-0 srch-btn">
				<button type="submit" class="btn-25 "><span>Search</span></button>
			</div>
		</div>
	</form>
</div>


<section class="abt-sec">
    <div class="container">
        <div class="row">
        <div class="col-5 left">
            <div class="image-sec">
                <div class="wel-bg"> <img src="https://www.vacarentalhome.com/front/images/accent-bg.jpg" class="img-fluid" alt=""></div>
                <img src="{{ asset($data->image)}}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-7 right">
            <div class="content-sec">
                <div class="head-area">
                    {!! $data->longDescription !!}
                </div>
            </div>
        </div>
        </div>
    </div>
</section>


<section class="review-sec">
    <h4 class="head-title">
     RV's available with   
    </h4>
  <h2 class="head">RV 66 rental</h2>
  <ul>
      @php $i=0; @endphp
      @foreach(App\Models\Location::orderBy("ordering","asc")->get() as $c)
    <li role="button" class="{{ $i==0?'active':'' }}" style="background-image: url({{ asset($c->image) }});">
      <h3><a href="{{url('/properties/location/'.$c->seo_url)}}">{{$c->name}}</a></h3>
      <div class="section-content">
        <div class="inner">
          <div class="bio">
            <h2><a href="{{url('/properties/location/'.$c->seo_url)}}">{{$c->name}}</a></h2>
           
           
          </div>
        </div>
      </div>
    </li>
      @php $i++; @endphp
      @endforeach

</ul>
</section>



@if(App\Models\Property::where(["is_home"=>"true","status"=>"true"])->count()>0)
<section class="properties">
        <div class="overlay">
<h6 class="head-title">RV 66 Rentals</h6>
<h1>Choose from our fleet</h1>

<div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
             @foreach(App\Models\Property::where(["is_home"=>"true","status"=>"true"])->limit(6)->orderBy("id","desc")->get() as $c)
            <div class="col">
              <div class="card">
               <a href="{{url('properties/detail/'.$c->seo_url)}}">
                   <center> 
                        @if($c->feature_image)
                            <img src="{{asset($c->feature_image)}}" class="card-img-top" alt="{{ $c->name }}">
                        @endif
                   </center>
               </a>
                <div class="card-body">
                    <h5 class="card-title"> <a href="{{url('properties/detail/'.$c->seo_url)}}">{{$c->name}}</a></h5>
                    <ul class="hammenities">
                        <li><img src="{{ asset('front/images/camper-van.png')}}" class="img-fluid"> {{ App\Models\Location::find($c->location_id)->name ?? '' }}</li>
                        @if($c->address)
                            <li><i class="bi bi-geo-alt-fill"></i> {{$c->address}}</li>
                        @endif
                        @if($c->sleeps)
                            <li><i class="bi bi-person-fill-add"></i> {{$c->sleeps}} adults</li>
                        @endif
                        @if($c->beds)
                            <li><i class="fa-solid fa-gas-pump"></i> {{ $c->beds }} Seats</li>
                        @endif
                    </ul>
                    <div class="price-area">
                        <a href="{{url('properties/detail/'.$c->seo_url)}}" class="btn-25"><span>Book Now</span></a>
                        <div class="price">
                            <p><span>{!! $setting_data['payment_currency'] !!}{{Helper::getPriceAmountData($c->id)}}</span> / night</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
             @endforeach
          </div>
          <a href="{{url('/properties')}}" class="btn-25" id="more-btn"><span>View More</span></a>
</div>
</div>
    </section>
@endif
<!-- end Book section -->

<section class="gallery">
      <img src="{{ asset('front') }}/images/aucapina.jpg" alt="" class="head-img">
      <h2 class="head">Share Your RV Rental Experience</h2>
      <div class="row">
        <div class="col-lg-12 gallery-cruise">
          <div class="gallery" id="g-cruise">
                  <div class="row cruise" >
                        <div class="col-lg-3 col-md-3 col-12 grid-sizer"></div>
                            @foreach(App\Models\Gallery::orderBy("id","desc")->limit(12)->get() as $c)
                                <div class="col-lg-3 col-md-3 col-12 grid-item">
                                   <div class="img-wrapper">
                                        <img class="inner-img" src="{{ asset($c->image) }}" title="" alt="" style="transition: 0.3s;width: 100%;">
                                    </div>
                               </div>
                            @endforeach
        
                                 
               </div>                        
            </div>
              </div>
              <div class="gradient"></div>
              <a href="{{ url('gallery') }}" id="view-gall" class="btn-25"><span>View more</span></a>
          </div>
          
      

    </section>





<section class="cta">
      <div class="overlay">
      <div class="container-fluid">
        <div class="cta-content">
          <h2>Explore the ultimate freedom of the open road with RV66 Rental. Our vision is to unlock extraordinary adventures for our guests, offering unrivaled opportunities to discover new destinations and create lifelong memories.</h2>
            <hr>
            <h3>Book Today and Save Money</h3>
            <a href="{{url('/properties')}}" class="rental btn-25"> <span>Book your rv rental</span></a>
        </div>
      </div>
      </div>
    </section>


<section class="testimonial-sec" style="display:none;">
    <div class="container">
        <div class="row ">
            <div class="heading_sec">
                <h3 data-aos="fade-up" data-aos-duration="1500" class="heading">See What Our Guests Are Saying</h3>
            </div>
        </div>
        <div class="testimo-right">
            <div class="testimo-centent slick-testimonial">
            	@foreach(App\Models\Testimonial::where("status","true")->orderBy("stay_date","desc")->get() as $c)
                <div class="test-desc">
                    <p data-aos="fade-up" data-aos-duration="1500" class="readMore_review">{{$c->message}}</p>
                    <div class="sc_testimonial_avatar">
                    </div>
                    <h4>{{$c->name}}</h4>
                </div>
                @endforeach
               
            </div>
        </div>
    
     <div class="row icon">
         <a><img src="{{ asset('front')}}/images/airbnb.webp" class="img-fluid" alt="airbnb"></a>
         <a><img src="{{ asset('front')}}/images/vrbo.webp" class="img-fluid" alt="vrbo"></a>
         <a href="http://www.flarbo.com/" target="_blank"><img src="{{ asset('front')}}/images/flarbo.png" class="img-fluid" alt="flarbo"></a>
        </div>
    </div>
</section>

 <section class="testimonial">
      <div class="container">
        <div class="rev-head">
          <h2>Trusted By More Than
            100 Travelers Every Year</h2>
        </div>
        <div class="rev-sec">
          
        <div class="test-sec slick-review">
            @foreach(App\Models\Testimonial::where("status","true")->orderBy("stay_date","desc")->get() as $c)
          <div class="test-cont">
          
            <div class="cont-sec">
              <hr>
              <h3>Client Reviews</h3>
              <div class="para">
                 <p class="clt-name"><strong>{{$c->name}}</strong></p>
                <p><i class="fa-solid fa-quote-left"></i> <span> {{$c->message}}</span> <i class="fa-solid fa-quote-right"></i></p>
              </div>
            </div>
          </div>
            @endforeach
          
        </div>
      </div>
     <!--<div class="btnn"> <a href="#" class="btn-25"><span>View more</span></a></div>-->
      </div>
     </section>

@stop
@section("js")
<script>
    function functiondec($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        if(val>0){
            val=val-1;
        }
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
        $($show).val($show_actual_data);
    }
    function functioninc($getter_setter,$show,$cal){
        val=parseInt($($getter_setter).val());
        
            val=val+1;
      
        $($getter_setter).val(val);
        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;
        $show_actual_data=$show_data+" Guests";
        $($show).val($show_actual_data);
        if($getter_setter=="#adults-data"){
            $($getter_setter+'-show').html(val +" Adults");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Adult"); 
            }
        }else{
             $($getter_setter+'-show').html(val +" Children");
            if(val<=1){
               $($getter_setter+'-show').html(val +" Child"); 
            }
        }
    }
</script>

<script src="{{ asset('datepicker') }}/node_modules/fecha/dist/fecha.min.js"></script>
<script src="{{ asset('datepicker') }}/dist/js/hotel-datepicker.js"></script>
    <script>
@php
    $new_data_blocked=LiveCart::iCalDataCheckInCheckOutCheckinCheckout(0);
    $checkin=json_encode($new_data_blocked['checkin']);
    $checkout=json_encode($new_data_blocked['checkout']);
    $blocked=json_encode($new_data_blocked['blocked']);

@endphp
    
      var checkin = <?php echo $checkin;  ?>;
    var checkout = <?php echo ($checkout);  ?>;
    var blocked= <?php echo ($blocked);  ?>;
    
    
        
    function clearDataForm(){
        $("#start_date").val('');
        $("#end_date").val('');
  
    }
            (function () {
                @if(Request::get("start_date"))
                    @if(Request::get("end_date"))
                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}");     
                    @endif
                @endif
                abc=document.getElementById("demo17");
                var demo17 = new HotelDatepicker(
                    abc,
                    {
                        minNights: 3,
                        @if($checkin)
                        noCheckInDates: checkin,
                        @endif
                        @if($checkout)
                        noCheckOutDates: checkout,
                        @endif
                        @if($blocked)
                         disabledDates: blocked,
                        @endif
                        onDayClick: function() {
                             d = new Date();
                                d.setTime(demo17.start);
                                document.getElementById("start_date").value = getDateData(d);
                                d = new Date();
                                console.log(demo17.end)
                                if(Number.isNaN(demo17.end)){
                                    document.getElementById("end_date").value = '';
                                }else{
                                     d.setTime(demo17.end);
                                    document.getElementById("end_date").value = getDateData(d);
                                   // ajaxCallingData();
                                }
                        },
                        clearButton:function(){
                            return true;
                        }
                    }
                );
                
                        @if(Request::get("start_date"))
                            @if(Request::get("end_date"))
                                setTimeout(function(){
                                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}")
                                        document.getElementById("start_date").value ="{{ request()->start_date }}";
                                        document.getElementById("end_date").value ="{{ request()->end_date }}";
                                     
                                    },1000);
                            
                            @endif
                        @endif
              
            })();

            $(document).on("click","#clear",function(){
                $("#clear-demo17").click();
            })
            x=document.getElementById("month-2-demo17");
            x.querySelector(".datepicker__month-button--next").addEventListener("click", function(){
                y=document.getElementById("month-1-demo17");
                y.querySelector(".datepicker__month-button--next").click();
            })  ;


            x=document.getElementById("month-1-demo17");
            x.querySelector(".datepicker__month-button--prev").addEventListener("click", function(){
                y=document.getElementById("month-2-demo17");
                y.querySelector(".datepicker__month-button--prev").click();
            })  ;



          function getDateData(objectDate){

            let day = objectDate.getDate();
            //console.log(day); // 23

            let month = objectDate.getMonth()+1;
            //console.log(month + 1); // 8

            let year = objectDate.getFullYear();
           // console.log(year); // 2022


            if (day < 10) {
                day = '0' + day;
            }

            if (month < 10) {
                month = `0${month}`;
            }
            format1 = `${year}-${month}-${day}`;
            return  format1 ;
            console.log(format1); // 07/23/2022
          }  
</script>
@stop
@section("css")
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('datepicker') }}/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="{{ asset('front')}}/css/datepicker.css" />
@stop
