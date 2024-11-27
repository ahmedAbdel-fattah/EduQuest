<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Courses | Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/enrollment.css')}}">

</head>

<body>
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
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                            <li><a href="{{ route('courses') }}">Courses</a></li>
                                            <li><a href="{{ route('about') }}">About</a></li>
                                            <li><a href="{{ route('blog') }}">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('blog') }}">Blog</a></li>
                                                    <li><a href="{{ route('blog-details') }}">Blog Details</a></li>
                                                    <li><a href="{{ route('elements') }}">Elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('contact') }}">Contact</a></li>
                                            {{-- <li><a href="{{ route('myProfile') }}">My Profile</a></li> --}}
                                            <!-- Button -->
                                            @if (Auth::check())
                                                <li ><p><img class="submenu" src="{{asset('storage/'. $user_data->profile_photo_path)}}" alt class="d-block ui-w-80" style="width:50px; border-radius:50%; height:50px;"></p>

                                                    <ul class="submenu" style="width:fit-content; ">
                                                        <li ><a href="{{ route('myProfile') }}">Profile</a></li>
                                                        <li ><a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                Logout
                                                            </a></li>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
<div class="course-details-left">
    <div class="course-image">
        <img src="{{asset('storage/'.$course_info->image)}}" alt="Course Image">
    </div>
    <div class="course-info">
        <h2>{{$course_info->title}}</h2>
        <p class="course-description">
            {{$course_info->description}}
        </p>
        <p class="course-price">${{$course_info->price}}</p>
    </div>
</div>
<div class="navbar-bg"></div>

    <div class="payment-container">
        <div class="payment-header">
            <h1>Enroll in Course</h1>
            <p>Complete the payment to enroll in the course</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="payment-form">
            <form id="payment-form" action="{{route('enroll.course',$course_info->id)}}" method="post">
                @csrf

                <!-- Personal Information -->
                <div class="section">
                    <h2>Personal Information</h2>
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                </div>

                <!-- Payment Details -->
                <div class="section">
                    <h2>Payment Information</h2>
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card_number" placeholder="1234 1234 1234" required>

                    <div class="card-details">
                        <div>
                            <label for="expiry-date">Expiry Date</label>
                            <input type="text" name="expiry_date" id="expiry-date" placeholder="MM/YY" required>
                        </div>
                        <div>
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123" required>
                        </div>
                    </div>
                </div>

                <!-- Course Details and Payment -->
                <div class="section">
                    <h2>Course Details</h2>
                    <p><strong>Course Title:</strong>{{$course_info->title}}</p>
                    <p><strong>Price:</strong> ${{$course_info->price}}</p>
                </div>

                <!-- Enroll Button -->
                <button type="submit" class="btn-enroll">Enroll Now</button>
            </form>
            <br><br>
        </div>
    </div>

</body>
</html>

