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

      

   <div class="reviews_sc">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="left-r">
                      @foreach(App\Models\Testimonial::where("status","true")->orderBy("id","desc")->get() as $c)

                     <div class="review-r-box">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="review-r-img">
                                 @if($c->image)
                                 <img src="{{asset($c->image)}}" alt="" class="img-fluid">
                                 @endif
                                 <div class="about-client">
                                    <h4>{{$c->name}}</h4>
                                    <span>{{date('d F,Y',strtotime($c->created_at))}}</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-9">
                              <div class="review-r-des">
                                 <h2>{{App\Models\Property::find($c->property_id)->name ?? '' }}</h2>
                                 <p>"{{$c->message}}"</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
             
            </div>
         </div>
      </div>

       <!--Footer section-->

@stop