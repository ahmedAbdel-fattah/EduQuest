<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdVideoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDeclineController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BeInstructorQuestionController;
use App\Http\Controllers\BeInstructorAnswerController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ActivityController;
use App\Models\AdVideo;
use App\Models\Developer;

use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $adVideo = AdVideo::all();
    $developers = Developer::all();
    return view('website.index',compact('adVideo','developers'));
})->name('home');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

// ============================================= middlewares ========================================================

Route::middleware(['auth:sanctum', 'verified','Admin'])->get('/dashboard',[TestController::class,'check_dashboard'])->name('dashboard');

Route::middleware(['auth', 'Admin'])->group(function () {

    Route::get('dashboard/categories', [CategoryController::class, 'categories_table'])->name('categories_table');
    Route::get('category/add',[CategoryController::class,'index_category'])->name('category_add');
    Route::post('/category',[CategoryController::class,'create_category'])->name('category_data');
    Route::get("/category/delete/{id}",[CategoryController::class,'delete_category'])->name("category_delete");
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit_category'])->name('category_edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update_category'])->name('category_update');

    Route::delete('/dashboard/delete-activity/{id}', [ActivityController::class, 'delete_activity'])->name('delete_activity');
    Route::delete('/dashboard/delete-all-activity', [ActivityController::class, 'delete_activity_all'])->name('delete_activity_all');

    Route::resource('/dashboard/faqs', FaqController::class);
    Route::resource('/dashboard/instructor-questions', BeInstructorQuestionController::class);
    Route::resource('/dashboard/users', UserController::class);

    Route::get('/dashboard/user_data/{id}', [UserController::class, 'user_info_to_admin'])->name('dashboard.user_data');
    Route::get('/dashboard/add-admin/{id}', [UserController::class, 'add_admin'])->name('dashboard.add_admin');
    Route::get('/dashboard/drop-admin/{id}', [UserController::class, 'drop_admin'])->name('dashboard.drop_admin');

    Route::get('/admin-pending-courses',[CourseController::class, 'showPending'])->name('pending-courses');
    Route::get('/admin-accepted-courses',[CourseController::class, 'showAccepted'])->name('accepted-courses');
    Route::get('/admin-declined-courses',[CourseController::class, 'showDeclined'])->name('declined-courses');
    Route::get('/admin-view-course/{id}',[CourseController::class, 'viewCourse'])->name('admin-view-course');
    Route::get('/admin-courses/accept/{id}', [CourseController::class, 'acceptCourse'])->name('courses.accept');
    Route::get('/admin-courses/decline/{id}', [CourseController::class, 'declineCourse'])->name('courses.decline');
});

Route::middleware(['auth', 'isInstructor'])->group(function () {
    Route::get('/instructor-start', [InstructorController::class, 'index'])->name('instructor-start');
    Route::get('/instructor-dashboard', [InstructorController::class, 'index'])->name('instructor-dashboard');

    Route::get('/instructor-start', [BeInstructorQuestionController::class, 'showQuestions'])->name('instructor-start');
    Route::post('/submit-answers', [BeInstructorAnswerController::class, 'storeAnswers'])->name('submit.answers');


    Route::get('/instructor-dashboard/add-course', [InstructorController::class, 'add_course'])->name('instructor_add_course');
    Route::get('/instructor-courses', [CourseController::class, 'showMyCourses'] )->name('instructor-courses');
    Route::post('/instructor-add-course', [CourseController::class, 'store'])->name('courses.store');

    // Route::get('/instructor-view-course/{id}', [TestController::class, 'courses_details'] )->name('course_detailss');
    Route::get('/instructor-view-course/{id}', [CourseController::class, 'edit'] )->name('course_detailss');

    // Route::get('/instructor-dashboard/add-course', [InstructorController::class, 'add_course'])->name('instructor-add-course');

    Route::get('/instructor-view-course/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');

    Route::post('/instructor-view-course/{id}/update', [CourseController::class, 'update'])->name('courses.update');

    // =============== admin quiz ================

    Route::post('/course-quiz', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('view-course-quizzes/{course_id}',[QuizController::class, 'index'])->name('course-quizzes');
    Route::get('view-quiz-details/{course_id}',[QuizController::class, 'viewQuizDetails'])->name('view-quiz');
    Route::get('/quizzes/{quiz_id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
    Route::post('/quizzes/{quiz_id}/update', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz_id}/delete', [QuizController::class, 'destroy'])->name('quizzes.delete');

    // =============== end admin quiz ================

    // Route::get('/instructor-add-course', function () {
    //     return view('website.instructor-add-course');})->name('instructor-add-course');
});

Route::middleware(['auth', 'isStudent'])->group(function () {

    Route::get('/course_videos/{course_id}',[CourseController::class,'viewAllCourseDetails'])->name('course_videos');
Route::post('/course_videos/{course_id}',[CourseController::class,'markVideoAsCompleted'])->name('course_progress');
    // ========== quiz ==========
    Route::get('/course-quiz/{id}',[CourseController::class,'viewCourseQuiz'])->name('course-quiz');
    // ========== end quiz ==========

});

Route::middleware(['auth'])->group(function () {

    Route::get('/myProfile', [TestController::class,'viewProfile'])->name('myProfile');

    Route::get('/edit_profile', function () {
        return view('profile.show');
    })->name('edit_profile');


    Route::get('/free_enroll/{id}',[CourseController::class,'viewEnrollFree'])->name('view.free.enroll');

});
Route::post('/free_submit',[CourseController::class,'enrollFree'])->name('free.enroll');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/enroll-course/{courseId}', [EnrollmentController::class, 'viewEnrollForm'])->middleware('check.payment')->name('view.enroll.course');
    Route::post('/enroll-course/{courseId}', [EnrollmentController::class, 'enrollCourse'])->middleware('check.payment')->name('enroll.course');
    // Route::get('/enroll-course/{courseId}', [EnrollmentController::class, 'viewEnrollForm'])->name('view.enroll.course');
    // Route::post('/enroll-course/{courseId}', [EnrollmentController::class, 'enrollCourse'])->name('enroll.course');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/course_videos/{course_id}',[CourseController::class,'viewAllCourseDetails'])->middleware('check.enrollment:course')->name('course_videos');
    Route::post('/course_videos/{course_id}',[CourseController::class,'markVideoAsCompleted'])->middleware('check.enrollment:course')->name('course_progress');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/quiz/{id}', [QuizController::class,'showQuizForUser'])->middleware('check.quiz.enrollment')->name('quiz');

});

