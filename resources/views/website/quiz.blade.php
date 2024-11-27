@extends('website.layouts.app')
@section('content')
@section('custom-css')
    <link rel="stylesheet" href="{{asset('css/quiz.css')}}">
@endsection
    <div class="navbar-bg"></div>
    <br><br><br>
    <div class="quiz-container">
        <h1 class="quiz-title">{{$quizCourse->title}} Course Quiz On Section {{$quiz->section_no}} </h1>

        <form id="quiz-form" action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
            <!-- Question 1 -->
            @csrf
            @foreach($questions as $question)
            <div class="question-container">
                <p class="question">{{$loop->iteration}}. {{$question->question}}</p>
                <div class="options">
                    @foreach($question->options as $option)
                    <label class="option">
                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}">
                        {{$loop->iteration}}) {{$option->option_text}}
                    </label>
                    @endforeach
                </div>
            </div>

            @endforeach

            <!-- Submit Button -->
            <div class="submit-container">
                <button type="submit" class="submit-button">Submit Quiz</button>
            </div>
        </form>
    </div>

{{--    <script>--}}
{{--        document.getElementById('quiz-form').addEventListener('submit', function(e) {--}}
{{--            e.preventDefault();--}}
{{--            alert('Quiz submitted successfully!'); // Placeholder for form submission--}}
{{--        });--}}


{{--    </script>--}}
@endsection
