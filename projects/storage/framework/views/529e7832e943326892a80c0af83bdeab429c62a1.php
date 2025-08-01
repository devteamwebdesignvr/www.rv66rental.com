<header>
    <div class="main-header">
        <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('front')); ?>/images/logo.png" class="img-fluid" alt="logo"></a>
        <ul class="home-nav">
            <li class="nav-item"><a href="<?php echo e(url('/')); ?>" id="home-active">Home</a></li>
            <li class="nav-item"><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
            <li class="nav-item"><a href="<?php echo e(url('/properties')); ?>">Our Fleet</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Faqs & Policies</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="<?php echo e(url('/rentals-requirements')); ?>" class="dropdown-item">Rentals Requirements</a></li>
                    <li><a href="<?php echo e(url('/faq')); ?>" class="dropdown-item">FAQ</a></li>
                    <li><a href="<?php echo e(url('/privacy-policy')); ?>" class="dropdown-item">Privacy Policy</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="<?php echo e(url('/contact-us')); ?>"> Contact us</a></li>
             <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="<?php echo e(url('/service')); ?>" class="dropdown-item">Service and Storage</a></li>
                    <li><a href="<?php echo e(url('/consignment')); ?>" class="dropdown-item">Consignment</a></li>
                    <li><a href="<?php echo e(url('/blog')); ?>" class="dropdown-item">Blog</a></li>
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
            <li class="nav-item" ><a href="<?php echo e(url('/')); ?>">Home</a></li>
            <li class="nav-item"><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
            <li class="nav-item"><a href="<?php echo e(url('/properties')); ?>">Our Fleet</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Faqs & Policies</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="<?php echo e(url('/rentals-requirements')); ?>" class="dropdown-item">Rentals Requirements</a></li>
                    <li><a href="<?php echo e(url('/faq')); ?>" class="dropdown-item">FAQ</a></li>
                    <li><a href="<?php echo e(url('/privacy-policy')); ?>" class="dropdown-item">Privacy Policy</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="<?php echo e(url('/contact-us')); ?>">Contact us</a></li>
             <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="<?php echo e(url('/service')); ?>" class="dropdown-item">Service and Storage</a></li>
                    <li><a href="<?php echo e(url('/consignment')); ?>" class="dropdown-item">Consignment</a></li>
                    <li><a href="<?php echo e(url('/blog')); ?>" class="dropdown-item">Blog</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header><?php /**PATH /home/rv66rental/htdocs/www.rv66rental.com/projects/resources/views/front/layouts/header.blade.php ENDPATH**/ ?>