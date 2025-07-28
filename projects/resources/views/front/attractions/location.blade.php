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
   @php
  $list=App\Models\Attraction::where("location_id",$data->id)->orderBy("id","desc")->paginate(10);
  @endphp  
    <!-- end banner sec -->

   
<section class="summary-section">
        <div class="container"> 
           @php $i=0; @endphp
              @foreach($list as $c)
              @if($i%2==0)
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="{{asset($c->image)}}" alt="{{$c->name}}"  class="attachment-full size-full aos-init aos-animate" loading="lazy" data-aos="fade-right" data-aos-duration="1500">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content">
                        <h3 data-aos="fade-left" data-aos-duration="1500"><a href="{{ url('attractions/detail/'.$c->seo_url) }}">{{$c->name}}</a></h3>
                        <div class="line"></div>
                        <p style="text-align: justify;" data-aos="fade-up" data-aos-duration="1500">{{$c->description}}</p>
                    </div>
                </div>
                <div class="dot">
                  <img src="{{ asset('front')}}/img/dot-shape.png">
                </div>
            </div>
            @else
            <div class="row position-relative" id="a1">
                <div class="col-lg-7 order-lg-2 col-md-12 col-sm-12 position-relative">
                    <div class="inner-column" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <img src="{{asset($c->image)}}" alt="{{$c->name}}"  class="attachment-full size-full aos-init aos-animate" loading="lazy" data-aos="fade-right" data-aos-duration="1500">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-1 col-md-12 col-sm-12 position-relative right-contentss">
                    <div class="inner-column-content">
                        <h3 data-aos="fade-left" data-aos-duration="1500"><a href="{{ url('attractions/detail/'.$c->seo_url) }}">{{$c->name}}</a></h3>
                        <div class="line"></div>
                        <p style="text-align: justify;" data-aos="fade-up" data-aos-duration="1500">{{$c->description}}</p>
                    </div>
                </div>
                <div class="dot">
                  <img src="{{ asset('front')}}/img/dot-shape.png">
                </div>
            </div>


               @endif
            @php $i++; @endphp
            @endforeach
            <div class="row align-items-center">
               {{ $list->links()}}
            </div>
        </div>
    </section>
@stop