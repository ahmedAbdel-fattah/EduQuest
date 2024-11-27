<?php
namespace App\Http\Controllers;

use App\Models\CourseProgress;
use App\Models\Enrollment;
use App\Models\Quiz;
use App\Models\Video;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Review;
use App\Models\Category;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\PostTooLargeException;


class CourseController extends Controller
{

    public function index(){
        // $courses = Course::all();
        $rate = Course::withAvg('reviews', 'rate')->first();

        return view('website.courses',compact('rate'));
    }

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'objectives' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpg,png,jpeg',
        'num_sections' => 'required|integer|min:1',
        'sections.*.title' => 'required|string',
        'sections.*.videos.*' => 'required|mimes:mp4,mkv,avi|max:800000000240' // 10MB max for each video
    ]);

    // Store the course image
    $imagePath = $request->file('image')->store('course_images', 'public');

    // Find instructor by user ID
    $instructor = Instructor::where('user_id', auth()->id())->firstOrFail();

    // Create the course
    $course = Course::create([
        'title' => $request->title,
        'description' => $request->description,
        'objectives' => $request->objectives,
        'price' => $request->price,
        'instructor_id' => $instructor->id, // استخدام id المدرس
        'category_id' =>$request->category_id,
        'image' => $imagePath
    ]);

    // Loop through sections and store them
    foreach ($request->sections as $sectionData) {
        $section = Section::create([
            'course_id' => $course->id,
            'title' => $sectionData['title']
        ]);

        // Store videos for the section
        if (isset($sectionData['videos'])) {
            foreach ($sectionData['videos'] as $video) {
                $videoPath = $video->store('section_videos', 'public');
                $section->videos()->create([
                    'path' => $videoPath
                ]);

        // Validate the request

    }}}

    // Update user's is_instructor status if not already an instructor
    $user = auth()->user();
    if ($user->is_instructor == 0) {
        $user->is_instructor = true;
        $user->save(); // يجب حفظ التغيير في قاعدة البيانات
    }

    // Associate the course with the user
    $user->courses()->save($course);

    // Redirect to a success page or display a success message
    return redirect()->back()->with('success', 'Course created successfully!');
}


    public function showMyCourses()
    {
        $instructor = Auth::user();

        // Get the courses that belong to this instructor
        $courses = $instructor->courses; // Since we already defined the relationship in User model

        // Return view with the courses data
        return view('website.instructor-courses', compact('courses'));
    }

    public function showAdminCourses()
    {
        $courses = Course::where('is_accepted', 0)->get();
        // $category = Category::all();
        return view('admin.admin-courses', compact('courses','category'));
    }

    public function viewCourse($id)
    {
        $course = Course::find($id);
        $category = Category::findOrFail($course->category_id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        $sections = Section::where('course_id', $course->id)->get();

        $videos = [];

// Loop through each section to retrieve its videos
        foreach ($sections as $section) {
            $sectionVideos = Video::where('section_id', $section->id)->get();
            $videos[$section->id] = $sectionVideos; // Store videos by section ID
        }

        return view('admin.admin-view-course', compact('course', 'sections', 'videos','category'));
    }

    public function acceptCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        $course->is_accepted = 1;
        $course->save();

        return redirect()->back();
    }

    public function declineCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        $course->is_accepted = 2;
        $course->save();

        return redirect('admin-pending-courses');
    }

    public function showAccepted()
    {
        // $accepted = Course::where('is_accepted', 1)->get();
        $accepted = $accepted = Course::with(['instructor.user'])->where('is_accepted', 1)->get();
        return view('admin.admin-courses', ['filter' => 'accepted', 'accepted' => $accepted]);
    }

    public function showDeclined()
    {
        $declined = Course::with(['instructor.user'])->where('is_accepted', 2)->get();
        return view('admin.admin-courses', ['filter' => 'declined', 'declined' => $declined]);
    }

    public function showPending()
    {
        $pending = Course::with(['instructor.user'])->where('is_accepted', 0)->get();
        return view('admin.admin-courses', ['filter' => 'pending', 'pending' => $pending]);
    }


    //------------------------------------------------------------------


    public function edit($id)
    {
        $course = Course::find($id);


        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        $sections = Section::where('course_id', $course->id)->get();

        $videos = [];

// Loop through each section to retrieve its videos
        foreach ($sections as $section) {
            $sectionVideos = Video::where('section_id', $section->id)->get();
            $videos[$section->id] = $sectionVideos; // Store videos by section ID
        }

        return view('website.instructor-view-course', compact('course', 'sections', 'videos'));
    }

    // Handle the course update logic
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'objectives' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:80048', // If a new image is uploaded
        ]);

        $course = Course::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Update course details
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->objectives = $request->input('objectives');
        $course->price = $request->input('price');
        $course->category = $request->input('category');

        // Handle image update if a new one is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_images', 'public');
            $course->image = $imagePath;
        }

        $course->save();

        // Update sections and videos
        if ($request->has('sections')) {
            foreach ($request->sections as $section_id => $section_title) {
                $section = Section::find($section_id);
                if ($section) {
                    $section->title = $section_title;
                    $section->save();
                }
            }
        }

        return redirect()->route('courses.edit', $id)->with('success', 'Course updated successfully');
    }

