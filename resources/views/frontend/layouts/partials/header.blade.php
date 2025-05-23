<header id="header" class="header sticky-top">

    <!-- Start Top Bar -->
    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:{{ $siteInfo->email }}">{{ $siteInfo->email }}</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4">{{ $siteInfo->phone }}<span></span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="{{ $socials["Twitter"]  ?? '#' }}" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="{{ $socials["Facebook"]  ?? '#' }}" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="{{ $socials["Instagram"]  ?? '#' }}" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="{{ $socials["LinkedIn"]  ?? '#' }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">{{ $siteInfo->site_name }}</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#departments">Departments</a></li>
                    <li><a href="#doctors">Doctors</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>
            @if (Route::has('login'))
                    @auth
                        <a class="cta-btn d-none d-sm-block" href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a class="cta-btn d-none d-sm-block" href="{{ route('login') }}">Sign in</a>
                        @if (Route::has('register'))
                            <a class="cta-btn d-none d-sm-block" href="{{ route('register') }}">Sign up</a>
                        @endif
                    @endauth
                </nav>
            @endif

        </div>

    </div>

</header>