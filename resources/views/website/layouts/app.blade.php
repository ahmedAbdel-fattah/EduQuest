<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Courses | Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <!-- CSS here -->
    <link href="https://unpkg.com/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleMyPrpfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/progressbar_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    @yield('custom-css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('img/logo/loder.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="navbar row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{route('home')}}"><img src="{{asset('img/hero/logo.png')}}" style="" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                                <li><a href="{{ route('categories') }}">Categories</a>
                                                </li>
                                                <li><a href="{{ route('courses') }}">Courses</a></li>
                                                <li><a href="{{ route('about') }}">About</a></li>
                                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                                <li><a href="{{ route('faqs') }}">FAQs</a></li>
                                                <li>
                                                    <form action="{{route('search')}}" method="GET">
                                                        <input type="text" name="query" placeholder="Search..." class="search-input">
                                                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                                                    </form>
                                                </li>
                                                {{-- <li><a href="{{ route('myProfile') }}">My Profile</a></li> --}}
                                                <!-- Button -->
                                                @if (Auth::check())

                                                    <li>
                                                        @if ($user_data->profile_photo_path)
                                                    <p><img class="submenu"
                                                        src="{{ asset('storage/' . $user_data->profile_photo_path) }}"
                                                        alt class="d-block ui-w-80"
                                                        style="width:50px; border-radius:50%; height:50px;"></p>
                                                    @else
                                                    <p><img class="submenu"
                                                        src="{{ asset('/img/icon/default_prof_img.jpg') }}"
                                                        alt class="d-block ui-w-80"
                                                        style="width:50px; border-radius:50%; height:50px;"></p>
                                                    @endif


                                                        <ul class="submenu" style="width:fit-content; ">
                                                            <li><a href="{{ route('myProfile') }}">Profile</a></li>
                                                            <li><a href="{{ route('view.cart') }}">Cart</a></li>
                                                            <li><a href="{{ route('view.favourites') }}">Favourites</a></li>
                                                            <li><a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                    Logout
                                                                </a></li>
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                            </form>

                                                            {{-- <li><form action="" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn " style="width: 70px; padding:0;" >Logout</button>
                                                        </form></li> --}}

                                                        </ul>
                                                    </li>
                                                @else
                                                    <li class="button-header margin-left "><a
                                                            href="{{ route('register') }}" class="btn">Join</a></li>
                                                    <li class="button-header"><a href="{{ route('login') }}"
                                                            class="btn btn3">Log in</a></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    @yield('content')

    <footer>
        <div class="footer-wrappper footer-bg">
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo mb-25">
                                        <a href="index.html"><img src="assets/img/logo/logo2_footer.png"
                                                alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>The automated process starts as soon as your clothes go into the machine.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Our solutions</h4>
                                    <ul>
                                        <li><a href="#">Courses</a></li>
                                        <li><a href="#">Different Fields</a></li>
                                        <li><a href="#">Good Instructors</a></li>
                                        <li><a href="#">Strong Developers</a></li>
                                        <li><a href="#">Secure Data</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>EduQuest Links</h4>
                                    <ul>
                                        <li><a href="#">Categories</a></li>
                                        <li><a href="#">Courses</a></li>
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Developers</a></li>
                                        <li><a href="#">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- footer-bottom area -->
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="footer-border">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-12 ">
                                <div class="footer-copy-right text-center">
                                    <p>
                                       Copy Rights for EduQuest Team || DEPI Project
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>


    <!-- JS here -->
    {{-- myProfile --}}
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/animated.headline.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>


    <!-- Date Picker -->

    <script src="{{ asset('js/gijgo.min.js') }}"></script>

    <!-- Nice-select, sticky -->

    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>

    <!-- Progress -->

    <script src="{{ asset('js/jquery.barfiller.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->

    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/hover-direction-snake.min.js') }}"></script>

    <!-- contact -->

    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('custom-js')
</body>

</html>
