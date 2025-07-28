@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("css")
<link rel="stylesheet" href="{{ asset('front/css/lightslider.css')}}" />
<style>
    .showReadMores .morecontent span {display: none;}
    .showReadMores .ReadMore {display: visible;}
    .footer-sec{margin-top: 0rem;}
    .ac, .kapat {
            display: inline-block !important;
            background: #79a0fb;
            width: 140px !important;
            padding: 7px 20px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            margin-top: 19px;
        }
        .theme-item-page-desc.more {
            font-size: 17px;
        }
.more + [data-readmore-toggle], .more[data-readmore] {
    display: block;
    width: 100%;
    overflow: hidden;
}
</style>
@stop

@section("container")
@php
$name=$data->name;
$bannerImage=asset('front/images/internal-banner.webp');;
if($data->banner_image){
$bannerImage=asset($data->banner_image);
}
@endphp
      
    <section class="breadcrumb" style="background-image: url({{ $bannerImage }});">
        <div class="auto-container">
            <h2 data-aos="zoom-in" data-aos-duration="1500">{{$name}}</h2>
            <ul class="page-breadcrumb" data-aos="fade-up" data-aos-duration="1500">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>/ {{$name}}</li>
            </ul>
        </div>
    </section>
<!-- end banner sec -->
<!--Property detail section-->
<section class="pro-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="pro-detail-name">
                    <div class="pro-names">
                        <h1>{{$name}}</h1>
                        <p class="mphb-regular-price">
                            <span class="mphb-price">
                            <span class="doller">{!! $setting_data['payment_currency'] !!}</span>{{$data->price}}
                            </span> 
                            <span class="mphb-price-period" title="Choose dates to see relevant prices"> Night</span>
                        </p>
                    </div>
                    <p class="location"><i class="fa-solid fa-location-dot"></i> {{$data->address}}</p>
                    <div class="vacation-content-pro-details">
                         @if($data->sleeps)
                        <p class="adult"><i class="fa-solid fa-users"></i> {{$data->sleeps}} Sleeps</p>
                        @endif
                        @if($data->bedroom)
                        <p class="pool"><i class="fa-solid fa-bed"></i> {{$data->bedroom}} Bedrooms</p>
                        @endif
                        @if($data->bathroom)
                        <p class="bed"><i class="fa-solid fa-bath pe-1"></i> {{$data->bathroom}} Baths</p>
                        @endif
                        @if($data->area)
                        <p class="size"><i class="fa-solid fa-maximize pe-2"></i> Size {{$data->area}} Sqft</p>
                        @endif
                    </div>
                </div>
                <!--GALLERY PART-->
                <div class="pro-gallery">
                    <div class="demo">
                        <ul id="lightSlider">
                            <li data-thumb="{{asset($data->feature_image)}}">
                                <img src="{{asset($data->feature_image)}}" />
                            </li>
                            
                             @foreach(App\Models\PropertyGallery::where("property_id",$data->id)->orderBy("sorting","asc")->get() as $c)
                            
                            <li data-thumb="{{asset($c->image)}}">
                                <img src="{{asset($c->image)}}" />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!--END GALLERY PART-->
                <!--OVERVIEW-->
                <div class="overview">
                    <h5 class="pro-heading">Overview</h5>
               
                     <div class="theme-item-page-desc more">
                                 <p>{!! $data->long_description !!}</p>
                               </div>
                </div>
                <!--END OVERVIEW-->
                <!--<AMENITIES SECTION-->
                <div class="amenities">
                    <h5 class="pro-heading">
                        Details
                    </h5>
                    <ul class="mphb-pro-type-attributes">
                        @if($data->sleeps)
                        <li class="mphb-pro-type-adults-capacity">
                            <span class="mphb-attribute-title mphb-adults-title"><i class="fa-solid fa-users"></i> Sleeps:</span>
                            <span class="mphb-attribute-value"> {{$data->sleeps}} </span>
                        </li>
                        @endif
                        @if($data->property_view)
                        <li class="mphb-pro-type-view">
                            <span class="mphb-attribute-title mphb-view-title"><i class="fa-solid fa-eye"></i> View:</span>
                            <span class="mphb-attribute-value"> {{$data->property_view}} </span>
                        </li>
                        @endif
                        @if($data->area)
                        <li class="mphb-pro-type-size">
                            <span class="mphb-attribute-title mphb-size-title"><i class="fa-solid fa-maximize pe-2"></i> Size:</span>
                            <span class="mphb-attribute-value"> {{$data->area}} Sqft </span>
                        </li>
                        @endif
                        @if($data->bed_type)
                        <li class="mphb-pro-type-bed-type">
                            <span class="mphb-attribute-title mphb-bed-type-title"><i class="fa-solid fa-bed pe-1"></i> Bed Type:</span>
                            <span class="mphb-attribute-value"> {{$data->bed_type}} </span>
                        </li>
                        @endif
                        @if($data->category)
                        <li class="mphb-pro-type-categories">
                            <span class="mphb-attribute-title mphb-categories-title"><i class="fa-solid fa-maximize pe-2"></i> Categories:</span>
                            <span class="mphb-attribute-value"> 
                            <span class="category-double"><a href="#">{{$data->category}}</a></span>
                            </span>
                        </li>
                        @endif
                       
                        <li class="mphb-pro-type-categories">
                            <span class="mphb-attribute-title mphb-categories-title"><i class="fa-solid fa-calendar pe-2"></i> Check In and Out:</span>
                            <span class="mphb-attribute-value"> 
                            <span class="category-double">Check-In: {{$data->checkin}}</span> - <span class="category-double">Check-Out: {{$data->checkout}}</span> 
                            </span>
                        </li>
                 
                    </ul>
                    <h5 class="pro-heading">
                        Amenities
                    </h5>
                    @foreach(App\Models\PropertyAmenityGroup::where("property_id",$data->id)->get() as $c)
                    <div class="mphb-pro-amenities">
                        <p>  <strong>{{ $c->name}}</strong></p>
                    </div>
                    <br>
                    <div class=" row">
                        @foreach(App\Models\PropertyAmenity::where("property_amenity_id",$c->id)->where("status","true")->get() as $c1)
                        <div class="col-md-6" style="border:1px solid #ededed;    margin-bottom: 0px;padding-top: 13px;padding-bottom: 13px;border: 1px solid #ededed;padding-left: 10px;background: #fcfcfc;">
                            @if($c1->image)
                            <img src="{{ asset($c1->image) }}" style="width:30px;" >
                            @endif
                             {{ $c1->name}}
                        </div>
                        @endforeach
                       
                       

                    </div>
                    <br>
                    <hr>
                    <br>

                    @endforeach
                  
                </div>
                <!--END AMENITIES-->
                <!--AVAILABILIT SECTION-->
                <div class="availability">
                    <h5 class="pro-heading">
                        Availability
                    </h5>
                    <div class="availability-cal">
                        <iframe src="{{ url('fullcalendar/'.$data->id) }}"  width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!--END AVAILABILITY-->
                  <div class="container mt-3 mb-4">

                      <div id="accordion">
                        @if($data->cancellation_policy)
                        <div class="card">
                          <div class="card-header">
                            <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo">
                            Cancellation Policy
                          </a>
                          </div>
                          <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                            <div class="card-body">
                              {!! $data->cancellation_policy !!}
                            </div>
                          </div>
                        </div>
                        @endif

                        @if($data->booking_policy)
                        <div class="card">
                          <div class="card-header">
                            <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo1">
                            Booking Policy
                          </a>
                          </div>
                          <div id="collapseTwo1" class="collapse" data-bs-parent="#accordion">
                            <div class="card-body">
                              {!! $data->booking_policy !!}
                            </div>
                          </div>
                        </div>
                        @endif

                        @if($data->notes)
                        <div class="card">
                          <div class="card-header">
                            <a class="collapsed btn" data-bs-toggle="collapse" href="#collapseTwo3">
                            Notes
                          </a>
                          </div>
                          <div id="collapseTwo3" class="collapse" data-bs-parent="#accordion">
                            <div class="card-body">
                              {!! $data->notes !!}
                            </div>
                          </div>
                        </div>
                        @endif

                     
                      </div>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="pro-detail-form">
                    <div class="single-pro-reservation-form-wrapper">
                        <h3>Get Quote</h3>
                        {!! Form::open(["class"=>"mphb-booking-form" ,"id"=>"get-quote-property","url"=>"get-quote","method"=>"get"]) !!}
                            <p class="mphb-check-in-date-wrapper"> 
                                <label > Check-in Date *</label> <br> 
                                {!! Form::text("start_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtFrom"]) !!}
                            </p>
                            <p class="mphb-check-out-date-wrapper"> 
                                <label> Check-out Date * </label> <br> 
                                {!! Form::text("end_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"txtTo"]) !!}
                            <p class="mphb-adults-wrapper mphb-capacity-wrapper">
                                <label> Adults </label> <br> 
                                {!! Form::selectRange("adults",1,25,null,["required"]) !!}
                            </p>
                            <p class="mphb-children-wrapper mphb-capacity-wrapper">
                                <label> Children </label> <br> 
                                {!! Form::selectRange("child",0,25,null,["required"]) !!}
                            </p>
                            <input type="hidden" name="property_id" value="{{ $data->id }}">
                            <p class="mphb-reserve-btn-wrapper"> 
                               
                                <input class="mphb-reserve-btn button" style="display:none;" id="submit-button-gaurav-data" type="submit" value="Submit"> 
                            </p>
                        {!! Form::close() !!}
                        <div id="gaurav-new-data-area">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="review-top-heading">
                    <h3>{{App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->count()}} Reviews <span class="heading-star"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span></h3>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Launch demo modal</button> -->
                    <a class="main-btn " data-toggle="modal" data-target="#exampleModalCenter">Write a review</a>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Leave A Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="review_form" id="lightbox">
                                    <div class="inner-container" style="margin-bottom: 0px;">
                                        <!-- Contact Form -->
                                        <div class="contact-form">
                                        
                                            {!! Form::open(["autocomplete"=>"off","route"=>"reviewSubmit"]) !!}
                                                <div class="row clearfix">
                                                    <!-- Form Group -->
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                        <label>Name *</label>
                                                        <input type="text" name="name" placeholder="Name" required="">
                                                    </div>
                                                    <!-- Form Group -->
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                        <label>Email *</label>
                                                        <input type="email" name="email" placeholder="Email *" required="">
                                                    </div>
                                                
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                        <label>Stay Date</label>
                                                        <input type="date"  class="datepicker123" name="stay_date" placeholder="Stay date" >
                                                        <input type="hidden" name="property_id" value="{{ $data->id }}">
                                                   
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                        <label>Rating  *</label>
                                                        <fieldset class="score">
                                                            <input type="radio" id="score-5" name="score" value="5" checked>
                                                            <label title="5 stars" for="score-5" style="font-size: 24px;">5 stars</label>
                                                            <input type="radio" id="score-4" name="score" value="4">
                                                            <label title="4 stars" for="score-4" style="font-size: 24px;">4 stars</label>
                                                            <input type="radio" id="score-3" name="score" value="3">
                                                            <label title="3 stars" for="score-3" style="font-size: 24px;">3 stars</label>
                                                            <input type="radio" id="score-2" name="score" value="2">
                                                            <label title="2 stars" for="score-2" style="font-size: 24px;">2 stars</label>
                                                            <input type="radio" id="score-1" name="score" value="1">
                                                            <label title="1 stars" for="score-1" style="font-size: 24px;">1 stars</label>
                                                        </fieldset>
                                                    </div>
                                                    <!-- Form Group -->
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                        <label>Review *</label>
                                                        <textarea class="" cols="8" name="message" placeholder="Review"></textarea>
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                        <button type="submit" class="main-btn theme-btn btn-style-one" name="reviewsubmit"><span class="txt">Send</span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-rates">
                    <span class="heading-star">
                        <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i> Comfort</p>
                        <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>  Location</p>
                        <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> Service</p>
                        <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> Staff</p>
                    </span>
                </div>
                <div class="reviews review-slider">
                    @foreach(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("id","desc")->get() as $c)
                    <div class="review-boxs">
                        <div class="review-sec " >
                            <p class="para"><i class="fa-solid fa-quote-left"></i> <span><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <span class="readMore"> {{$c->message}}</span></span> </p>
                        </div>
                        <div class="client-sec">
                            @if($c->image)
                            <div class="client-img">
                                <img src="{{asset($c->image)}}" class="img-fluid client-img" alt="" />
                            </div>
                            @endif
                            <div class="client-about">
                                <h6>{{$c->name}} </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Button trigger modal -->
@if($data->map)
<div class="map" id="#map">
    <iframe src="{!! $data->map !!}" width="100%" height="600" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endif




@stop

@section("js")  
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-days-area">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Services</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="gaurav-new-modal-service-area">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>







    <script src="{{ asset('front/js/lightslider.js')}}"></script>
    <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop:true,
            slideMargin: 0,
            thumbItem: 9
        });
    </script>