Route::post('/quiz/{quiz_id}/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
Route::get('/quiz/{id}/user-answers', [QuizController::class, 'showUserAnswers'])->name('quiz.user_answers');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/certificate/{id}', [CourseController::class, 'certificateShow'])->middleware('check.user.certificate')->name('certificate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/course_details/{id}', [TestController::class, 'courses_details'] )->middleware('check.accepted')->name('course_details');
});

// ========================================================================================================


Route::get('/elements', function () {
    return view('website.elements');
})->name('elements');
Route::get('/book-details', function () {
    return view('website.book-details');
})->name('book-details');

// Route::get('/courses', function () {
//     return view('website.courses');
// })->name('courses');

Route::get('courses', [CourseController::class, 'index'])->name('courses');

// Route::get('/course_details', function () {
//     return view('website.course_details');
// })->name('course_details');


Route::get('/course-instructor/{id}',[InstructorController::class,'show_profile'])->name('course-instructor');




//Route::post('/save-video-progress', [CourseController::class, 'saveVideoProgress'])->name('save-video-progress');

Route::get('/contact', function () {
    return view('website.contact');
})->name('contact');
Route::get('/enrollment', function () {
    return view('website.enrollment');
})->name('enrollment');


Route::get('/blog', function () {
    return view('website.blog');
})->name('blog');
Route::get('/blog-details', function () {
    return view('website.blog-details');
})->name('blog-details');


Route::get('/about', function () {
    return view('website.about');
})->name('about');
//Route::get('/admin/dashboard', function () {
//    return view('admin.dashboard');
//
//})->name('admin.dashboard');
Route::get('/categories', function () {
    return view('website.categories');
})->name('categories');
Route::get('/home', [TestController::class, 'index'] )->name('admin');



// Route::get('/instructor-courses', [CourseController::class, 'showMyCourses'] )->name('instructor-courses');
// Route::post('/instructor-add-course', [CourseController::class, 'store'])->name('courses.store');

//Route::get('/instructor-add-courses', function () {
//    return view('website.instructor-add-course');
//})->name('instructor-add-course');
Route::get('/instructor-courses', [CourseController::class, 'showMyCourses'] )->name('instructor-courses');
Route::post('/instructor-add-course', [CourseController::class, 'store'])->name('courses.store');
Route::get('/instructor-students', [CourseController::class, 'showMyStudents'] )->name('instructor-students');





