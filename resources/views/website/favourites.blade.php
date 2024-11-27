@extends('website.layouts.app')
@section('content')


    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Your Favourite Courses</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('view.favourites')}}">Favourites</a></li>
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



    <div class="favorites-page">
        <br><br>
        @if($favouriteItems->isEmpty())
            <center>
                <h2 style="font-size: 2.4rem">No Items Found</h2>
                <img src="{{asset('/img/no.png')}}" alt="" width="600px" height="600px">
            </center>
        @else
        <div class="favorites-container">
            <!-- Favorite Course Item -->
            @foreach($favouriteItems as $item)
            <div class="favorite-item" id="fav-item-{{ $item->course->id }}">
                <img src="{{ asset('storage/' . $item->course->image) }}" alt="Course Thumbnail" class="course-thumbnail">
                <div class="course-details">
                    <h3 class="course-title">{{$item->course->title}}</h3>
                    <p class="course-price">${{$item->course->price}}</p>
                </div>
                <div class="favorite-actions">
                    <button class="remove-btn" id="remove" data-id="{{ $item->course->id }}">Remove</button>
                    <a href="{{route('view.enroll.course',$item->course->id)}}" class="enroll-btn">Enroll Now</a>
                    <button class="remove-btn" id="cart-btn" data-course-id="{{ $item->course->id }}"><i class="fas fa-shopping-cart"></i></button>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <br><br>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            // Add to cart action
            $('#cart-btn').click(function (e) {
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


        // -----------------------------------------------------
        $(document).on('click', '#remove', function() {
            const itemId = $(this).data('id');
            const favItemDiv = $(this).closest('.favorite-item'); // Get the cart item div

            if (confirm('Are you sure you want to remove this item from your cart?')) {
                $.ajax({
                    url: `/favourite/remove/${itemId}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove the cart item from the DOM
                            favItemDiv.remove();

                            alert('Item removed successfully!');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while removing the item from your favourites: ' + error);
                    }
                });
            }
        });

    </script>
@endsection
