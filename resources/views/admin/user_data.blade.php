@extends('admin.layouts.dash')
@section('user_data')
    active
@endsection

@if (session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@section('content')
    @php
        // Define the variable to hide the div in the layout
        $hideSpecialDiv = true;
    @endphp


    <style>
        /* Resetting margin and padding for a clean look */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }



        /* Section Styling */
        .user-info-section {
            background-color: #31353b;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        .user-info-section h2 {
            color: #868686;
            margin-bottom: 20px;
        }

        /* Card styling */
        .user-card {
            background-color: #22252a;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #797979;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .user-card .user-details {
            text-align: left;
        }

        .user-card h3 {
            margin-top: 15px;
            font-weight: 800;
            color: #8d1fb5;
            /* لون مميز للاسم */
        }

        .user-card p , .user-details a {
            margin: 10px 0;
            color: #727272;
        }

        .user-card p strong {
            color: #a7a4a4;
        }

        .green-500 {
            background-color: #03df5f;
            /* لون أخضر */
            color: white;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .red-500 {
            background-color: #ff0000;
            /* لون أحمر */
            color: white;
            padding: 5px 10px;
            border-radius: 25px;
        }

        .gray-500 {
            background-color: #a0aec0;
            /* لون رمادي */
            color: white;
            padding: 5px 10px;
            border-radius: 25px;
        }

        /* الصورة الأساسية */
        .immg img {
            position: relative;
            display: block;
            border-radius: 50%;
        }

        /* دائرة الحالة */
        .status-indicator {
            position: absolute;
            bottom: 10px;
            /* المسافة من أسفل الصورة */
            right: 10px;
            /* المسافة من يمين الصورة */
            width: 15px;
            height: 15px;
            border-radius: 50%;
            border: 2px solid white;
            /* لإضافة حدود بيضاء حول الدائرة */
        }

        /* الألوان للحالات المختلفة */
        .status-indicator.Online {
            background-color: #48bb78;
            /* أخضر للحالة النشطة */
        }

        .status-indicator.Offline {
            background-color: #f56565;
            /* أحمر للحالة الخاملة */
        }

        .status-indicator.unknown {
            background-color: #a0aec0;
            /* رمادي للحالة غير المعروفة */
        }

        /* النص تحت الصورة */
        .immg .sa {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
    <div class="container">
        {{-- <h1 class="table-title"></h1> --}}

        <section class="user-info-section">
            <h2>User Details</h2>
            <div class="immg" style="position: relative; width: 30%; margin: auto;">
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                    style="width: 100%; max-height:100px; margin-bottom:5px; border-radius:50%;" alt="">

                <!-- دائرة الحالة -->
                @php
                    // حساب حالة المستخدم
                    if ($user->last_seen !== null) {
                        $diffInMinutes = Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($user->last_seen));
                        $status = $diffInMinutes <= 2 ? 'Online' : 'Offline';
                    } else {
                        $status = 'unknown'; // إذا كانت last_seen غير معروفة
                    }
                @endphp

                <!-- دائرة تمثل حالة المستخدم -->
                <span class="status-indicator {{ $status }}"></span>

                {{-- <p class="sa">{{ $status === 'active' ? 'نشط' : ($status === 'idle' ? 'خامل' : 'غير معروف') }}</p> --}}
            </div>

            <div class="user-card">
                <div class="user-details">
                    <h3>Personal Information</h3>
                    <p><strong>Name : </strong> {{ $user->name }}</p>
                    <p><strong>Email : </strong><a href="mailto:{{$user->email}}">{{ $user->email }}</a></p>
                    <p><strong>Phone : </strong> {{ $user->phone }}</p>
                    <p><strong>Address : </strong>{{ $user->address }}</p>

                    <h3>Account Details</h3>

                    @if ($user->is_admin == 1)
                        <p><strong>Role : </strong>admin</p>
                    @elseif($user->is_instructor == 1)
                        <p><strong>Role : </strong>instructor</p>
                    @else
                        <p><strong>Role : </strong>student</p>
                    @endif



                    <p><strong>Registration Date :</strong>{{ $user->created_at }}</p>

                    <p><strong>Last seen :</strong>
                        @php
                            // التحقق إذا كانت قيمة last_seen غير null
                            if ($user->last_seen !== null) {
                                // حساب الفرق بين الوقت الحالي ووقت آخر ظهور
                                // $diffInMinutes = Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($user->last_seen));

                                // تحديد الحالة بناءً على الفرق
                                // $status = $diffInMinutes <= 2 ? 'Online' : 'Offline';
                                $statusColor = $diffInMinutes <= 2 ? 'green-500' : 'red-500';
                            } else {
                                // إذا كانت last_seen تساوي null
                                $status = 'Status Unavailable'; // أو أي نص آخر تفضله
                                $statusColor = 'gray-500'; // لون رمادي للحالة غير المتاحة
                            }
                        @endphp

                        <!-- عرض الفرق في الوقت إن وجدت last_seen -->
                        @if ($user->last_seen !== null)
                            {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </p>
                    <p><strong>Account Status : </strong> <!-- عرض الحالة مع لون مختلف لكل حالة -->
                        <span class="bg-2 {{ $statusColor }}">
                            {{ $status }}
                        </span>
                    </p>
                    {{-- <p ><strong>Account Status:</strong> <span style="background-color: rgb(235, 26, 26); color:white; padding:5px; border-radius:20px;">Offline</span></p> --}}

                    <h3>Activity</h3>
                    <p><strong>Enrolled Courses :</strong>{{ $user_enroll }}</p>
                    <p><strong>Comments : </strong>{{ $user_reviews }}</p>
                    <p><strong>Average Rating : </strong> 4.8</p>
                </div>
            </div>
        </section>




    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to remove this user?');
        }
    </script>
@endsection
