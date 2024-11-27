@extends('website.layouts.instructor-dash')
@section('courses')
    active
@endsection
@section('content')

    <center>
        <header style="margin-left: 80px">
            <h1>Edit Quiz</h1>
        </header>
    </center>

    <div class="container" style="width: 70%; margin-left: 300px">
        <h1>Edit Quiz - Section {{ $quiz->section_no }}</h1>

        <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="section_no">Section No</label>
                <input type="text" name="section_no" class="form-control" value="{{ $quiz->section_no }}">
            </div>

            @foreach($quiz->questions as $question)
                <div class="form-group">
                    <label for="question_{{ $question->id }}">Question : {{$loop->iteration}} </label>
                    <input type="text" name="questions[{{ $question->id }}][text]" class="form-control" value="{{ $question->question }}">

                    <label for="correct_answer_{{ $question->id }}">Correct Answer:</label>
                    <input type="text" name="questions[{{ $question->id }}][correct]" class="form-control" value="{{ $question->correct_answer }}">

                    @foreach($question->options as $option)
                        <label>Option No.{{$loop->iteration}}</label>
                        <input type="text" name="questions[{{ $question->id }}][answers][{{ $option->id }}]" class="form-control" value="{{ $option->option_text }}">
                    @endforeach
                </div>
                <hr>
            @endforeach

            <button type="submit" class="btn btn-success">Update Quiz</button>
        </form>
    </div>

@endsection
