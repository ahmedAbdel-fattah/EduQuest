@extends('website.layouts.app')
@section('content')
<!-- ? Preloader Start -->


<main>
    <!--? slider Area Start-->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">About us</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">about</a></li>
                                    </ol>
                                </nav>
                                <!-- breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="services-area services-area2 section-padding40">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="{{asset('img/icon/icon1.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>60+ UX courses</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="{{asset('img/icon/icon2.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Expert instructors</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="assets/img/icon/icon3.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Life time access</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--? About Area-1 Start -->
    <section class="about-area1 fix pt-10">
        <div class="support-wrapper align-items-center">
            <div class="left-content1">
                <div class="about-icon">
                    <img src="{{asset('img/icon/about.svg')}}" alt="">
                </div>
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-55">
                    <div class="front-text">
                        <h2 class="">Learn new skills online with top educators</h2>
                        <p>The automated process all your website tasks. Discover tools and
                            techniques to engage effectively with vulnerable children and young
                            people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Techniques to engage effectively with vulnerable children and young people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together.</p>
                    </div>
                </div>

                <div class="single-features">
                    <div class="features-icon">
                        <img src="assets/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together. Online learning is as easy
                            and natural.</p>
                    </div>
                </div>
            </div>
            <div class="right-content1">
                <!-- img -->
                <div class="right-img">
                    @foreach ($adVideo as $adVideo)
                            <video id="course-video" controls style="width: 100%; border-radius:10px;">
                                <source id="video-source"  src="{{ asset('videos/'.$adVideo->video) }}" type="video/mp4" >
                                Your browser does not support the video tag.
                            </video>
                            @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->

    <!--? Team -->
    <section class="team-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Our Developers</h2>
                    </div>
                </div>
            </div>
            <div class="team-active d-inline">
                @foreach ($developers as $developer)
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img style="width: 150px;" src="{{asset($developer->image)}}" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">{{$developer->name}}</a></h5>
                        <p>{{$developer->role}}</p>
                        <div>
                            <a class="m-1" href="{{$developer->facebook}}"><i class="fab fa-facebook-f"></i></a>
                            <a class="m-1" href="{{$developer->linkedin}}"><i class="fab fa-linkedin"></i></a>
                            <a class="m-1" href="{{$developer->twitter}}"><i class="fa-solid fa-envelope"></i></a>
                            <a class="m-1" href="{{$developer->github}}"><i class="fab fa-github"></i></a>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
            {{-- @if(in_array( auth()->user()->name , ['Ibarhim Hatem', 'Saad Adbelrazek','Anas Ahmed','mohamed abdelnaser','ahmed mohamed']))
            <div class="d-flex justify-content-center">
                <a href="{{route('developer.create')}}" class="genric-btn primary  mt-5">Add Developer</a>
            </div>
            @endif --}}

        </div>
    </section>
    <!-- Services End -->
</main>
@endsection
