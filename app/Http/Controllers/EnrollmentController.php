<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Bank;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enrollCourse(Request $request, $courseId)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string',
            'card_number' => 'required|string|max:12|min:12',
            'expiry_date' => 'required|max:4|min:4',
            'cvv' => 'required|numeric|digits:3',
        ]);

        // Find the course and its price
        $course = Course::findOrFail($courseId);
        $coursePrice = $course->price;

        // Check if the card details are valid
        $bankAccount = Bank::where('name', $request->name)
            ->where('card_number', $request->card_number)
            ->where('expiry_date', $request->expiry_date)
            ->where('cvv', $request->cvv)
            ->first();

        if (!$bankAccount) {
            return back()->withErrors(['error' => 'Invalid card details']);
        }

        // Check if the balance is sufficient for the course price
        if ($bankAccount->balance < $coursePrice) {
            return back()->withErrors(['error' => 'Insufficient balance']);
        }

        // Deduct the course price from the bank account
        $bankAccount->balance -= $coursePrice;
        $bankAccount->save();

        // Enroll the user in the course
        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => true,
        ]);
        // Redirect to the success page or display success message
        return redirect()->route('course_details',$course->id)->with('success', 'Enrollment successful!');
    }

    public function viewEnrollForm($id)
    {
        $course_info=Course::where('id', $id)->first();
        return view('website.enrollment', compact('course_info'));
    }

}

