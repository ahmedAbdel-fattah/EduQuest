<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    {{-- <x-app-layout> --}}
    <div class="dashboard-container">
        <!-- Sidebar -->
        <style>
            /* نمط الشريط الجانبي عند الوضع الطبيعي */
            .sidebar {
                max-width: 200px;
                position: relative;
                top: 0;
                left: 0;
                background-color: #2d3035;
                transition: width 0.3s ease;
                /* التغيير في العرض يكون سلسًا */
            }

            /* نمط الشريط الجانبي عند الطي */
            .sidebar.collapsed {
                width: 60px;
                /* العرض فقط لعرض الأيقونات */
            }

            .sidebar ul {
                list-style-type: none;
                padding: 0;
                margin-top: 5px;
                margin-left: -10px;
            }

            .sidebar ul li {
                /* padding: 15px 20px; */
            }

            /* إخفاء النص عند طي الشريط الجانبي */
            .sidebar.collapsed ul li a span {
                display: none;
            }

            .sidebar ul li a {
                color: rgb(156, 156, 156);
                display: flex;
                align-items: center;
                text-decoration: none;
                font-size: 14px;
            }

            .sidebar ul li a i {
                margin-right: 10px;
            }

            /* المحتوى الرئيسي */
            .content {
                margin-left: 250px;
                /* يترك مساحة للشريط الجانبي */
                padding: 20px;
                transition: margin-left 0.3s ease;
                /* حركة سلسة عند الطي */
            }

            .sidebar.no-transition {
                transition: none;
                /* منع الحركة */
            }

            /* تكبير المحتوى عند طي الشريط الجانبي */
            .content.collapsed {
                margin-left: 80px;
                /* مساحة أقل للشريط الجانبي المصغر */
            }

            /* إخفاء الشعار وكلمة EduAdmin عند الطي */
            .sidebar.collapsed .sidebar-header h2,
            .sidebar.collapsed .in-photo {
                display: none;
            }

            .sidebar.collapsed .photo img {
                width: 40px;
                height: 40px;
                margin-left: -10px;
            }

            .sidebar.collapsed .sidebar ul li a i {
                margin-right: 0;
            }

            .sidebar .photo {
                text-align: center;
                z-index: 2;
                max-height: 120px;
                border-bottom: 1px solid #808080;
            }

            .sidebar .photo img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                cursor: pointer;
                transition-duration: 1s;


            }

            .sidebar .photo img:hover {
                opacity: 30%;
                scale: 1.2;
                z-index: -1;
            }

            .in-photo {
                /* display: none; */
                text-align: center;
                color: rgb(220, 220, 220);
                font-size: 13px;
                font-weight: 500;
                position: relative;
                bottom: 70px;

                z-index: -1;

            }

            #toggleSidebar {
                background-color: unset;
                color: white;
                text-align: center;
                padding: 5px;
                margin-top: 20px;
            }
        </style>

        <div class="sidebar" id="sidebar-menu">
            <div class="sidebar-header">
                <h2 id="head-content">EduAdmin</h2>
            </div>
            <div class="photo" id="photo">
                <a href="{{ route('myProfile', $user_data->id) }}">
                    <img src="{{ asset('storage/' . $user_data->profile_photo_path) }}" alt="{{ $user_data->name }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="view your profile">
                </a>
                <div class="in-photo">

                    <span></span>
                    <p></p>
                </div>
            </div>


            <button onclick="toggleSidebar()" id="toggleSidebar"><i class="fas fa-bars"></i></button>

            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}" class="@yield('dashboard')"><i
                            class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('pending-courses') }}" class="@yield('Courses')"><i
                            class="fas fa-book"></i><span>Courses</span></a></li>
                <li><a href="{{ route('users.index') }}" class="@yield('users')"><i
                            class="fas fa-users"></i><span>Users</span></a></li>
                <li><a href="{{ route('categories_table') }}" class="@yield('categories')"><i
                            class="fas fa-th-list"></i><span>Categories</span></a></li>
                <li><a href="{{ route('show.developers') }}" class="@yield('Developers')"><i
                            class="fas fa-solid fa-code"></i><span>Developers</a></li></span>

                <li><a href="{{ route('adVideo-controll') }}" class="@yield('adVideo')"><i
                            class="fas fa-video"></i><span>Ad Vedio</a></li></span>

                <li><a href="{{ route('faqs.index') }}" class="@yield('faqs')"><i
                            class="fas fa-question-circle"></i><span>FAQs</span></a></li>
                <li><a href="{{ route('settings.index') }}" class="@yield('settings')"><i
                            class="fas fa-cog"></i><span>Settings</span></a></li>
                <li><a href="{{ route('instructor-questions.index') }}" class="@yield('instructor-questions')"><i
                            class="fas fa-question"></i><span>Instructor Questions</span></a></li>
                <li><a href="{{ route('home') }}" class="@yield('home')"><i
                            class="fas fa-home"></i><span>website</span></a></li>
            </ul>
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/hero/logo.png') }}" alt="" style="width: 70%; margin-left: 15%;">
            </a>
        </div>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const sidebar = document.getElementById('sidebar-menu');
                const toggleButton = document.getElementById('toggleSidebar');

                // منع الحركة في البداية
                sidebar.classList.add('no-transition');

                // تحقق من حالة الـ sidebar من localStorage
                if (localStorage.getItem('sidebar-collapsed') === 'true') {
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                }

                // إزالة no-transition بعد تحميل الصفحة
                setTimeout(() => {
                    sidebar.classList.remove('no-transition');
                }, 100); // بعد 100ms مثلاً (يمكنك تعديل الزمن حسب الحاجة)

                // تغيير حالة الطي عند النقر على الزر
                toggleButton.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    localStorage.setItem('sidebar-collapsed', isCollapsed);
                });
            });
        </script>





        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <h1>{{ $user_data->name }} Dashboard</h1>
                <div class="profile">
                    <span>Welcome, {{ $user_data->name }}</span>
                    {{-- <img src="profile.jpg" alt="Profile Picture"> --}}
                </div>
            </div>

            @if (!isset($hideSpecialDiv) || !$hideSpecialDiv)
                <!-- Dashboard Overview -->
                <div class="dashboard-overview">
                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-folder-open"></i>
                                <h3>Categories</h3>
                            </div>
                            <div class="number">
                                <p class="purple">{{ $categories_count }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress purple-bar" style="width: {{ $categories_count }}%;"></div>
                        </div>
                    </div>

                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-book"></i>
                                <h3>Courses</h3>
                            </div>
                            <div class="number">
                                <p class="pink">{{ $courses_count }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress pink-bar" style="width: {{ $courses_count }}%;"></div>
                        </div>
                    </div>

                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-user-graduate"></i>
                                <h3>Students</h3>
                            </div>
                            <div class="number">
                                <p class="orange">{{ $users->where('is_instructor', 0)->count() }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress orange-bar"
                                style="width: {{ $users->where('is_instructor', 0)->count() }}%;"></div>
                        </div>
                    </div>

                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <h3>Instructors</h3>
                            </div>
                            <div class="number">
                                <p class="dark-purple">{{ $users->where('is_instructor', 1)->count() }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress dark-purple-bar"
                                style="width: {{ $users->where('is_instructor', 1)->count() }}%;"></div>
                        </div>
                    </div>

                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-chart-line"></i>
                                <h3>Enrollments</h3>
                            </div>
                            <div class="number">
                                <p class="orange">{{ $enrollments_count }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress orange-bar" style="width: {{ $enrollments_count }}%;"></div>
                        </div>
                    </div>

                    <div class="overview-box gray">
                        <div class="box-content">
                            <div class="text-content">
                                <i class="fas fa-comments"></i>
                                <h3>Feedbacks</h3>
                            </div>
                            <div class="number">
                                <p class="pink">{{ $feedbacks_count }}</p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress pink-bar" style="width: {{ $feedbacks_count }}%;"></div>
                        </div>
                    </div>
                </div>







                <style>
                    /* تنسيق العنوان */
                    h2 {
                        text-align: center;
                        margin-bottom: 30px;
                        color: white;
                        font-size: 24px;
                    }

                    /* الحاوية الرئيسية التي تضم الأعمدة */
                    .chart-container {
                        display: flex;
                        justify-content: space-around;
                        align-items: flex-end;
                        width: 100%;
                        height: 400px;
                        background-color: #2d3035;
                        padding: 20px;
                        position: relative;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        border-radius: 10px;
                    }

                    /* الأعمدة التي تمثل كل يوم */
                </style>




                <div class="charts">
                    <div class="chart-container">
                        <canvas id="studentPerformanceChart"></canvas>
                        <h2>Student Performance</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="courseCompletionChart"></canvas>
                        <h2>Course Completion Rate</h2>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx2 = document.getElementById('courseCompletionChart').getContext('2d');
                    const courseCompletionChart = new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: ['Instructor', 'student', 'mezo'],
                            datasets: [{
                                label: 'Course Completion Rate',
                                data: [{{ $users->where('is_instructor', 0)->count() }},
                                    {{ $users->where('is_instructor', 1)->count() }},
                                    5,
                                ],
                                backgroundColor: ['#6200EA', '#ff9f67', 'green'],
                                borderColor: ['#6200EA', '#ff9f67', 'green'],
                                borderWidth: 1,
                            }]
                        },
                        options: {
                            responsive: true,
                        }
                    });


                    //    2

                    const ctx1 = document.getElementById('studentPerformanceChart').getContext('2d');

                    // تحويل الـ userCounts و newUserCounts من PHP إلى JavaScript
                    const userCounts = @json($userCounts);
                    const newUserCounts = @json($newUserCounts);

                    // استخراج التواريخ والأعداد من الـ userCounts
                    const labels = Object.keys(userCounts); // التواريخ
                    const loginData = Object.values(userCounts); // الأعداد الخاصة بتسجيل الدخول
                    const registrationData = Object.values(newUserCounts); // الأعداد الخاصة بالتسجيلات الجديدة

                    const maxValue = Math.max(...loginData, ...registrationData);
                    const adjustedMax = maxValue + 10;

                    const studentPerformanceChart = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: labels, // وضع التواريخ كـ labels
                            datasets: [{
                                    label: 'Number of Logins',
                                    data: loginData, // وضع الأعداد الخاصة بتسجيل الدخول
                                    backgroundColor: '#864ad8',
                                    borderColor: '#6200EA',
                                    borderWidth: 1,
                                    barThickness: 30, // يمكنك تعديل سماكة الأعمدة
                                    barBorderRadius: 3,
                                },
                                {
                                    label: 'New Registrations',
                                    data: registrationData, // بيانات التسجيل الجديدة
                                    backgroundColor: '#28a745', // لون مميز
                                    borderColor: '#218838', // لون الحدود
                                    borderWidth: 1,
                                    barThickness: 30, // سماكة أعمدة التسجيل الجديدة أقل
                                    barBorderRadius: 3,
                                    type: 'bar', // التأكيد على أن هذه البيانات هي بيانات Bar
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true, // يبدأ من الصفر
                                    max: adjustedMax, // الحد الأقصى هو 20
                                    stepSize: 1, // التأكد من أن الأرقام صحيحة (بدون كسور)
                                    ticks: {
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : null; // عرض الأرقام الصحيحة فقط
                                        }
                                    }
                                }
                            }
                        }

                    });
                </script>
            @endif
            <div class="recent-activity">
                <h2>@yield('activity-title')</h2>
                @yield('content')
            </div>
        </div>


    </div>

    <!-- Main Content -->


    <style>
        .charts {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            margin: 40px 0;
        }

        .chart-container {
            flex: 1;
            /* background-color: #f9f9f9; */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            justify-content: space-evenly;
            display: flex;
            flex-wrap: wrap;
        }

        .chart-container canvas {
            width: 100%;
            max-width: 500px;
            max-height: 300px;
            margin-bottom: 15px;
            /* مسافة بين الرسم والنص */
        }

        .chart-container h4 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        @media (max-width: 768px) {
            .charts {
                flex-direction: column;
                gap: 30px;
            }

            .chart-container canvas {
                width: 60%;

            }
        }
    </style>





    {{-- </x-app-layout> --}}


    {{-- ============ display the uploaded img to user before save it ======== --}}
    <script>
        // استهداف المدخل وحاوية الصورة
        // استهداف المدخل، حاوية الصورة وزر إعادة التعيين
        var fileInput = document.getElementById('file-upload');
        var previewImg = document.getElementById('preview-img');
        var resetBtn = document.getElementById('reset-btn');

        // عندما يختار الأدمن صورة
        fileInput.addEventListener('change', function() {
            var file = this.files[0];

            // التأكد من اختيار صورة
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // عرض الصورة المختارة في الحاوية
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = 'none'; // إخفاء الصورة إذا لم يتم اختيار ملف
            }
        });

        // عند الضغط على زر إعادة التعيين
        resetBtn.addEventListener('click', function() {
            // إعادة تعيين حقل الإدخال
            fileInput.value = null;

            // إخفاء الصورة
            previewImg.style.display = 'none';
        });
    </script>

    {{-- ============ users filtr =============== --}}
    <script>
        // وظيفة لتصفية الجدول بناءً على الفلتر المختار
        function filterTable() {
            var filter = document.getElementById("filter").value.toLowerCase(); // قراءة الفلتر المحدد
            var rows = document.querySelectorAll("#userTable tbody tr"); // التأكد من أننا نحدد الصفوف فقط

            // تخزين الفلتر المحدد في localStorage
            localStorage.setItem('selected-filter', filter);

            // تصفية الصفوف بناءً على الفلتر
            rows.forEach(function(row) {
                var role = row.getAttribute("data-role").toLowerCase(); // استخراج الدور من البيانات

                // الفلتر لجميع المستخدمين
                if (filter === "all") {
                    row.style.display = ""; // عرض جميع الصفوف
                }
                // فلترة بناءً على الدور
                else if (filter === "students" && role === "student") {
                    row.style.display = ""; // عرض الصفوف التي تحتوي على الطالب
                } else if (filter === "instructors" && role === "instructor") {
                    row.style.display = ""; // عرض الصفوف التي تحتوي على المدرس
                } else if (filter === "admins" && role === "admin") {
                    row.style.display = ""; // عرض الصفوف التي تحتوي على المشرف
                } else {
                    row.style.display = "none"; // إخفاء الصفوف التي لا تحتوي على الدور المحدد
                }
            });
        }

        // عند تحميل الصفحة، استرجاع الفلتر المخزن وتطبيقه
        window.onload = function() {
            var storedFilter = localStorage.getItem('selected-filter'); // استرجاع الفلتر المخزن
            if (storedFilter) {
                // تعيين قيمة الفلتر في العنصر <select>
                document.getElementById('filter').value = storedFilter;

                // تصفية الجدول باستخدام الفلتر المخزن
                filterTable();
            }
        };

        // إضافة حدث عند تغيير الفلتر
        document.getElementById('filter').addEventListener('change', filterTable);
    </script>


    {{-- ======== end user filter  !!============ --}}


    {{-- ================= toolpit  (عرض رسالة توضيحية عند الوقوف على زر) ======= --}}
    <script>
        // تفعيل الـ tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>


    {{-- -------------------------------------------------------------------------- --}}
</body>

</html>
