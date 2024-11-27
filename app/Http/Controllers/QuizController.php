<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizHistory;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function store(Request $request)
    {
        // Create a new quiz
        $quiz = Quiz::create([
            'course_id' => $request->course_id,
            'section_no'=> $request->section_no,
            'title' =>$request->title,
        ]);

        // Loop through the questions and store each one
        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $questionData['question'],
                'correct_answer' => $questionData['correct_answer'],
            ]);
            $correct=$questionData['correct_answer'];
            // Loop through the options for each question and save them
            $optionsCount = 1;
            foreach ($questionData['options'] as $option) {
                $isCorrect = ($correct == $optionsCount); // Compare correct answer with current option count

                $question->options()->create([
                    'option_text' => $option,
                    'is_correct' => $isCorrect,
                ]);

                $optionsCount++;
            }
        }

        return redirect()->back()->with('success', 'Quiz created successfully!');
    }

    //------------------------------------------------
    // Show all quizzes for a specific course
    public function index($course_id)
    {
        $quizzes = Quiz::where('course_id', $course_id)->get();
        $course= Course::find($course_id);
        $checkQuizzesNumber=0;
        foreach($quizzes as $quiz) {
            $checkQuizzesNumber++;
        }

        return view('website.course-quizzes', compact('quizzes', 'course','checkQuizzesNumber'));
    }

    // Show quiz edit form
    public function edit($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found');
        }
        $questions = Question::where('quiz_id', $quiz->id)->get();

        $options = [];

        foreach ($questions as $question) {
            $questionOptions = Option::where('question_id', $question->id)->get();
            $options[$question->id] = $questionOptions;
        }

        return view('website.quiz-edit', compact('quiz','questions','options'));
    }

    // Update a quiz
    public function update(Request $request, $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $quiz->section_no = $request->section_no;
        $quiz->save();

        foreach ($request->questions as $question_id => $question_data) {
            $question = Question::findOrFail($question_id);
            $question->question = $question_data['text'];
            $question->correct_answer = $question_data['correct'];
            $question->save();

            foreach ($question_data['answers'] as $answer_id => $answer_text) {
                $answer = Option::findOrFail($answer_id);
                $answer->option_text = $answer_text;
                $answer->save();
            }
        }

        return redirect()->route('course-quizzes', $quiz->course_id)->with('success', 'Quiz updated successfully');
    }

    // Delete a quiz
    public function destroy($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $quiz->delete();

        return back()->with('success', 'Quiz deleted successfully');
    }

    //view quiz details
    public function viewQuizDetails($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found');
        }
        $questions = Question::where('quiz_id', $quiz->id)->get();

        $options = [];

        foreach ($questions as $question) {
            $questionOptions = Option::where('question_id', $question->id)->get();
            $options[$question->id] = $questionOptions;
        }

        return view('website.view-quiz-details', compact('quiz', 'questions', 'options'));
    }


    //--------------------------------------------------------------------
    // Show quiz on quiz page

    public function showQuizForUser($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $course_id = $quiz->course_id;
        $quizCourse=Course::where('id', $course_id)->first();

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found');
        }
        $questions = Question::where('quiz_id', $quiz->id)->get();

        $options = [];

        foreach ($questions as $question) {
            $questionOptions = Option::where('question_id', $question->id)->get();
            $options[$question->id] = $questionOptions;
        }

        return view('website.quiz', compact('quizCourse','quiz','questions','options'));
    }



    // Store user's answers and calculate quiz result
    public function submitQuiz(Request $request, $quiz_id)
    {
        $user = auth()->user();  // Get the currently authenticated user
        $quiz = Quiz::findOrFail($quiz_id);  // Find the quiz
        $questions = $quiz->questions;  // Get all questions related to the quiz

        $score = 0; // Variable to store user's score
        $totalQuestions = $questions->count();  // Total number of questions

        // Loop through each question
        foreach ($questions as $question) {
            $userAnswerId = $request->input('question_' . $question->id);  // Get user's answer from the form (radio buttons)

            if ($userAnswerId) {
                // Store user's answer in the database
                UserAnswer::create([
                    'user_id' => $user->id,
                    'quiz_id' => $quiz_id,
                    'question_id' => $question->id,
                    'option_id' => $userAnswerId,
                ]);

                // Get the correct answer for this question
                $correctOption = $question->options()->where('is_correct', true)->first();

                // Check if the user's answer matches the correct one
                if ($correctOption && $correctOption->id == $userAnswerId) {
                    $score++;  // Increment score if the answer is correct
                }
            }
        }

        // Calculate percentage
        $resultPercentage = ($score / $totalQuestions) * 100;

        // Return the result to the user
        $quizUser=Auth::user();
        $incorrect=$totalQuestions-$score;

        QuizHistory::create([
            'quiz_id' => $quiz_id,
            'user_id' => Auth::id(),
            'percentage' => $resultPercentage,
        ]);
        return view('website.quiz-result', [
            'quiz' => $quiz,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'resultPercentage' => $resultPercentage,
            'quizUser' => $quizUser,
            'incorrect' => $incorrect,
        ]);
    }

    public function showUserAnswers($quizId)
    {
        $userId = auth()->id();
        $quiz=Quiz::where('id', $quizId)->first();
        $course_id = $quiz->course_id;
        $quizCourse=Course::where('id', $course_id)->first();

        // Fetch the quiz with questions and user answers
        $quiz = Quiz::with(['questions.options', 'questions.userAnswer' => function($query) use ($userId) {
            $query->where('user_id', $userId)->latest('created_at');
        }])->findOrFail($quizId);

        return view('website.user-quiz-answers', compact('quiz','quizCourse'));
    }

}
