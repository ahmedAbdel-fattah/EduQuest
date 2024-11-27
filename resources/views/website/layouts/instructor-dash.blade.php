<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Instructor Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/instructor-dashboard-style.css')}}">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Instructor Dashboard</h2>
    <ul>
        <li><a href="{{route('instructor-dashboard')}}" class="@yield('dashboard')">Dashboard</a></li>
        <li><a href="{{route('instructor-courses')}}" class="@yield('courses')">My Courses</a></li>
        <li><a href="{{route('instructor_add_course')}}" class="@yield('add-course')">Add Course</a></li>
        <li><a href="{{route('instructor-students')}}" class="@yield('students')">Students</a></li>
        <li><a href="{{route('myProfile')}}">Return to website</a></li>
    </ul>
</div>

@yield('content')


@yield('custom-js')
</body>
</html>
