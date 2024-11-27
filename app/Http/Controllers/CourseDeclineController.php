<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDecline;
use Illuminate\Http\Request;

class CourseDeclineController extends Controller
{
    public function viewDeclinePage($id){
        $courseId=$id;
        $course=Course::where('id',$courseId)->first();
        $userId=$course->user_id;
        return view('admin.admin-course-decline',compact('courseId','userId'));
    }

    public function sendDeclineReason(Request $request){
        // Validate the input
        $request->validate([
            'user_id' => 'required',
            'course_id' => 'required',
            'decline_reason' => 'required|string|max:255',
        ]);

        // Store the decline reason
        CourseDecline::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'decline_reason' => $request->decline_reason,
        ]);

        $course = Course::find($request->course_id);
        if ($course) {
            $course->is_accepted = 2; // Change to 2
            $course->save();
        }


        // Redirect or return response
        return redirect('/admin-declined-courses');
    }
}
