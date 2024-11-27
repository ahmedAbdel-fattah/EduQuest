@extends('website.layouts.app')
@section('content')


<main>





<section class="slider-area slider-area2">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            <h1 data-animation="bounceIn" data-delay="0.2s">Course details</h1>
                            <!-- breadcrumb Start-->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Course details</a></li>
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


    <section class="course-details">
        <div class="course-content">
            <div class="text-content">
                <h1 class="course-title">{{$course_info->title}}</h1>
                <p class="description"><strong>Description:</strong> {{$course_info->description}}</p>
                <p class="objectives"><strong>Objectives:</strong> {{$course_info->objective}}</p>

                <div class="course-price">
                    <span class="price"><strong>Price:</strong> {{$course_info->price}} EGP</span>
                </div>

                <div class="course-actions">
                    <button class="cart-btn" data-course-id="{{ $course_info->id }}">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <button class="fav-btn" data-course-id="{{ $course_info->id }}">
                        <i class="fas fa-heart"></i> Add to Favorites
                    </button>
                </div>

                @if($enrolledUsers || auth()->id()==$course_info->instructor_id)
                    <a href="{{route('course_videos',$course_info->id)}}" class="register-button">Go To Course</a>
                @else
                    @if($course_info->price==0)
                        <a href="{{route('view.free.enroll',$course_info->id)}}" class="register-button">Enroll</a>
                    @else
                        <a href="{{route('view.enroll.course',$course_info->id)}}" class="register-button">Buy Now</a>
                    @endif
                @endif
            </div>

            <div class="course-image">
                <img src="{{asset('storage/'. $course_info->image)}}" alt="Course Image">
            </div>
        </div>
    </section>



<aside class="sidebar">
    <button class="floating-button">Register / Buy</button>
</aside>

    <section class="certificate-section">
        <h2>Course Completion Certificate</h2>
        <div class="certificate-content">
            <img src="{{asset('img/certi.png')}}" alt="Certificate" class="certificate-image">
            <div class="certificate-description">
                <h3>After Finishing this course</h3>
                <p>You will be able to get certificate like this you can share it to linkedin</p>
            </div>
        </div>
    </section>




{{-- ---------------------------------------------------------------------------------------------- --}}


    <section class="instructor-section">
        <h2 class="instructor-title">Instructor</h2>
        <div class="instructor-info">
            <div class="instructor-photo">
                <img src="{{ asset('storage/' . $instructor->User->profile_photo_path) }}" alt="{{ $instructor->name }}">
            </div>
            <div class="instructor-details">
                <h3 class="instructor-name">
                    <a href="{{ route('course-instructor', $instructor->user_id) }}">{{ $instructor->User->name }}</a>
                </h3>
                <h4 class="instructor-specialization">{{$instructor->specialization}}</h4>
                <p class="instructor-occupation">{{ $instructor->occupation }}</p>
                <ul class="instructor-stats">
                    <li><i class="fas fa-star"></i> {{ $instructor->rating }} Instructor Rating</li>
                    <li><i class="fas fa-comments"></i> {{ $totalReviewsCount }} Reviews</li>
                    <li><i class="fas fa-users"></i> {{ $instructor_students }} Students</li>
                    <li><i class="fas fa-play"></i> {{ $courses->count() }} Courses</li>
                </ul>
                <p class="instructor-bio">{{ Str::limit($instructor->description, 150) }} <a href="{{ route('course-instructor', $instructor->user_id) }}" class="show-more">Show more</a></p>
            </div>
        </div>
    </section>




{{-- ---------------------------------------------------------------------------------------------- --}}



<div class="containerr">

    @include('website.layouts.reviews_section')
</div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // Add to cart action
        $('.cart-btn').click(function (e) {
            e.preventDefault();

            let courseId = $(this).data('course-id');

            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: {
                    course_id: courseId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.success);
                    // Optionally, update cart count or UI
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });
    });

    $(document).ready(function () {
        // Add to cart action
        $('.fav-btn').click(function (e) {
            e.preventDefault();

            let courseId = $(this).data('course-id');

            $.ajax({
                url: '{{ route("favourite.add") }}',
                type: 'POST',
                data: {
                    course_id: courseId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.success);
                    // Optionally, update cart count or UI
                },
                error: function (xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        });
    });
</script>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
    // عند تحميل الصفحة، قم بإرجاع المستخدم إلى موضعه السابق
document.addEventListener("DOMContentLoaded", function() {
    // الحصول على موضع التمرير المخزن
    const scrollPosition = localStorage.getItem("scrollPosition");

    if (scrollPosition) {
        // إذا كان هناك موضع مخزن، استرجعه
        window.scrollTo(0, scrollPosition);
    }
});

// قبل إعادة تحميل الصفحة أو إرسال البيانات، قم بحفظ موضع التمرير
window.addEventListener("beforeunload", function() {
    // حفظ موضع التمرير في LocalStorage
    localStorage.setItem("scrollPosition", window.scrollY);
});

</script>



@endsection

