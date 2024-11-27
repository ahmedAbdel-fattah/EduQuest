@extends('website.layouts.instructor-dash')
@section('add-course')
    active
@endsection
@section('content')
    <div class="main-content">
        <center>
            <header>
                <h1>Add New Course</h1>
            </header>
        </center>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('courses.store-2',$sections) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="course-title">Course Title</label>
                    <input type="text" id="course-title" name="title" placeholder="Enter course title" required>
                    @if ($errors->has('title'))
                        <div style="color: red">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
@endsection
