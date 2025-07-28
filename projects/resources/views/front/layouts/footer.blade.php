
    <footer>
      <div class="container-fluid">
        <div class="upper-row">
          <div class="row">
            <div class="col-3 left">
              <img src="{{ asset('front') }}/images/footer-logo.png" alt="" class="img-fluid">
              <div class="trusted">
                    <h3>Trusted By More Than
                      100 Travelers Every Year</h3>
                  </div>
             
            </div>
            <div class="col-9 right">
              <!--<div class="top-bar">-->
              <!--  <div class="office">-->
              <!--    <h2>Top Destinations</h2>-->
              <!--    <ul class="hours">-->
              <!--       @foreach(App\Models\Location::orderBy("id","desc")->get() as $c)-->
              <!--      <li> <a href="{{url('/properties/location/'.$c->seo_url)}}"> <i class="fa-solid fa-mountain"></i> {{$c->name}}</a></li>-->
              <!--      @endforeach-->
              <!--    </ul>-->
              <!--  </div>-->
              <!--  <div class="contact-bar">-->
              <!--    <h2>Useful Links</h2>-->
              <!--    <ul class="hours">-->
                 
              <!--      <li> <a href="{{ url('properties') }}"> <i class="fa-solid fa-mountain"></i> View Listings</a></li>-->
              <!--      <li> <a href="{{url('gallery')}}"> <i class="fa-solid fa-mountain"></i> Memories</a></li>-->
              <!--      <li> <a href="{{ url('faq') }}"> <i class="fa-solid fa-mountain"></i> FAQ’s</a></li>-->
              <!--      <li> <a href="{{ url('about-us') }}"> <i class="fa-solid fa-mountain"></i> About RV 66 Rental</a></li>-->
               
              <!--      <li> <a href="{{ url('contact-us') }}"> <i class="fa-solid fa-mountain"></i> Contact us</a></li>-->
              <!--    </ul>-->
              <!--  </div>-->
              <!--</div>-->
              <div class="bottom-bar">
                <div class="content">
                  <div class="about-rv">
                <h2>About RV 66 Rental</h2>
                <p>{!! $setting_data['about'] ?? '#' !!}</p>
              </div>
              <div class="center">
                  <div class="call">
                    <p>For Bookings, Call us</p>
                    <a href="tel:{!! $setting_data['mobile'] ?? '#' !!}">{!! $setting_data['mobile'] ?? '#' !!}</a>
                  </div>

                  <div class="email">
                    <p>Email us</p>
                    <a href="mailto:{!! $setting_data['email'] ?? '#' !!}">{!! $setting_data['email'] ?? '#' !!}</a>
                  </div>
              </div>
                  

                  <div class="social">
                    <p>Social Icons</p>
                    <a href="{!! $setting_data['facebook'] ?? '#' !!}" target="_BLANK"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{!! $setting_data['instagram'] ?? '#' !!}" target="_BLANK"><i class="fa-brands fa-instagram"></i></a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright">
          <div class="row">
          <div class="col-3 left">
            <a href="https://www.webdesignvr.com/" target="_blank">
              <img src="{{ asset('front') }}/images/webdesign.png" alt="">
            </a>
          </div>
          <div class="col-9 right">
              <div class="left-copy">
            <p>{!! $setting_data['copyright'] ?? '#' !!}</p>
            </div>
            <div class="right-copy">
                <p>
                    <a href="{{ url('rentals-requirements') }}">
                        Rental Requirements
                    </a>
                     | 
                    <a href="{{ url('privacy-policy') }}">
                        Privacy Policy
                    </a>
                </p>
            </div>
          </div>
          
        </div>
        </div>
      </div>
    </footer>
<div class="fixed-action">
    <ul>
        <li><a href="https://www.facebook.com/rv66rental" title="Facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
        <li><a href="https://www.instagram.com/rv66rentals/" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
        <li><a href="mailto:info@rv66rental.com" title="Write us"><i class="fa-solid fa-envelope" data-label="Write us"></i></a></li>
        <li><a href="tel:+16308548949" title="Call us" target="_blank"><i class="fa-solid fa-phone" data-label="Call us"></i></a></li>
    </ul>
</div>

@include("front.layouts.js")
@yield("js")
