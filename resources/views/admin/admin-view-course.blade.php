@extends('admin.layouts.dash')

@section('Courses')
    active
@endsection

@section('activity-title')
    Courses
@endsection

@section('content')
@php
    // Define the variable to hide the div in the layout
    $hideSpecialDiv = true;
@endphp
<style>
    .course-image {
    position: relative;
    overflow: hidden; /* لمنع تجاوز الصورة */
    border-radius: 10px; /* لتدوير زوايا الصورة */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* لإضافة ظل للصورة */
    height: 450px; /* ضبط ارتفاع القسم */
    width: 70%;
    margin: auto;
    border-radius: 50px;
    display: flex; /* استخدام flex لتوسيع الصورة */
    justify-content: center; /* لمركزة الصورة داخل القسم */
    align-items: center; /* لمركزة الصورة عمودياً */
}

.course-image img {
    height: 100%; /* جعل ارتفاع الصورة لا يتجاوز ارتفاع القسم */
    width: 100%; /* جعل عرض الصورة لا يتجاوز عرض القسم */
    border-radius: 50%;
    object-fit: cover; /* لتغطية القسم بشكل جيد دون تشويه الصورة */
    transition: transform 0.3s ease; /* لتفعيل تأثير التحول عند التحويم */
}

.course-image img:hover {
    transform: scale(1.01); /* تكبير الصورة عند التحويم */
}

.course-details {
    padding: 20px; /* مساحة داخلية للقسم */
    background-color: #31353b; /* لون خلفية خفيف */
    border-radius: 8px; /* زوايا دائرية للقسم */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* ظل خفيف للقسم */
}

.course-section {
    border: 1px solid #e9ecef; /* حدود خفيفة حول الأقسام */
    transition: transform 0.3s ease; /* تأثير التحول عند التحويم */
    /* background-color: #31353b; */
}

.course-section:hover {
    transform: scale(1.01); /* تكبير القسم عند التحويم */
}

.video-card {
    border-radius: 5px; /* زوايا دائرية لبطاقات الفيديو */
    overflow: hidden; /* لمنع تجاوز الفيديو */
    /* background-color: #31353b; */
}

.btn-link {
    font-size: 1.1rem; /* حجم خط أكبر للأزرار */
}

.btn {
    min-width: 120px; /* عرض ثابت للأزرار */
}

.text-primary {
    color: #007bff; /* لون رئيسي للأقسام */
}

.list-group-item{
    background-color: #31353b;
    color: rgb(212, 212, 212);
}


</style>
<div class="container mt-5">
    <div class="course-container border rounded shadow-sm p-4 bg-dark">
        <!-- Course Header -->
        <div class="course-header text-center mb-4">
            <h1 class="display-4">{{ $course->title }}</h1>
            <p class="course-price h5 text-success">{{ $course->price }} EGP</p>
        </div>

        <!-- Course Image -->
        <div class="course-image text-center mb-4">
            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="img-fluid rounded shadow">
        </div>


        <!-- Course Details -->
        <div class="course-details">
            <!-- Description -->
            <div class="course-section mb-3 p-3  rounded shadow-sm">
                <h3 class="h4">Description</h3>
                <p class="course-description">{{ $course->description }}</p>
            </div>

            <!-- Objectives -->
            <div class="course-section mb-3 p-3  rounded shadow-sm">
                <h3 class="h4">Objectives</h3>
                <p class="course-description">{{ $course->objectives }}</p>
            </div>

            <!-- Category -->
            <div class="course-section mb-3 p-3  rounded shadow-sm">
                <h3 class="h4">Category</h3>
                <p class="course-category">{{ $category->name }}</p>
            </div>

            <!-- Sections -->
            <div class="course-section mb-3 p-3  rounded shadow-sm">
                <h3 class="h4">Course Sections</h3>
                <ul class="list-group">
                    @foreach($sections as $section)
                        <li class="list-group-item">
                            <button class="btn btn-link toggle-section" style="color: rgb(190, 190, 190)" data-target="section-{{ $loop->iteration }}">
                                <strong>Section {{ $loop->iteration }}:</strong> {{ $section->title }}
                                <span class="toggle-icon">[+]</span>
                            </button>
                            <div class="video-container mt-2 collapse" id="section-{{ $loop->iteration }}">
                                @foreach($section->videos as $video)
                                    <div class="video-card mb-2" style="background-color: #31353b">
                                        <video controls class="w-100">
                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Section Videos -->
{{--            <div class="course-section">--}}
{{--                <h3>Videos</h3>--}}
{{--                <div class="video-container">--}}

{{--                </div>--}}
{{--            </div>--}}
            <div class="course-section" style="border: none">
                @if($course->is_accepted==0)
                <a href="{{ route('courses.accept', $course->id) }}" class="btn-accept" >Accept</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ route('courses.decline', $course->id) }}" class="btn">Decline</a>
                @elseif($course->is_accepted==1)
                    <a href="{{ route('admin.view.decline', $course->id) }}" class="btn-decline">Decline</a>
                @else
                    <a href="{{ route('courses.accept', $course->id) }}" class="btn btn-success">Accept</a>
                @endif
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select all toggle buttons
        const toggleButtons = document.querySelectorAll('.toggle-section');

        toggleButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the target section to toggle
                const targetId = button.getAttribute('data-target');
                const sectionContent = document.getElementById(targetId);

                // Toggle the 'collapse' class
                sectionContent.classList.toggle('collapse');

                // Toggle the icon
                const icon = button.querySelector('.toggle-icon');
                icon.textContent = sectionContent.classList.contains('collapse') ? '[+]' : '[-]';
            });
        });
    });
</script>

@endsection
