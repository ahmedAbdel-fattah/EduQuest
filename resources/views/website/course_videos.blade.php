<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="/css/reviews.css">
@extends('website.layouts.app')
@section('content')


<style>
    .sidebar {
        width: 30%;
        background-color: #2e2e3a;
        height: 580px; /* Sidebar is limited to a specific height */
        overflow-y: auto;
        padding: 20px;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-left: 20px; /* Spacing between sidebar and video */
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .sidebar-logo img {
        width: 60px;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar li {
        margin-bottom: 10px;
    }

    .sidebar a {
        display: block;
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        padding: 12px;
        background-color: #333344;
        border-radius: 8px;
        transition: background 0.3s ease, color 0.3s ease;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar a:hover {
        background-color: #575787;
        color: #e0e0e0;
    }

    .sidebar a.active {
        background: linear-gradient(135deg, #d41872, #6a1b9a);
        color: white;
    }

    .sidebar a i {
        margin-right: 10px;
        font-size: 18px;
    }

    .sidebar .section-header {
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        background-color: #4c4c61;
        padding: 12px;
        border-radius: 8px;
        color: #fff;
        transition: background 0.3s ease;
    }

    .sidebar .section-header:hover {
        background-color: #5e5e73;
    }

    .sidebar .section-content {
        display: none;
        padding: 0;
        margin-top: 10px;
    }

    .sidebar .section-content a {
        font-size: 14px;
        padding-left: 20px;
        padding-right: 10px;
    }

    .sidebar .section.active .section-content {
        display: block;
    }

    /* Responsive for Smaller Screens */
    @media screen and (max-width: 992px) {
        .container {
            flex-direction: column;
        }

        .main-content, .sidebar {
            width: 100%;
        }

        .sidebar {
            height: auto; /* Full height when in mobile view */
            margin-left: 0;
        }
    }
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    /* Container for Main Content and Sidebar */
    .container {
        display: flex;
        flex-wrap: wrap;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Video Container */
    .video-container {
        flex: 3;
        padding-right: 20px;
    }

    /* Video Player */
    #course-video {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Course Details */
    .course-details {
        margin-top: 20px;
    }

    .course-details h1 {
        font-size: 26px;
        margin-bottom: 15px;
        color: #333;
    }

    /* Instructor Details */
    .instructor-details {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .instructor-details img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .instructor-info h4 {
        font-size: 18px;
        color: #555;
    }

    /* Modern Progress Bar */
    .progress-bar {
        width: 100%;
        background-color: #e0e0e0;
        height: 14px;
        border-radius: 10px;
        margin-top: 10px;
        position: relative;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background: linear-gradient(to right, #a445b2, #d41872);
        transition: width 0.5s ease-in-out;
        border-radius: 10px;
    }

    .progress {
        background-color: #6a1b9a;
        height: 100%;
        width: 50%; /* Example percentage */
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(106, 27, 154, 0.5);
    }

    /* Comments Section */
    .comments {
        margin-top: 40px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .comments h2 {
        font-size: 22px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Comment Input */
    .comment-box {
        margin-bottom: 20px;
    }

    .comment-box textarea {
        width: 100%;
        height: 100px;
        padding: 15px;
        border: none;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        font-size: 16px;
        color: #333;
        resize: none;
        transition: box-shadow 0.3s ease;
    }

    .comment-box textarea:focus {
        outline: none;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .submit-comment {
        padding: 10px 25px;
        background-color: #a445b2;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 16px;
        text-transform: uppercase;
    }

    .submit-comment:hover {
        background-color: #d41872;
    }

    /* Comment List */
    .comment-list {
        margin-top: 20px;
    }

    .comment {
        background-color: #f7f7f7;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .comment strong {
        font-weight: 600;
        color: #333;
    }

    .comment p {
        font-size: 15px;
        color: #555;
    }

    /* Review Section */
    .course-review {
        margin-top: 40px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .course-review h2 {
        font-size: 22px;
        color: #333;
        margin-bottom: 20px;
    }

    .course-review p {
        font-size: 18px;
        color: #777;
        margin-bottom: 20px;
    }

    .review-box textarea {
        width: 100%;
        height: 80px;
        padding: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
        border: none;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        font-size: 16px;
        color: #333;
        resize: none;
        transition: box-shadow 0.3s ease;
    }

    .review-box textarea:focus {
        outline: none;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .submit-review {
        padding: 10px 25px;
        background-color: #ff5722;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 16px;
        text-transform: uppercase;
    }

    .submit-review:hover {
        background-color: #e64a19;
    }
    .course-title {
        background-color: #4C4C6D; /* Dark purple background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        margin-left: 180px ;
        width: 80%;
        max-width: 770px;
        text-align: center;
    }

    /* Title Text */
    .course-title h2 {
        font-size: 28px;
        font-weight: bold;
        color: white;
        letter-spacing: 1px;
        margin: 0;
        text-transform: uppercase;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .course-title {
            font-size: 1.8rem; /* Slightly smaller font size */
            padding: 15px; /* Reduce padding */
            margin-left: 90px;
        }
    }

    @media (max-width: 992px) {
        .course-title {
            font-size: 1.6rem; /* Smaller font size */
            padding: 10px; /* Further reduce padding */
            margin-left: 70px;
        }
    }

    @media (max-width: 768px) {
        .course-title {
            font-size: 1.4rem; /* Even smaller font size for tablets */
            padding: 8px; /* Further reduce padding */
            width: 95%; /* Slightly increase width on smaller screens */
            margin-left: 50px;
        }
    }

    @media (max-width: 576px) {
        .course-title {
            font-size: 1.2rem; /* Small font size for mobile */
            padding: 5px; /* Minimal padding for mobile */
            width: 100%; /* Full width for mobile */
            margin-left: 25px;
        }
    }

    /* Responsive for smaller screens */
    @media screen and (max-width: 768px) {
        .course-title {
            width: 90%;
        }

        .course-title h2 {
            font-size: 24px;
        }
    }
    .navbar-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100px; /* Adjust the height of the background */
        background: linear-gradient(135deg, #6a0572, #a4508b); /* Purple to pink gradient */
        z-index: -1; /* Position behind the navbar */
    }
    #course-video{
        max-height: 550px;
    }

</style>
<div class="navbar-bg"></div>
<br><br><br><br><br>
<div class="course-title">
    <h2>{{$course->title}}</h2>
</div>
<!-- Main Container -->
<div class="container">
    <!-- Main Video Area -->
    <div class="video-container">
        <!-- Video Player -->
        <video id="course-video" controls preload="auto">
            <source id="video-source" data-id="{{ $firstVideo->id }}" src="{{ asset('storage/' . $firstVideo->path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Course Title and Instructor -->
        <div class="course-details">
            <h1>{{$course->title}}</h1>
            <div class="instructor-details">
                <img src="{{asset('storage/'.$instructor->profile_photo_path)}}" alt="Instructor Image">
                <div class="instructor-info">
                    <h4>Instructor: {{$instructor->name}}</h4>
                </div>
            </div>
            <!-- Progress Bar -->
            <p><strong>Course Progress : </strong></p>
           @if($progress)
                <div class="progress-bar" style="width: {{$progress}}%">
                    <div class="progress"></div>
                </div>
                <p><strong>{{number_format($progress, 2)  }}%</strong></p>
               @if($progress==100 && $course->price != 0)
                   <a href="{{route('certificate',$course->id)}}" class="submit-comment"> Get Certificate</a>
               @endif
            @else
               <p>No Progress Yet</p>
           @endif
        </div>
        @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" style="padding:10px; width:35%; background-color:rgb(41, 142, 55); color:white; border-radius:5px;" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" style="background-color: unset; cursor: pointer; margin-left:20px;" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" style="padding:10px; width:35%; background-color:rgb(239, 96, 96); color:white; border-radius:5px;" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" style="background-color: unset; cursor: pointer; margin-left:20px;" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
    @endif


        <!-- Comments Section -->
        <div class="comments">
            <h2>Reviews and Comments</h2>
            <form action="{{ route('sub_review', $course->id) }}" method="POST" class="review-form">
                @csrf
                <input type="hidden" name="instructor_id" value="{{ $course->instructor_id }}">
                <div class="slider-rating">
                    <input type="range" id="rate-slider" name="rate" min="1" max="5" step="0.5"
                        value="3" required>
                    <span id="rating-value">3</span> / 5 <span class="stars">&#9733;</span>
                </div>
                <div class="comment-box">
                <textarea name="comment" placeholder="Leave a comment..." rows="4" required></textarea>
                <button type="submit" class="submit-comment">Submit Review</button>
                </div>
            </form>



        <div class="comment-list">
            @if ($course->reviews->isEmpty())
                <h3>No reviews available</h3>
            @else
                @foreach ($course->reviews as $review)
                    <div id="review-{{ $review->id }}" class="comment" style="position: relative;">
                        <p style="float:right; cursor: pointer; display: inline;"
                            onclick="toggleEditDeleteForm({{ $review->id }})">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </p>
                        <div class="review-header">
                            @if ($review->user)
        <!-- Check if user has a profile picture -->
        @if ($review->user->profile_photo_path)
            <img src="{{ asset('storage/' . $review->user->profile_photo_path) }}" alt="User Image" class="user-image">
        @else
            <img src="{{ asset('/img/icon/default_prof_img.jpg') }}" alt="Default User Image" class="user-image">
        @endif

        <div class="review-details">
            <p class="user-name">
                {{ $review->user->name }}
            </p>
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
            <span class="review_date">
                {{ $review->created_at->diffForHumans() }}
            </span>
        </div>
    @else
        <!-- Default user image and unknown name if no user is associated with the review -->
        <img src="{{ asset('/img/icon/default_prof_img.jpg') }}" alt="Default User Image" class="user-image">
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

                        <div class="review-content-{{ $review->id }}" >
                            <p >{{ $review->comment }}</p>
                        </div>

                        @auth
                            @if ($review->user_id == Auth::user()->id)
                                <div id="edit-delete-form-{{ $review->id }}"
                                    style="display: none; position: absolute; top: -80px; right: 0; background: white; border: 1px solid #ccc; padding: 5px; z-index: 10;">
                                    <form action="{{ route('delete_review', $review->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style="color: red; background-color: unset; border: none; cursor: pointer;" onclick="deleteReview({{ $review->id }})">Delete</button>
                                    </form>
                                    <button style="background-color: unset; border: none; cursor: pointer; color: blue;"
                                        onclick="editReview({{ $review->id }})">Edit</button>
                                </div>
                            @endif
                        @endauth
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
            @endif
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function toggleEditDeleteForm(reviewId) {
                const form = document.getElementById(`edit-delete-form-${reviewId}`);
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }

            // function confirmDelete() {
            //     return confirm('Are you sure you want to delete this review?');
            // }

            function editReview(reviewId) {
                document.getElementById(`review-content-${reviewId}`).style.display = 'none';
                document.getElementById(`edit-review-form-${reviewId}`).style.display = 'block';
            }

            function confirmUpdate(reviewId) {
                return confirm('Are you sure you want to update this review?');
            }

            function cancelEdit(reviewId) {
                document.getElementById(`review-content-${reviewId}`).style.display = 'block';
                document.getElementById(`edit-review-form-${reviewId}`).style.display = 'none';
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

    <div class="sidebar">
        <div class="sidebar-logo">
            <p style="color: white">
                <strong>{{$course->title}}</strong>
            </p>
        </div>
        <ul>
            @php
            $sectionCounter=1;
            @endphp
            @foreach($sections as $section)
            <li class="section">
                <div class="section-header">
                    <span><i class="fas fa-folder"></i> Section {{$loop->iteration}}: {{$section->title}}</span>
                    <span>+</span>
                </div>
                <div class="section-content">
                    @if(isset($videos[$section->id]) && count($videos[$section->id]) > 0)
                        @foreach($videos[$section->id] as $video)
                           <a data-video-url="{{ asset('storage/' . $video->path) }}" data-video-id="{{ $video->id }}" class="video-link" style="color: white">Video {{ $loop->iteration }} </a>
                        @endforeach
                    @endif
                        @foreach($quizzes as $quiz)
                            @if($quiz->section_no==$sectionCounter)
                             <a href="{{route('quiz',$quiz->id)}}">Quiz {{$loop->iteration}}</a>
                            @endif
                        @endforeach
                </div>
            </li>
                @php
                $sectionCounter++;
                @endphp
            @endforeach

        </ul>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // script.js
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Handle collapsing and expanding sections
    document.querySelectorAll('.section-title').forEach(function(sectionTitle) {
        sectionTitle.addEventListener('click', function() {
            const sectionId = this.getAttribute('data-section');
            const videoList = document.getElementById(sectionId);

            // Toggle the visibility of the video list
            if (videoList.style.display === 'none' || videoList.style.display === '') {
                videoList.style.display = 'block';  // Show
            } else {
                videoList.style.display = 'none';  // Hide
            }
        });
    });

    // Sample dynamic function to handle video click events
    document.querySelectorAll('.video-list li a').forEach(function(videoLink) {
        videoLink.addEventListener('click', function(e) {
            e.preventDefault();
            const videoSrc = '';
            document.getElementById('course-video').src = videoSrc;
        });
    });

    document.querySelectorAll('.section-header').forEach(header => {
        header.addEventListener('click', () => {
            const section = header.parentElement;
            section.classList.toggle('active');
        });
    });

    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }


    // Course Progress
    var videoPlayer = document.getElementById('course-video');

    videoPlayer.addEventListener('ended', function() {
        // Mark the video as completed by sending an AJAX request
        // Add CSRF token for all Axios requests
        console.log('Video ended, sending data to the server...');

        let url = window.location.pathname;
        let videoId = url.substring(url.lastIndexOf('/') + 1);

        axios.post('{{route('course_progress',$course->id)}}', {
            course_id: '{{ $course->id }}',
            video_id: videoId,
        }).then(function(response) {
            alert('Video marked as completed');
        }).catch(function(error) {
            console.error('Error marking video:', error);
        });
    });






    document.querySelectorAll('.video-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();  // لمنع التحديث الكامل للصفحة

            var videoUrl = this.getAttribute('data-video-url'); // الحصول على رابط الفيديو من data attribute
            var videoId = this.getAttribute('data-video-id');   // الحصول على ID الفيديو

            // تحديث الفيديو المعروض
            var videoPlayer = document.getElementById('course-video');
            var videoSource = document.getElementById('video-source');
            videoSource.src = videoUrl;           // تغيير الـ URL للفيديو
            videoSource.setAttribute('data-id', videoId);  // تعيين الـ data-id لمعرفة الفيديو الحالي

            videoPlayer.load();  // إعادة تحميل الفيديو لعرض الفيديو الجديد

            // تحديث الـ URL في شريط العناوين دون إعادة تحميل الصفحة
            window.history.pushState({}, '', '/course_videos/{{$course->id}}/' + videoId);
        });
    });





</script>
{{----------------------------submit no refresh------------------------------------------}}
<script>
    function generateStars(rate) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(rate)) {
                stars += '<i class="fas fa-star"></i>';
            } else if (i === Math.ceil(rate) && (rate % 1) === 0.5) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            } else {
                stars += '<i class="far fa-star"></i>';
            }
        }
        return stars;
    }

    $(document).ready(function() {
        // Handle review submission
        $('.review-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = $(this).serialize(); // Serialize the form data
            let actionUrl = $(this).attr('action'); // Get the form action URL

            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Add the new review to the comment list dynamically
                        $('.comment-list').prepend(`
                        <div class="comment">
                            <div class="review-header">
                                <!-- Display user profile photo -->
                                <img src="${response.review.user_image}" alt="User Image" class="user-image" />

                                <div class="review-details">
                                    <p class="user-name">${response.review.user}</p>
                                    <div class="stars">${generateStars(response.review.rate)}</div>
                                    <span class="review_date">${response.review.created_at}</span>
                                </div>

                                <!-- Three-dot menu for edit and delete -->
                                <p class="options" style="float:right; cursor: pointer; display: inline;" onclick="toggleEditDeleteForm(${response.review.id})">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </p>
                                <div id="edit-delete-form-${response.review.id}" style="display: none; position: absolute; top: -80px; right: 0; background: white; border: 1px solid #ccc; padding: 5px; z-index: 10;">
                                    <form action="/delete-review/${response.review.id}" method="POST" onsubmit="return deleteReview()">
                                        @csrf
                        @method('DELETE')
                        <button style="color: red; background-color: unset; border: none; cursor: pointer;">Delete</button>
                    </form>
                    <button style="background-color: unset; border: none; cursor: pointer; color: blue;" onclick="editReview(${response.review.id})">Edit</button>
                                </div>
                            </div>

                            <div class="review-content">
                                <p>${response.review.comment}</p>
                            </div>
                        </div>
                    `);
                        // Clear the form after submission
                        $('.review-form')[0].reset();
                    }
                },
                error: function() {
                    alert('Failed to submit review.');
                }
            });
        });
    });


    function deleteReview(reviewId) {
        if (confirm('Are you sure you want to delete this review?')) {
            $.ajax({
                url: '/delete-review/' + reviewId,  // The URL to send the request
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",  // Include CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the review from the page
                        $('#review-' + reviewId).remove();
                        alert(response.message);
                    } else {
                        alert('Failed to delete the review.');
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    }

    function editReview(reviewId) {
        $(`#edit-review-form-${reviewId}`).show();
        $(`#review-content-${reviewId}`).hide();
    }

    function cancelEdit(reviewId) {
        $(`#edit-review-form-${reviewId}`).hide();
        $(`#review-content-${reviewId}`).show();
    }

    function confirmUpdate(reviewId) {
        let formData = $(`#edit-review-form-${reviewId}`).find('form').serialize();
        let actionUrl = $(`#edit-review-form-${reviewId}`).find('form').attr('action');

        $.ajax({
            type: 'PUT',
            url: actionUrl,
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Update the review content dynamically
                    $(`#review-content-${reviewId}`).html(response.review.comment);
                    $(`#edit-review-form-${reviewId}`).hide();
                    $(`#review-content-${reviewId}`).show();
                }
            },
            error: function() {
                alert('Failed to update review.');
            }
        });

        return false; // Prevent form submission
    }

</script>

@endsection
