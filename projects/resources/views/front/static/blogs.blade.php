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

 
  <section class="blog-wrapper">
  <div class="container">
    <div class="home-blog-sec">
      <div class="row  " >
        
  @forelse($blogs as $b)
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="blog-page">
             @php $date=$b->publish_date; if($date){}else{$date=$b->created_at;} @endphp

            @if($b->featureImage)
            <div class="home-blog-image">
               <img src="{{ asset($b->featureImage) }}" alt="{{ $b->title }}">
            </div>
            @endif
            <div class="blog-content">
              <h4><a href="{{ url('blog/'.$b->seo_url) }}/"> {{$b->title}} </a></h4>
                     <h6 class="blog-feat">
                <span class="blog-date"><i class="far fa-calendar-alt"></i>&nbsp; {{date('d-F-Y',strtotime($date))}}</span>
                  @php $category=App\Models\Blogs\BlogCategory::where("id",$b->blog_category_id)->first(); @endphp

                  @if($category)

          
<span class="blog-date"><i class="fas fa-list"></i>&nbsp;<a href="{{ url('blogs/category/'.$category->seo_url) }}/">{{$category->title}}</a></span>
                  @endif
                
              </h6>
              <p> {{ Str::limit($b->shortDescription,100)}}</p>
              <a href="{{ url('blog/'.$b->seo_url) }}/" class="blog-read btn-25"><span>Read More <i class="fas fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
   

    @empty

         <div class="alert alert-danger">No any Blogs Found.</div>

         @endforelse

      </div>

      <div class="row">{{$blogs->links() }}</div>
    </div>
  </div>
</section>

@stop
@section("js")
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script>
    // external js: masonry.pkgd.js, imagesloaded.pkgd.js

// init Masonry
var $grid = $('.grid').masonry({
  itemSelector: '.grid-item',
  percentPosition: true,
  columnWidth: '.grid-sizer'
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry();
});  
</script>
	
@stop