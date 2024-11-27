<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoToCheckout
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
        $user =  Auth::user();
        if(!\auth()->check()){
            return redirect('/login');
        }
        $courseId=$request->route('courseId');
        $isEnrolled = DB::table('enrollments')
            ->where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->exists();
        // Check if the user is enrolled in the course

        if ($isEnrolled) {
            // If not enrolled, redirect to a specified route with an error message
            return redirect()->route('course_details',$courseId)->with('error', 'You must enroll in this course to access its content.');
        }
        $price=Course::find($courseId)->price;
        if($price==0){
            return redirect()->route('course_details',$courseId)->with('error', 'You already enrolled it.');
        }
        return $next($request);
    }
}
