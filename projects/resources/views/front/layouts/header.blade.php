<header>
    <div class="main-header">
        <a href="{{url('/')}}" class="logo"><img src="{{ asset('front') }}/images/logo.png" class="img-fluid" alt="logo"></a>
        <ul class="home-nav">
            <li class="nav-item"><a href="{{url('/')}}" id="home-active">Home</a></li>
            <li class="nav-item"><a href="{{url('/about-us')}}">About Us</a></li>
            <li class="nav-item"><a href="{{url('/properties')}}">Our Fleet</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Faqs & Policies</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="{{url('/rentals-requirements')}}" class="dropdown-item">Rentals Requirements</a></li>
                    <li><a href="{{url('/faq')}}" class="dropdown-item">FAQ</a></li>
                    <li><a href="{{url('/privacy-policy')}}" class="dropdown-item">Privacy Policy</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{url('/contact-us')}}"> Contact us</a></li>
             <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="{{url('/service')}}" class="dropdown-item">Service and Storage</a></li>
                    <li><a href="{{url('/consignment')}}" class="dropdown-item">Consignment</a></li>
                    <li><a href="{{url('/blog')}}" class="dropdown-item">Blog</a></li>
                </ul>
            </li>
        </ul>
        <button id="menubox" class="menubox">
        <span class="menuboxul" id="open"><em></em><em></em><em></em></span>
        <span class="cross-icon" id="close"><em></em><em></em><em></em></span>
        </button>
    </div>
    <div class="modal" id="menulightbox">
        <ul class="menuul">
            <li class="nav-item" ><a href="{{url('/')}}">Home</a></li>
            <li class="nav-item"><a href="{{url('/about-us')}}">About Us</a></li>
            <li class="nav-item"><a href="{{url('/properties')}}">Our Fleet</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Faqs & Policies</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="{{url('/rentals-requirements')}}" class="dropdown-item">Rentals Requirements</a></li>
                    <li><a href="{{url('/faq')}}" class="dropdown-item">FAQ</a></li>
                    <li><a href="{{url('/privacy-policy')}}" class="dropdown-item">Privacy Policy</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{url('/contact-us')}}">Contact us</a></li>
             <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="{{url('/service')}}" class="dropdown-item">Service and Storage</a></li>
                    <li><a href="{{url('/consignment')}}" class="dropdown-item">Consignment</a></li>
                    <li><a href="{{url('/blog')}}" class="dropdown-item">Blog</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>