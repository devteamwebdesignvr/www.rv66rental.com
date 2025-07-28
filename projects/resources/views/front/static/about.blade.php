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
        $bannerImage=asset('front/images/b1.jpg');
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

      <!-- About Section -->
 

<section class="abt-sec about">
    <div class="container">
        <div class="row">
        <div class="col-5 left">
            <div class="image-sec">
                <div class="wel-bg"> <img src="https://www.vacarentalhome.com/front/images/accent-bg.jpg" class="img-fluid" alt=""></div>
                <img src="{{asset($data->image)}}" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-7 right">
            <div class="content-sec">
                <div class="head-area">
                    <em class="widget-num">{{$data->name}}</em>
                  
                        {!! $data->mediumDescription !!}
                   {!! $data->longDescription !!}
                    <!--<div class="bttn">-->
                    <!--        <a href="#" class="list">Learn More</a>-->
                    <!--    </div>-->
                </div>
            </div>
        </div>
        </div>
    </div>
</section>


@stop