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

	<!-- start about section -->
     
   <section class="about-sec faq">
       <div class="container">
          
           <h2 class="head">FREQUENTLY ASKED QUESTIONS</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    @php $i=1; @endphp
                @foreach(App\Models\Faq::orderBy("id","desc")->get() as $c) 
                @if($i==1)
                  <div class="accordion-item">
                  
                    <h2 class="accordion-header" id="headingOne">
                      <button class="ui-accordion__link accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <span class="ui-accordion__number">{{$i}}</span> {!! $c->question !!}
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                         {!! $c->answer !!}
                      </div>
                    </div>
                  </div>
               @else
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo{{$i}}">
                      <button class="ui-accordion__link  accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{$i}}" aria-expanded="false" aria-controls="collapseTwo{{$i}}">
                        <span class="ui-accordion__number">{{$i}}</span>   {!! $c->question !!}
                      </button>
                    </h2>
                    <div id="collapseTwo{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingTwo{{$i}}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                         {!! $c->answer !!}
                      </div>
                    </div>
                  </div>
                    @endif
                    @php $i++; @endphp
           @endforeach
                 
                </div>
              </div>
           </div>
       </div>
   </section>

@stop