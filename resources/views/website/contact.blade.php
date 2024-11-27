@extends('website.layouts.app')
@section('content')

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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Contact us</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
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
        <!--?  Contact Area start  -->
        <section class="contact-section">
            <div class="container">

                <!-- Google Maps Embedded Iframe -->
                <div style="width: 100%; height: 500px; margin-bottom: 30px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d441329.4052758936!2d31.472259!3d30.2118016!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458055d38032701%3A0x7708c8ef7404ce9c!2z2KzYp9mF2LnYqSDYqNmG2YfYpyDYp9mE2KPZh9mE2YrYqQ!5e0!3m2!1sar!2seg!4v1721122268802!5m2!1sar!2seg"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                    </div>
                    <div class="col-lg-8">
                        <!-- Contact Form -->
                        <form action="{{ route('contacts.store') }}" method="POST" class="form-contact contact_form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder="Enter Message">{{ old('message') }}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if (Auth::user())
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" value="{{ $user_data->name }}" readonly hidden>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email" value="{{ $user_data->email }}" readonly hidden>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                @else

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                @endif
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject" value="{{ old('subject') }}">
                                        @if ($errors->has('subject'))
                                            <span class="text-danger">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <!-- Contact Info -->
                        @foreach ($settings as $setting)
                            <div class="media contact-info" style="display: flex; align-items: center;">
                                <span class="contact-info__icon" style="margin-right: 10px;"><i class="ti-home"></i></span>
                                <div class="media-body">
                                    <h3>{{ $setting->address }}</h3>
                                    <p>Location Details</p>
                                </div>
                            </div>
                            <div class="media contact-info" style="display: flex; align-items: center;">
                                <span class="contact-info__icon" style="margin-right: 10px;"><i class="ti-tablet"></i></span>
                                <div class="media-body">
                                    <h3>{{ $setting->phone }}</h3>
                                    <p>Mon to Fri 9am to 6pm</p>
                                </div>
                            </div>
                            <div class="media contact-info" style="display: flex; align-items: center;">
                                <span class="contact-info__icon" style="margin-right: 10px;"><i class="ti-email"></i></span>
                                <div class="media-body">
                                    <h3>{{ $setting->email }}</h3>
                                    <p>Send us your query anytime!</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End -->
    </main>
@endsection