<script src="https://rawgit.com/jedfoster/Readmore.js/master/readmore.js"></script>
<script>
  $('.more').readmore({
    speed: 75, //Açılma Hızı
    collapsedHeight:312, // 100px sonra yazının kesileceğini belirtir.
    moreLink: '<a class="ac" href="#">Show more</a>', // açma linki yazısı
    lessLink: '<a class="kapat" href="#">Show Less</a>', // kapatma linki yazısı
  });
</script>

<script src="{{ asset('front/js/showmore.js')}}"></script>

<script>
$(function(){
    $(".datepicker").datepicker();
});
</script>

@php
$new_data_blocked=LiveCart::iCalDataCheckInCheckOut($data->id);
    $checkin=$new_data_blocked['checkin'];
    
    $checkout=$new_data_blocked['checkout'];

@endphp
<script type="text/javascript">
    var checkin = <?php echo json_encode($checkin);  ?>;
    var checkout = <?php echo json_encode($checkout);  ?>;
    $(function() {
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
                $.post("{{route('checkajax-get-quote')}}",{start_date:$("#txtFrom").val(),end_date:$("#txtTo").val(),book_sub:true,property_id:{{ $data->id }}},function(data){
                    if(data.status==400){
                        $("#submit-button-gaurav-data").hide();
                        toastr.error(data.message);
                    }else{
                        $("#submit-button-gaurav-data").show();
                        $("#gaurav-new-modal-days-area").html(data.modal_day_view);
                        $("#gaurav-new-modal-service-area").html(data.modal_service_view);
                        $("#gaurav-new-data-area").html(data.data_view);
                    }
                })

            },
            onClose: function() {
                $('.popover-1').addClass('opened');
            }
        });
    });
</script>
@stop