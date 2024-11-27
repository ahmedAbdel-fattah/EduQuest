@extends('website.layouts.instructor-dash')
@section('courses')
    active
@endsection
@section('content')
    <center>
        <header style="margin-left: 80px">
            <h1><span style="color: orange">{{$course->title}}</span> Course Quizzes</h1>
        </header>
    </center>
    <div class="container" style="width: 70%; margin-left: 300px">
        <table class="table table-bordered">

            <thead>
            @if($checkQuizzesNumber)
            <tr>
                <th>Course Section No</th>
                <th>Actions</th>
            </tr>
            @else
                <p><strong>There Is No Quizzes For This Course</strong> </p>
            @endif
            </thead>
            <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td>Section No.{{ $quiz->section_no }} Quiz [{{$loop->iteration}}] &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <a href="{{ route('view-quiz', $quiz->id) }}" class="btn btn-primary" style="background-color: deepskyblue">view</a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-primary" style="background-color: darkorange">Update</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <form action="{{ route('quizzes.delete', $quiz->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: red">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
