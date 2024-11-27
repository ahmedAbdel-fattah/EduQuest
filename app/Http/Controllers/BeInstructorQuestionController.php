<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BeInstructorAnswer;
use App\Models\BeInstructorQuestion;
use Illuminate\Support\Facades\Auth;

class BeInstructorQuestionController extends Controller
{

    public function index(){
        $data = BeInstructorQuestion::all();
        return view('admin.BeInstructorQuestion', compact('data'));
    }


    public function showQuestions()
    {
            $questions = BeInstructorQuestion::all();

            return view('website.instructor-start', compact('questions'));
        }






        public function create()
        {
            return view('admin.instructor-quest-create');
        }

        // 3. حفظ المقال الجديد في قاعدة البيانات
        public function store(Request $request)
        {
            // التحقق من المدخلات
            $validatedData = $request->validate([
                'question' => 'required|max:255',
                'choice1' => 'required',
                'choice2' => 'required',
                'choice3' => 'required',
            ]);

            // إنشاء المقال
            $question = new BeInstructorQuestion();
            $question->question_title = $validatedData['question'];
            $question->choice1 = $validatedData['choice1'];
            $question->choice2 = $validatedData['choice2'];
            $question->choice3 = $validatedData['choice3'];
            $question->save(); // حفظ السجل في قاعدة البيانات


            return redirect()->route('instructor-questions.index')->with('success', 'question created successfully.');
        }






        public function edit($id)
    {
        $data = BeInstructorQuestion::findOrFail($id);
        return view('admin.instructor-quest-edit', compact('data'));
    }

    // Update the specified FAQ in the database
    public function update(Request $request, $id)
{
    // العثور على السؤال باستخدام المعرّف
    $question = BeInstructorQuestion::findOrFail($id);

    // التحقق من المدخلات
    $validatedData = $request->validate([
        'question' => 'required|max:255',
        'choice1' => 'required',
        'choice2' => 'required',
        'choice3' => 'required',
    ]);

    // تحديث البيانات
    $question->question_title = $validatedData['question'];
    $question->choice1 = $validatedData['choice1'];
    $question->choice2 = $validatedData['choice2'];
    $question->choice3 = $validatedData['choice3'];
    $question->save(); // حفظ السجل

    return redirect()->route('instructor-questions.index')->with('success', 'Question updated successfully.');
}

    // Remove the specified FAQ from the database
    public function destroy($id)
    {
        $data = BeInstructorQuestion::findOrFail($id);
        $data->delete();

        return redirect()->route('instructor-questions.index')->with('success', 'question deleted successfully.');
    }


}
