@extends('website.layouts.app')
@section('content')
    @section('custom-css')
        <link rel="stylesheet" href="{{asset('css/quiz.css')}}">
    @endsection
    <div class="navbar-bg"></div>
    <div class="navbar-bg"></div>
    <br><br><br>
    <div class="quiz-container">
        <h1 class="quiz-title">{{$quizCourse->title}} Course Quiz On Section {{$quiz->section_no}} </h1>


            @foreach($quiz->questions as $question)
                <div class="question-container">
                    <p class="question">{{$loop->iteration}}. {{$question->question}}</p>
                    <div class="options">
                        @foreach($question->options as $option)
                            <div class="option
    @if(optional($question->userAnswer)->option_id == $option->id)
        {{ $option->is_correct ? 'correct-answer' : 'incorrect-answer' }}
    @endif">
                                {{ $option->option_text }}
                            </div>
                        @endforeach
                            <p>
                                Your answer:
                                @if($question->userAnswer)
                                    {{ $question->userAnswer->option->option_text }}
                                @else
                                    <em>No answer provided</em>
                                @endif
                            </p>
                    </div>
                </div>

            @endforeach
    </div>

@endsection
