<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TestController;
use App\Models\Course;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Instructor;
use App\Models\Enrollment;
use App\Models\User;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Passing authenticated user data to all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('user_data', Auth::user());
            }


        });

        // Passing courses data to all views
        View::composer('*', function ($view) {


            $all_courses = Course::with((['instructor.user']))->withCount('reviews')  // حساب عدد التقييمات لكل كورس
                         ->withAvg('reviews', 'rate')  // حساب متوسط التقييمات
                         ->get();

            // $instructor = Course::with('instructor')->get();

    // الكورسات الأرخص مع حساب متوسط التقييمات
    $cheap_courses = Course::withAvg('reviews', 'rate')
                           ->orderBy('price', 'asc')
                           ->limit(5)
                           ->get();

                           $courses_count = Course::all()->count();


            $view->with('all_courses',$all_courses);
            $cheap_courses = Course::orderBy('price', 'asc')->limit(5)->get();
            $view->with('all_courses', Course::all());
            $view->with('home_courses', $cheap_courses);
            $view->with('courses_count', $courses_count);
            // $view->with('course_review', $course_review);
        });

        // Passing user counts and all users to the admin dashboard view
        View::composer('admin.layouts.dash', function ($view) {
            $userCounts = (new TestController())->getUserCountsLastFiveDays(); // Fetch user counts for admin dashboard
            $newUserCounts = (new TestController())->getNewUserCountsLastFiveDays(); // Fetch user counts for admin dashboard
            $users = User::all(); // Fetch all users
            $view->with('userCounts', $userCounts);
            $view->with('newUserCounts', $newUserCounts);
            $view->with('users', $users); // Pass users data to the view
        });

        view::composer('*', function ($view) {
            $categories = Category::all();

            $categories_count = $categories->count();

            $reviews_count = Review::all()->count();

            $feedbacks_count = Contact::all()->count();
            $enrollments_count = Enrollment::all()->count();


            $view->with('categories',$categories);
            $view->with('categories_count',$categories_count);
            $view->with('reviews_count',$reviews_count);
            $view->with('feedbacks_count',$feedbacks_count);
            $view->with('enrollments_count',$enrollments_count);

        });
    }
}
