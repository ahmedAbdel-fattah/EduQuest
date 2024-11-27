<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="/css/reviews.css">


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
<h2 @yield('h_1')>Student Reviews</h2>
<section class="student-reviews" id="student-reviews">

    {{-- @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}

    @auth
        @if ($instructor->user_id == $user_data->id)
            <h3 @yield('h_2')>Reviews</h3>
        @else
            <h3 @yield('h_2')>Rate the Course</h3>
            <form id="review-form" action="{{ route('sub_review', $course->id) }}" method="POST" class="review-form">
                @csrf
                <input type="hidden" name="instructor_id" value="{{ $instructor->id }}">
                <div class="slider-rating">
                    <input type="range" id="rate-slider" name="rate" min="1" max="5" step="0.5" value="3" required>
                    <span id="rating-value">3</span> / 5 <span class="stars"><i class="fas fa-star"></i></span>
                </div>
                <textarea name="comment" placeholder="Leave a comment..." rows="4" required></textarea>
                <button type="submit" class="submit-review">Submit Review</button>
            </form>
        @endif
    @endauth

    <div class="reviews">
        @if ($course->reviews->isEmpty())
            <h3>No reviews available</h3>
        @else
            @foreach ($course->reviews as $review)
                <div class="review" style="position: relative;">
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

                    <div id="review-{{ $review->id }}" class="review">
                        <!-- review content here -->
                    </div>

                    @auth
                        @if ($review->user_id == Auth::user()->id)
                            <div id="edit-delete-form-{{ $review->id }}"
                                style="display: none; position: absolute; top: -80px; right: 0; background: white; border: 1px solid #ccc; padding: 5px; z-index: 10;">
                                <form action="{{ route('delete_review', $review->id) }}" method="POST"
                                    onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        style="color: red; background-color: unset; border: none; cursor: pointer;">Delete</button>
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
    <div id="response-message" style="display: none;"></div>

    <script>
        function toggleEditDeleteForm(reviewId) {
            const form = document.getElementById(`edit-delete-form-${reviewId}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function confirmDelete() {
            return confirm('Are you sure you want to delete this review?');
        }

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

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to remove the comment?');
        }
    </script>
</section>
