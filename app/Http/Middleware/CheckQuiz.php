<?php

namespace App\Http\Middleware;

use App\Models\Enrollment;
use App\Models\Quiz;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckQuiz
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
        $quizId = $request->route('id'); // Assuming the route has a {quiz} parameter

        // Find the quiz by ID
        $quiz = Quiz::find($quizId);

        if (!$quiz) {
            // If the quiz does not exist, redirect back with an error
            return redirect()->back()->with('error', 'Quiz not found.');
        }

        // Get the course ID associated with the quiz
        $courseId = $quiz->course_id;

        // Check if the logged-in user is enrolled in the course
        $isEnrolled = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->exists();

        // If the user is not enrolled, redirect back with an error message
        if (!$isEnrolled) {
            return redirect()->route('home')->with('error', 'You are not enrolled in this course.');
        }

        // If the user is enrolled, allow the request to proceed
        return $next($request);

    }
}
