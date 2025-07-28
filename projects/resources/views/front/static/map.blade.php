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
        $bannerImage=asset('front/images/internal-banner.webp');
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
	<!-- end banner sec -->



<section class="rent rentals-req">
    <div class="container">
        <h2>Rentals Requirements</h2>
        <!--<div class="row">-->
           
            
        <!--    <div class="col-2">-->
        <!--        <a href="#in">-->
        <!--            <div class="icon-area">-->
                        
        <!--                <img src="{{ asset('front/images/ins-blue.png')}}" class="img-fluid blue" alt="">-->
        <!--                <img src="{{ asset('front/images/ins-white.png')}}" class="img-fluid white" alt="">-->
        <!--            </div>-->
        <!--            <h3>Insurance</h3>-->
        <!--        </a>-->
        <!--    </div>-->
            
            
            
           
            
        <!--    <div class="col-2">-->
        <!--        <a href="#can">-->
        <!--            <div class="icon-area">-->
                        
        <!--                <img src="{{ asset('front/images/policy-blue.png')}}" class="img-fluid blue" alt="">-->
        <!--                <img src="{{ asset('front/images/policy-white.png')}}" class="img-fluid white" alt="">-->
        <!--            </div>-->
        <!--            <h3>Cancellation Policy</h3>-->
        <!--        </a>-->
        <!--    </div>-->
            
            
        <!--</div>-->
    </div>
</section>

    <section class="rentals">
         <div class="container">
            <div class="row">
                
                
                    {!! $data->mediumDescription !!}
                 </div>
         </div>
      </section>


@stop

@section("js")
<script>
$(document).on("click",".loc-img",function(){
    $(".map-view-gaurav").hide();
    $($(this).data("id")).show();
})
</script>

@stop