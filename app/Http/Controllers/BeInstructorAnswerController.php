<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeInstructorAnswer;
use App\Models\BeInstructorQuestion;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class BeInstructorAnswerController extends Controller
{




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'be_instructor_answers' => 'required|array',
            'be_instructor_answers.*' => 'required|string',
        ]);

        $userId = Auth::id();

        foreach ($validatedData['be_instructor_answers'] as $questionId => $answerText) {
            BeInstructorAnswer::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'answer' => $answerText,
            ]);
        }

        return redirect()->route('nextPage');
    }


    public function storeAnswers(Request $request)
{
    // التحقق من وجود الأسئلة في الطلب
    if (!$request->has('answers')) {
        return redirect()->back()->with('error', 'Please answer all questions.');
    }

    $user_id = auth()->id(); // للحصول على ID المستخدم الحالي
    $answers = $request->input('answers'); // الحصول على إجابات المستخدم من الطلب

    // التكرار على كل إجابة وحفظها في جدول الإجابات
    foreach ($answers as $question_id => $answer) {
        // العثور على السؤال أولًا للتحقق
        $question = BeInstructorQuestion::find($question_id);

        if ($question) {
            // تخزين الإجابة
            BeInstructorAnswer::create([
                'user_id' => $user_id,
                'be_instructor_question_id' => $question->id,
                'answer' => $answer,
            ]);
        }
    }
    $user = auth()->User();
$user->is_instructor = true;
Instructor::create([
    'user_id' => $user_id,
]);
$user->save();



    return redirect()->route('instructor-dashboard')->with('success', 'Answers submitted successfully.');
}
}
