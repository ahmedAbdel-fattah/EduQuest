@extends('website.layouts.app')


@section('content')

    <style>
        .containerr {
            padding: 40px;
            background-color: #ffffff;
            /* Light Gray */
            text-align: center;

        }

        .containerr .profile-details {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #e0e0e0;
            /* Light border */
            padding-bottom: 20px;

        }

        .containerr .profile-picture {


            text-align: center;

        }

        .containerr .profile-picture img {
            width: 200px;
            max-height: 200px;
            border-radius: 50%;
            /* border: 4px solid #6c757d; Gray */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .containerr .details {
            text-align: center;
            margin-left: 30px;
            margin: auto;
            width: 70%;
            background-color: #ffffff;
            /* White */
            padding: 20px;
            padding-top: 0;
            border-radius: 15px;
            color: #333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .containerr .details:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .containerr .details h3 {
            margin-bottom: 10px;
            font-size: 1.6em;
            color: #007bff;
            /* Blue */
        }

        .containerr .about-teacher,
        .containerr .courses-taught {
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .containerr .about-teacher {
            background-color: #e9ecef;
            /* Light Gray */
            color: #333;
        }

        .containerr .about-teacher h3 {
            margin-bottom: 15px;
            font-size: 1.5em;
            color: #007bff;
            /* Blue */
        }

        .containerr .courses-taught {
            background-color: #ffffff;
            /* White */
        }

        .containerr .courses-taught h3 {
            margin-bottom: 15px;
            font-size: 1.5em;
            color: #007bff;
            /* Blue */
        }

        .containerr .courses-taught ul {
            list-style: none;
            padding-left: 0;
        }

        .containerr .courses-taught ul li {
            background-color: #007bff;
            /* Blue */
            color: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .containerr .courses-taught ul li:hover {
            background-color: #0056b3;
            /* Darker Blue */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero_caption hero_caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Course instructor</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Course instructor</a></li>
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

    @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show" style="padding:10px; position: fixed; background-color:rgb(41, 142, 55); color:white; border-radius:5px;" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" style="background-color: unset; cursor: pointer; margin-left:20px;" data-bs-dismiss="alert" aria-label="Close">X</button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" style="padding:10px; position: fixed; background-color:rgb(239, 96, 96); color:white; border-radius:5px;" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" style="background-color: unset; cursor: pointer; margin-left:20px;" data-bs-dismiss="alert" aria-label="Close">X</button>
    </div>
@endif
    <div class="containerr">
        <div class="profile-details">
            <div class="details">
                <div class="profile-picture">
                    @if ($course_instructor->profile_photo_path)

                    <img src="{{ asset('storage/' . $course_instructor->profile_photo_path) }}" alt="Instructor Picture">
                    @else
                    <img src="{{ asset('img/icon/default_prof_img.jpg') }}" alt="Instructor Picture">

                    @endif
                </div>
                <h3>I'm {{ $course_instructor->name }}</h3>
                <p>{{ $instructor->specialization }}</p>
                <p>Have a {{ $instructor->experience_years }} Years of Experience</p>
                <p>Email: <a style="color: peru"
                        href="mailto:{{ $course_instructor->email }}">{{ $course_instructor->email }}</a> </p>
                <p>Phone: <a style="color:peru" href="tel:{{ $instructor->phone }}">{{ $instructor->phone }}</a> </p>
                <div class="about-teacher">
                    <h3>About Instructor</h3>
                    <p>{{ $instructor->description }}</p>
                </div>


                <div class="courses-taught">
                    <h3>Courses Taught</h3>


                    @if ($courses->count() > 0)
                        <ul>
                            @foreach ($uniqueCourses as $course)
                                <li>{{ $course->title }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No courses found for this instructor.</p>
                    @endif
                </div>


            </div>




        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="/css/reviews.css">

        <section class="student-reviews">
            @auth
            {{-- عرض جميع المراجعات الخاصة بالدورة --}}
            {{-- <h3 @yield('h_2')>Reviews</h3> --}}
            @if ($instructor->user_id != auth()->user()->id)


                    <h3 @yield('h_2')>Rate the Course</h3>
                    <form action="{{ route('sub_review', $course->id) }}" method="POST" class="review-form">
                        @csrf
                        <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
                        <div class="slider-rating">
                            <input type="range" id="rate-slider" name="rate" min="1" max="5"
                                step="0.5" value="3" required>
                                <span id="rating-value">3</span> / 5 <span class="stars"><i class="fas fa-star"></i></span>
                        </div>
                        <textarea name="comment" placeholder="Leave a comment..." rows="4" required></textarea>
                        <button type="submit" class="submit-review">Submit Review</button>
                    </form>


                @endif
                @if ($course->reviews->isEmpty())
                    <h3>No reviews available</h3>
                @else

                @if ($instructor->user_id != auth()->user()->id)
                <h2 @yield('h_1')>All Reviews for this instructor</h2>
                @else
                <h2 @yield('h_1')>All Reviews about you</h2>
                @endif
                    <div class="reviews">
                        @foreach ($course->reviews as $review)
                            <div class="review" style="position: relative;">
                                <p style="float:right; cursor: pointer; display: inline;"
                                    onclick="toggleEditDeleteForm({{ $review->id }})">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </p>
                                <div class="review-header">
                                    @if ($review->user)
                                    @if ($review->user->profile_photo_path)

                                    <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}"
                                        alt="User Image" class="user-image">
                                        @else
                                        <img src="{{ asset('img/icon/default_prof_img.jpg') }}"
                                            alt="User Image" class="user-image">

                                    @endif
                                        <div class="review-details">
                                            <p class="user-name">{{ $review->user->name }}</p>
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($review->rate))
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i == ceil($review->rate) && fmod($review->rate, 1) == 0.5)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="review_date">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    @else
                                        <img src="{{ asset('/img/icon/default_prof_img.jpg') }}" alt="User Image"
                                            class="user-image">
                                        <div class="review-details">
                                            <p class="user-name">Unknown User</p>
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($review->rate))
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i == ceil($review->rate) && fmod($review->rate, 1) == 0.5)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="review_date">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div id="review-content-{{ $review->id }}">
                                    <p class="comment">{{ $review->comment }}</p>
                                </div>

                                <div style="position: relative;">
                                    @auth
                                        {{-- عرض خيارات التعديل والحذف فقط إذا كان المستخدم هو صاحب التعليق --}}
                                        @if ($review->user_id == auth()->user()->id)
                                            <div id="edit-delete-form-{{ $review->id }}"
                                                style="display: none; position: absolute; top: -80px; right: 0; background: white; border: 1px solid #ccc; padding: 5px; z-index: 10;">
                                                <form action="{{ route('delete_review', $review->id) }}" method="POST"
                                                    onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        style="color: red; background-color: unset; border: none; cursor: pointer;">Delete</button>
                                                </form>

                                                <button
                                                    style="background-color: unset; border: none; cursor: pointer; color: blue;"
                                                    onclick="editReview({{ $review->id }})">Edit</button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>

                            <div id="edit-review-form-{{ $review->id }}" style="display: none;">
                                <form action="{{ route('update_review', $review->id) }}" method="POST"
                                    onsubmit="return confirmUpdate({{ $review->id }})">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="comment" rows="3">{{ $review->comment }}</textarea>
                                    <button type="submit">Save</button>
                                    <button type="button" onclick="cancelEdit({{ $review->id }})">Cancel</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- عرض نموذج التقييم فقط للمستخدمين الذين ليسوا المدرب --}}

            @endauth
        </section>




        <script>
            function toggleEditDeleteForm(reviewId) {
                const form = document.getElementById(edit-delete-form-${reviewId});
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }

            function confirmDelete() {
                return confirm('Are you sure you want to delete this review?');
            }

            function editReview(reviewId) {
                // إخفاء نص التعليق وإظهار نموذج التعديل
                document.getElementById(review-content-${reviewId}).style.display = 'none';
                document.getElementById(edit-review-form-${reviewId}).style.display = 'block';
            }

            function confirmUpdate(reviewId) {
                return confirm('Are you sure you want to update this review?');
            }

            function cancelEdit(reviewId) {
                // إعادة إظهار نص التعليق وإخفاء نموذج التعديل
                document.getElementById(review-content-${reviewId}).style.display = 'block';
                document.getElementById(edit-review-form-${reviewId}).style.display = 'none';
            }
        </script>

<script>
    const slider = document.getElementById('rate-slider');
    const ratingValue = document.getElementById('rating-value');

    slider.addEventListener('input', function() {
        ratingValue.textContent = slider.value;
    });
</script>

    </div>



@endsection
