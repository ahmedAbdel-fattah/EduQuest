@extends('website.layouts.app')
@section('content')
    <style>
        .navbar-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Adjust the height of the background */
            background: linear-gradient(135deg, #6a0572, #a4508b); /* Purple to pink gradient */
            z-index: -1; /* Position behind the navbar */
        }
        /** {*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    box-sizing: border-box;*/
        /*}*/

        /*body {*/
        /*    font-family: 'Poppins', sans-serif;*/
        /*    background-color: #f0f2f5;*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    height: 100vh;*/
        /*}*/

        .quiz-result-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .result-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(36, 30, 41, 0.1);
            text-align: center;
        }

        .quiz-title {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .score-section h2 {
            font-size: 22px;
            font-weight: 500;
            color: #333;
        }

        .score-section p {
            font-size: 16px;
            margin: 10px 0;
            color: #555;
        }

        .score-details {
            margin: 20px 0;
        }

        .score-bar {
            background-color: #f0f0f0;
            border-radius: 8px;
            position: relative;
            height: 30px;
            margin-top: 10px;
            overflow: hidden;
        }

        .score-progress {
            background-color: #4CAF50;
            height: 100%;
            border-radius: 8px;
            transition: width 0.4s ease;
        }

        .score-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .questions-summary {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
        }

        .summary-item {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            width: 48%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .summary-item h3 {
            font-size: 16px;
            color: #555;
        }

        .summary-value {
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        .congrats-message {
            margin: 30px 0;
            font-size: 15px;
            color: #666;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .button {
            text-decoration: none;
            background-color: #007bff;
            padding: 12px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .review-btn {
            background-color: #4CAF50;
        }

        .review-btn:hover {
            background-color: #388E3C;
        }

        .new-quiz-btn {
            background-color: #f44336;
        }

        .new-quiz-btn:hover {
            background-color: #c62828;
        }

    </style>
    <div class="navbar-bg"></div>
    <br><br><br><br><br><br>
    <div class="quiz-result-container">
        <div class="result-card">
            <h1 class="quiz-title">Quiz Results</h1>

            <div class="score-section">
                <h2>Congratulations, <span class="user-name">{{$quizUser->name}}</span>!</h2>
                <p>You completed <strong>" Course Quiz On Section {{$quiz->section_no}}"</strong>.</p>

                <div class="score-details">
                    <p>Your Score:</p>
                    <div class="score-bar">
                        <span class="score-value">{{number_format($resultPercentage,2)}}%</span>
                        <div class="score-progress" style="width: {{$resultPercentage}}%;"></div>
                    </div>
                </div>
                <div class="questions-summary">
                    <div class="summary-item">
                        <h3>Correct Answers</h3>
                        <span class="summary-value">{{$score}}/{{$totalQuestions}}</span>
                    </div>
                    <div class="summary-item">
                        <h3>Incorrect Answers</h3>
                        <span class="summary-value">{{$incorrect}}/{{$totalQuestions}}</span>
                    </div>
                </div>

                <div class="congrats-message">
                    <p>
                        @if($resultPercentage >= 80)
                        You scored above 80%. Great job! You can review the answers or take another quiz.
                        @else
                            Your score less than 80% you need revision
                        @endif
                    </p>
                </div>

                <div class="action-buttons">
                    <a href="{{route('quiz.user_answers',$quiz->id)}}" class="button review-btn">Review Answers</a>
                    <a href="#" class="button new-quiz-btn">Take Another Quiz</a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection
