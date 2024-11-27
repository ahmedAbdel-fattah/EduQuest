<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Traits\upload_image;


class CategoryController extends Controller
{
    use upload_image;
    public function categories()
    {
        $categories = Category::all();
        return view('website/categories', compact('categories'));
    }
    public function home()
    {
        $categories = Category::limit(4)->get();
        return view('website/index', compact('categories'));
    }
    public function index_category()
    {
        return view('admin.admin-addcategory');
    }
    public function categories_table()
    {
        $categories = Category::all();
        return view('admin.admin-categories', compact('categories'));
    }
    public function create_category(Request $request){
        $request->validate([
            'name' => 'required|max:255|string|min:5',
            'description' => 'required|max:255|string|min:5',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ]);
        $categories = Category::all();
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('public/images'), $imageName);
        $name = $request->input('name');
        $description = $request->input('description');
        $category = new Category;
        $category->name=$name;
        $category->description=$description;
        $category->image=$imageName;
        $category->save();
        return redirect()->back()->with('success','successfully added');
    }


    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        return view('admin/admin-editcategory', compact('category'));
    }


    public function update_category(Request $request, $id)
    {
            $request->validate([
                'name' => 'required|max:255|string|min:5',
                'description' => 'required|max:255|string|min:5',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $category = Category::findOrFail($id);
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('public/images'), $imageName);
                $category->image = $imageName;
            }
            $category->save();
            $categories = Category::all();
            return redirect()->route('categories',compact('categories'));
    }
    public function delete_category($id){
        $categories = Category::all();
        $updated_category = Category::find($id);
        $updated_category->delete();
        return redirect()->route('categories_table');
    }
    public function show($id)
    {
        $category = Category::find($id);
        $courses = Course::where("category_id",$id)->get();
        return view('website/category-courses', compact('category', 'courses'));
    }
}