Route::get('/admin-pending-courses',[CourseController::class, 'showPending'])->name('pending-courses');
Route::get('/admin-accepted-courses',[CourseController::class, 'showAccepted'])->name('accepted-courses');
Route::get('/admin-declined-courses',[CourseController::class, 'showDeclined'])->name('declined-courses');
Route::get('/admin-view-course/{id}',[CourseController::class, 'viewCourse'])->name('admin-view-course');
Route::get('/admin-courses/accept/{id}', [CourseController::class, 'acceptCourse'])->name('courses.accept');
Route::get('/admin-courses/decline/{id}', [CourseController::class, 'declineCourse'])->name('courses.decline');
Route::delete('/delete-courses/{id}', [CourseController::class, 'deleteCourse'])->name('courses.delete');
Route::delete('/delete-courses-from-website/{id}', [CourseController::class, 'deleteCourseFromWebsite'])->name('course.website.delete');


Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/developer/craete',[AboutController::class,'create'])->name('developer.create');
Route::post('/developer/store',[AboutController::class,"store"])->name('developer.store');
Route::get('/about/edit/{id}', [AboutController::class, 'edit'])->name('developer.edit');
Route::put('/about/update/{id}',[AboutController::class,"update"])->name('developer.update');
Route::delete('/developer/{developer}',[AboutController::class,"destroy"])->name('developer.destroy');


//Route::get('/admin/faqs', function () {
//    return view('admin.faqs');
//})->name('admin-faqs');


Route::get('/faqs', [FaqController::class, 'showFaq'] )->name('faqs');




Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');


// Route::get('/', [CategoryController::class, 'home'])->name('home');



// Route::post('/course-quiz', [QuizController::class, 'store'])->name('quizzes.store');
// Route::get('view-course-quizzes/{course_id}',[QuizController::class, 'index'])->name('course-quizzes');
// Route::get('view-quiz-details/{course_id}',[QuizController::class, 'viewQuizDetails'])->name('view-quiz');
// Route::get('/quizzes/{quiz_id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
// Route::post('/quizzes/{quiz_id}/update', [QuizController::class, 'update'])->name('quizzes.update');
// Route::delete('/quizzes/{quiz_id}/delete', [QuizController::class, 'destroy'])->name('quizzes.delete');

// ============================================   reviews     =======================================

Route::post('sub-review/{id}', [ReviewsController::class, 'submitReview'])->name('sub_review');
Route::delete('delete-review/{id}', [ReviewsController::class, 'delete_review'])->name('delete_review');
Route::put('update-review/{id}', [ReviewsController::class, 'update_review'])->name('update_review');



Route::post('/course-quiz', [QuizController::class, 'store'])->name('quizzes.store');
Route::get('view-course-quizzes/{course_id}',[QuizController::class, 'index'])->name('course-quizzes');
Route::get('view-quiz-details/{course_id}',[QuizController::class, 'viewQuizDetails'])->name('view-quiz');
Route::get('/quizzes/{quiz_id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
Route::post('/quizzes/{quiz_id}/update', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quizzes/{quiz_id}/delete', [QuizController::class, 'destroy'])->name('quizzes.delete');




Route::get('/quiz/{id}', [QuizController::class,'showQuizForUser'])->name('quiz');
Route::post('/quiz/{quiz_id}/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
Route::get('/quiz/{id}/user-answers', [QuizController::class, 'showUserAnswers'])->name('quiz.user_answers');



Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::put('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('contacts.updateStatus');

Route::resource('settings', SettingController::class);

Route::get('/contact', [SettingController::class, 'settingshow'])->name('contact');

Route::get('/decline-course/{course_id}', [CourseDeclineController::class, 'viewDeclinePage'])->name('admin.view.decline');
Route::post('/course/decline', [CourseDeclineController::class, 'sendDeclineReason'])->name('admin.submit.decline');

Route::get('/dashboard-developers', [DeveloperController::class, 'index'] )->name('show.developers');
Route::get('/dashboard-adVideo-controll', [AdVideoController::class, 'index'] )->name('adVideo-controll');
Route::get('/dashboard-adVideo-add', [AdVideoController::class, 'add_video'] )->name('adVideo-add');
Route::post('/admin-adVideo-controll-edit', [AdVideoController::class, 'store'] )->name('about.storeVideo');

Route::get('/about/editVedio/{id}', [AdVideoController::class, 'edit'])->name('video.edit');
Route::put('/about/update/{id}',[AdVideoController::class,"update"])->name('video.update');
Route::delete('dashboard/advideo/delete/{id}',[AdVideoController::class , "delete_video"])->name('delete_advideo');



Route::get('/search', [SearchController::class, 'search'])->name('search');


//-----------cart-----------------
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('view.cart');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout',[CartController::class, 'viewCheckout'])->name('checkout');
});
//--------------favourites-------------------
Route::post('/favourite/add', [FavouriteController::class, 'addToFavourite'])->name('favourite.add');
Route::get('/favourite/items', [FavouriteController::class, 'viewFavourite'])->name('view.favourites');
Route::post('/favourite/remove/{id}', [FavouriteController::class, 'remove'])->name('favourite.remove');