//    ------------------------------------------------
    public function viewCourseQuiz($id)
    {
        $course = Course::where('id', $id)->first();
        return view('website.course-quiz', compact('course'));
    }

    public function viewAllCourseDetails($id)
    {
        $course = Course::find($id);
        $sections = Section::where('course_id', $id)->get();
        $firstSection = $sections->first();

        // Get the first video from the first section
        $firstVideo = null;
        if ($firstSection && $firstSection->videos->isNotEmpty()) {
            $firstVideo = $firstSection->videos->first();
        }

        $videos = [];

// Loop through each section to retrieve its videos
        foreach ($sections as $section) {
            $sectionVideos = Video::where('section_id', $section->id)->get();
            $videos[$section->id] = $sectionVideos; // Store videos by section ID
        }
        $instructor = User::where('id', $course->user_id)->first();

        //Course progress

        $userId = auth()->id();
        $completedVideos = CourseProgress::where('user_id', $userId)
            ->where('course_id', $id)
            ->count();

        $videoCount = Video::whereHas('section', function ($query) use ($id) {
            $query->where('course_id', $id);
        })->count();

        // Calculate progress percentage
        $progress = ($completedVideos / $videoCount) * 100;


        //-----------------------------------------------------
        //// show course quizzes-------------------------------
        $quizzes = Quiz::where('course_id', $id)->get();


        return view('website.course_videos', compact('course', 'videos', 'firstVideo', 'sections', 'instructor', 'progress', 'quizzes'));
    }
//    ------------------------------------------------------------------------------

// Course Progress

    public function markVideoAsCompleted(Request $request, $id)
    {

        $request->validate([
            'course_id' => 'required|integer',
            'video_id' => 'required|integer',
        ]);

        // $user = auth()->user();
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $progress = CourseProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'course_id' => $request->course_id,
                'video_id' => $request->video_id,
            ],
            [
                'status' => true,
                'updated_at' => now(),
            ]
        );
        return response()->json(['success' => 'Video marked as completed'], 200);
    }

    public function certificateShow($id)
    {
        $user = auth()->user();
        $course = Course::where('id', $id)->first();
        $instructor = User::where('id', $course->user_id)->first();
        $date = CourseProgress::where('course_id', $id)->where('user_id', $instructor->id)->latest()->first();
        $currentDate = $date->created_at;
        return view('website.certificate', compact('course', 'user', 'instructor', 'currentDate'));
    }

    public function viewEnrollFree($id)
    {
        return view('website.course-enroll-free', compact('id'));
    }

    public function enrollFree(Request $request)
    {
        $id = $request->input('id');
        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $id,
            'status' => true,
        ]);

        return redirect()->route('course_details', $id)->with('success', 'Enrollment successful!');
    }

    // Show instructor students
    public function showMyStudents()
    {
        // Get the logged-in instructor (replace with your logic for getting the instructor)
        $instructor = auth()->user();

        // Fetch instructor's courses
        $courses = $instructor->courses()->with(['enrollments.student'])->get();
        return view('website.instructor-students',compact('courses'));
    }


    //Delete course

    public function deleteCourse($courseId)
    {
        // Find the course with its related sections, quizzes, and other associations
        $course = Course::with([
            'sections.videos', // Eager load sections and their videos
            'quizzes.questions', // Eager load quizzes and their questions
            'quizzes.userAnswers' // Eager load user answers to quizzes
        ])->findOrFail($courseId);

        // Check if the course has sections and delete related videos
        if ($course->sections) {
            foreach ($course->sections as $section) {
                if ($section->videos) {
                    $section->videos()->delete();
                }
            }
            $course->sections()->delete();
        }

        // Check if the course has quizzes and delete related questions and user answers
        if ($course->quizzes) {
            foreach ($course->quizzes as $quiz) {
                if ($quiz->questions) {
                    $quiz->questions()->delete();
                }
                if ($quiz->userAnswers) {
                    $quiz->userAnswers()->delete();
                }
            }
            $course->quizzes()->delete();
        }

        // Finally, delete the course itself
        $course->delete();

        return redirect()->back()->with('success', 'Course and all related data were deleted successfully.');
    }

    // Delete from Website
    public function deleteCourseFromWebsite($courseId)
    {

        $course = Course::find($courseId);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Update course details
        if($course->is_deleted == 0) {
            $course->is_deleted = 1;
        }
        else
        {
            $course->is_deleted = 0;
        }

        $course->save();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}



