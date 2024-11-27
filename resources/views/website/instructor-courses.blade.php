@extends('website.layouts.instructor-dash')
@section('courses')
    active
@endsection
@section('content')
    <br>
        <br>

<div class="container" style="width: 910px; margin-left: 320px">
    <center>
    <header>
        <h1>My Course</h1>
    </header>
    </center>
    <div class="courses-container">
        <!-- Course 1 -->
        @foreach($courses as $course)
            <div class="course-card">
                <div class="course-image">
                    <img src="{{asset('storage/'.$course->image)}}" alt="Course 1">
                </div>
                <div class="course-content">
                    <h3 class="course-title">{{$course->title}}</h3>
                    <p class="course-description">{{$course->description}}</p>
                    <p class="course-price">{{$course->price}} EGP</p>
                    @if($course->is_accepted==1)
                        @if($course->is_deleted==1)
                            <p style="color:Green">Accepted | <span style="color: red">Deleted From website</span></p>
                        @else
                            <p style="color:Green">Accepted</p>
                        @endif
                            <form action="{{ route('course.website.delete', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('course_details', $course->id) }}" class="btn-view" >View in Website</a>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn-view" >View</a>
                                @if($course->is_deleted==0)
                                   <button type="submit" class="btn btn-danger">Delete</button>
                                @else
                                    <button type="submit" class="btn btn-danger">Show</button>
                                @endif
                        </form>
                    @elseif($course->is_accepted==0)
                        <p style="color:red">Pending</p>
                        <form action="{{ route('courses.delete', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('course_details', $course->id) }}" class="btn-view">View</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @else
                        <p style="color:red">Declined</p>
                        <form action="{{ route('courses.delete', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn-view" >View</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
    <br><br>
@endsection
