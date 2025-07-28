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

    <section class="c-gallery mt-4">

        <div class="container">

            <div class="row main-slider">
@foreach(App\Models\Gallery::orderBy("id","desc")->get() as $c)
                <div class="col-md-3 ">

                    <div class="gallery-box">

                        <a href="{{asset($c->image)}}" data-fancybox="gallery">

                            <img src="{{asset($c->image)}}" alt=" gallery" width="100%">

                         </a>

                    </div>

                </div>
@endforeach
                

            </div>

        </div>

    </section>


@stop

@section("js")

@stop