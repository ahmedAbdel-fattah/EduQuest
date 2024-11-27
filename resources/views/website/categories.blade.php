@extends('website.layouts.app')
@section('content')

<main>
    <!-- Slider Area Start -->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Courses Categories</h1>
                                <!-- Breadcrumb Start -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('categories') }}">Categories</a></li>
                                    </ol>
                                </nav>
                                <!-- Breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider Area End -->

    <div class="container">
        <h1 class="page-title">Explore Categories</h1>
        <div class="categories-grid">

            @foreach($categories as $category)
            <div class="category-card">
                <a href="{{route('courses')}}">
                    <img src="{{ asset('public/images/' . $category->image) }}" alt="{{ $category->name }}">                    <div class="category-info">
                        <h3 style="color:white; font-size: 2.2rem">{{$category->name}}</h3>
                    </div>
                </a>
            </div>

            @endforeach
        </div>
    </div>

</main>

@endsection
