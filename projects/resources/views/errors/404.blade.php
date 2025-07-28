@extends("front.layouts.master")
@section("title","404 - Page not found")
@section("keywords","404 - Page not found")
@section("description","404 - Page not found")
@section("container")

    @php
        $name='404 - Page Not Found';
        $bannerImage=asset('front/images/internal-banner.webp');
          $payment_currency= $setting_data['payment_currency'];
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
      <section class="about_wrapper error">
         <div class="container">
            <div class="row m-0">
                    <h1>404</h1>
                    <h2>Oops.. Page Not Found</h2>
                    <p>You can search for the page you want here or return to the homepage.</p>
                    <a href="{{ url('/') }}" class="main-btn">Go Home</a>

              
            </div>
         </div>
      </section>


@stop