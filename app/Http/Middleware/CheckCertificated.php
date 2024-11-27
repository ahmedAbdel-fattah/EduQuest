<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\CourseProgress;
use App\Models\Enrollment;
use App\Models\Video;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCertificated
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
        if(!Auth::check()){
            redirect('/login');
        }
        $user = Auth::user();
        $courseId=$request->route('id');
        $isEnrolled=Enrollment::where('course_id',$courseId)->where('user_id',$user->id)->exists();
        if(!$isEnrolled){
            return redirect()->route('course_details',$courseId)->with('error', 'You must enroll in this course to access its content.');
        }
        $completedVideos = CourseProgress::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->count();

        $videoCount = Video::whereHas('section', function($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->count();

        // Calculate progress percentage
        $progress = ( $completedVideos /$videoCount) * 100;
        if($progress<100){
            return redirect()->route('course_details',$courseId)->with('error', 'You must enroll in this course to access its content.');
        }
        $price=Course::find($courseId)->price;
        if($price==0){
            return redirect()->route('course_details',$courseId)->with('error', 'You have no certificate.');
        }

        return $next($request);
    }
}
