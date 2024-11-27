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
                                <h1 data-animation="bounceIn" data-delay="0.2s">Your Cart</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{route('view.cart')}}">Cart</a></li>
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


    <div class="cart-page">
        <br><br>
        <div class="cart-container1">
            @if($cartItems->isEmpty())
                <center>
                    <h2 style="font-size: 2.4rem">No Items Found</h2>
                    <img src="{{asset('/img/no.png')}}" alt="" width="600px" height="600px">
                </center>
            @else
                <!-- Cart Item -->
                @php
                    $totalPrice=0;
                    $numOfItems=0;
                @endphp
                @foreach($cartItems as $cartItem)
                    <div class="cart-item1" id="cart-item1-{{ $cartItem->course->id }}">
                        <img src="{{ asset('storage/' . $cartItem->course->image) }}" alt="{{ $cartItem->course->title }}" class="course-thumbnail1">
                        <div class="course-details1">
                            <h3 class="course-title1">{{$cartItem->course->title}}</h3>
                            <p class="course-instructor1">{{ $cartItem->course->description }}</p>
                            <p class="course-price1">${{ $cartItem->course->price }}</p>
                        </div>
                        <div class="cart-actions1">
                            <button class="remove-btn1" data-id="{{ $cartItem->id }}"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                    </div>
                    @php
                        $totalPrice += $cartItem->course->price;
                        $numOfItems++;
                    @endphp
                @endforeach
                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2>Summary</h2>
                    <div class="summary-details">
                        <p>Subtotal: <span id="sub-total">${{ $totalPrice }}</span></p>
                        <p>Discount: <span>$0.00</span></p>
                        <hr>
                        <p>Total: <span class="total-price" id="total-price">${{ $totalPrice }}</span></p>
                    </div>
                    <br>
                    @if($numOfItems > 1)
                        <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
                    @else
                        <a href="{{ route('view.enroll.course', $cartItem->course->id) }}" class="checkout-btn">Proceed to Checkout</a>
                    @endif
                    <br>
                </div>
            @endif
            <br>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.remove-btn1', function() {
            const itemId = $(this).data('id');
            const cartItemDiv = $(this).closest('.cart-item1'); // Get the cart item div

            if (confirm('Are you sure you want to remove this item from your cart?')) {
                $.ajax({
                    url: `/cart/remove/${itemId}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove the cart item from the DOM
                            cartItemDiv.remove();

                            // Update total price
                            updateTotalPrice();

                            alert('Item removed successfully!');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while removing the item from your cart: ' + error);
                    }
                });
            }
        });

        function updateTotalPrice() {
            let totalPrice = 0;
            $('.cart-item1').each(function() {
                const itemPrice = parseFloat($(this).find('.course-price1').text().replace('$', ''));
                totalPrice += itemPrice;
            });

            $('#total-price').text(`$${totalPrice.toFixed(2)}`);
            $('#sub-total').text(`$${totalPrice.toFixed(2)}`);
        }
    </script>

@endsection
