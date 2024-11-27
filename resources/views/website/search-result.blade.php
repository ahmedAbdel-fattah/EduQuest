@extends('website.layouts.app')
@section('content')


{{--    <h3>Users</h3>--}}
{{--    @if($users->count())--}}
{{--        <ul>--}}
{{--            @foreach($users as $user)--}}
{{--                <li>{{ $user->name }} - {{ $user->email }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @else--}}
{{--        <p>No users found.</p>--}}
{{--    @endif--}}

{{--    <h3>FAQs</h3>--}}
{{--    @if($faqs->count())--}}
{{--        <ul>--}}
{{--            @foreach($faqs as $faq)--}}
{{--                <li>{{ $faq->question }} - {{ $faq->answer }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @else--}}
{{--        <p>No users found.</p>--}}
{{--    @endif--}}



<!--? slider Area Start-->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            <h1 data-animation="bounceIn" data-delay="0.2s">Search Result</h1>
                            <!-- breadcrumb Start-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Search Result</a></li>
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
    <main>
        <div class="container">
            <h2 class="results-title">Search Results for: "{{ $query }}"</h2>
            <div class="results-list">
                <h3>Courses</h3>
                @if($courses->count())
                    <ul>
                        @foreach($courses as $course)
                            <div class="result-item">
                                <h3><a href="{{ route('course_details', $course->id) }}">{{ $course->title }}</a></h3>
                                <p class="result-description">{{$course->description}}</p>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No courses found.</p>
                @endif
                <br>
                <h3>Categories</h3>
                @if($subjects->count())
                    <ul>
                        @foreach( $subjects as  $subject)
                            <div class="result-item">
                                <h3><a href="{{ route('categories') }}">{{  $subject->name }}</a></h3>
                                <p class="result-description">{{ $subject->description}}</p>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No courses found.</p>
                @endif
                <br>
                <h3>Instructors</h3>
                @if($users->count())
                    <ul>
                        @foreach( $users as  $user)
                            <div class="result-item">
                                <h3><a href="{{ route('course-instructor',$user->id) }}">{{  $user->name }}</a></h3>
                                <p class="result-description">Instructor</p>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No courses found.</p>
                @endif
                <br>
                <h3>FAQs</h3>
                @if($faqs->count())
                    <ul>
                        @foreach( $faqs as  $faq)
                            <div class="result-item">
                                <h3><a href="{{ route('faqs') }}">{{  $faq->question }}</a></h3>
                                <p class="result-description">{{ $faq->answer}}</p>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No courses found.</p>
                @endif
            </div>
        </div>
    </main>
@endsection
