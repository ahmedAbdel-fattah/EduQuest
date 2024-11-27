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
    <h1 class="table-title">Courses</h1>





{{--    --------------------------------------------------}}
    <div class="text-center">
        <a href="{{ route('accepted-courses') }}" class="btn-accept">Show Accepted Courses</a>
        <a href="{{ route('pending-courses') }}" class="btn-view">Show Pending Courses</a>
        <a href="{{ route('declined-courses') }}" class="btn-decline">Show Declined Courses</a>
    </div><br>
    <center>
        @if ($filter == 'accepted')
            <p style="color: Green">Showing: <strong>Accepted Courses</strong></p>
        @elseif ($filter == 'declined')
            <p style="color: red">Showing: <strong>Declined Courses</strong></p>
        @else
            <p style="color: rgb(104, 104, 232)">Showing: <strong>Pending Courses</strong></p>
        @endif
    </center><br>
    <div class="courses-container">
        <!-- Course 1 -->
        @if($filter == 'accepted')
            @foreach($accepted as $accept)
                <div class="course-card">
                    <div class="course-image">
                        <img src="{{asset('storage/'.$accept->image)}}" alt="Course 1">
                    </div>
                    <div class="course-content">
                        <h3 class="course-title">{{$accept->title}}</h3>
                        <p class="course-instructor"><span>Instructor : </span><a href="{{ route('dashboard.user_data', $accept->instructor->user->id) }}">{{$accept->instructor->user->name}}</a></p>
                        {{-- <p class="course-description">{{$accept->description}}</p> --}}
                        <p class="course-price">{{$accept->price}}</p>
                        <a href="{{ route('admin-view-course', $accept->id) }}" class="btn-view" >View</a>
                        <a href="{{ route('admin.view.decline', $accept->id) }}" class="btn-decline">Decline</a>
                    </div>
                </div>
            @endforeach
        @elseif($filter=='declined')
            @foreach($declined as $decline)
                <div class="course-card">
                    <div class="course-image">
                        <img src="{{asset('storage/'.$decline->image)}}" alt="Course 1">
                    </div>
                    <div class="course-content">
                        <h3 class="course-title">{{$decline->title}}</h3>
                        {{-- <p class="course-description">{{$decline->description}}</p> --}}
                        <p class="course-price">{{$decline->price}}</p>
                        <a href="{{ route('admin-view-course', $decline->id) }}" class="btn-view" >View</a>
                        <a href="{{ route('courses.accept', $decline->id) }}" class="btn-accept" >Accept</a>                    </div>
                </div>
            @endforeach
        @else
            @foreach($pending as $pend)
                <div class="course-card">
                    <div class="course-image">
                        <img src="{{asset('storage/'.$pend->image)}}" alt="Course 1">
                    </div>
                    <div class="course-content">
                        <h3 class="course-title">{{$pend->title}}</h3>
                        {{-- <p class="course-description">{{$pend->description}}</p> --}}
                        <p class="course-price">{{$pend->price}}</p>
                        <a href="{{ route('admin-view-course', $pend->id) }}" class="btn-view" >View</a>
                        <a href="{{ route('courses.accept', $pend->id) }}" class="btn-accept" >Accept</a>
                        <a href="{{ route('admin.view.decline', $pend->id) }}" class="btn-decline">Decline</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
