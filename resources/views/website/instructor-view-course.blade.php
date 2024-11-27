@extends('website.layouts.instructor-dash')
@section('courses')
    active
@endsection

@section('content')
    <body>
    <div class="container" style="width: 70%; margin-left: 300px">
        <h1>Edit Course: {{ $course->title }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Course details section -->
            <div class="form-group">
                <label for="title">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $course->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Course Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $course->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="objectives">Course Objectives</label>
                <textarea class="form-control" id="objectives" name="objectives" required>{{ $course->objectives }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Course Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $course->price }}" required>
            </div>

            <div class="form-group">
                <label for="category">Course Category</label>
{{--                <input type="text" class="form-control" id="category" name="category" value="{{ $course->category }}" required>--}}
                <select name="category" id="category" required >
                    <option value="{{ $course->category }}">Development</option>
                    <option value="design">Design</option>
                    <option value="marketing">Marketing</option>
                    <option value="business">Business</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Course Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="img-thumbnail mt-2" width="200">
            </div>

            <!-- Sections and videos section -->
            <h3>Course Sections</h3>

            @foreach($sections as $section)
                <div class="form-section">
                    <div class="form-group">
                        <label for="sections[{{ $section->id }}]">Section Title</label>
                        <input type="text" class="form-control" name="sections[{{ $section->id }}]" value="{{ $section->title }}" required>
                    </div>

                    <div class="form-section-video">
                        <h5>Section Videos</h5>
                        @if(isset($videos[$section->id]) && count($videos[$section->id]) > 0)
                            @foreach($videos[$section->id] as $video)
                                <p>{{ $video->title }}</p>
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endforeach
                        @else
                            <p>No videos available for this section.</p>
                        @endif
                    </div>
                </div>
            @endforeach
            <br>
            <button type="submit" class="btn-view">Update Course</button>
        </form><br>
        @if($course->is_accepted==1)
        <p><strong>Adding Quiz is important for evaluating your students and for them to get certificated</strong></p>
        <a href="{{route('course-quiz',$course->id)}}" class="btn">Add Quiz for this course</a>
            <a href="{{route('course-quizzes',$course->id)}}" class="btn">View Course Quizzes</a>
        @endif
    </div>
@endsection
