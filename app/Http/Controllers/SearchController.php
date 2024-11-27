<?php
namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search across multiple models
        $courses = Course::where('title', 'LIKE', "%{$query}%")->where('is_accepted',1)->get();
        $subjects = Category::where('description', 'LIKE', "%{$query}%")->get();
        $users = User::where('name', 'LIKE', "%{$query}%")->where('is_instructor',1)->get();
        $faqs = Faq::where('question', 'LIKE', "%{$query}%")->get();

        // Pass the results to the view
        return view('website.search-result', compact('courses', 'subjects', 'users','faqs', 'query'));
    }
}

