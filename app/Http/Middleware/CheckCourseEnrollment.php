<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Quiz;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckCourseEnrollment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the currently authenticated user
        $user =  Auth::user();
        $courseId=$request->route('course_id');
        $isEnrolled = DB::table('enrollments')
            ->where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->exists();
        // Check if the user is enrolled in the course

        if (!$isEnrolled) {
            // If not enrolled, redirect to a specified route with an error message
            return redirect()->route('course_details',$courseId)->with('error', 'You must enroll in this course to access its content.');
        }

        return $next($request);
    }
}
