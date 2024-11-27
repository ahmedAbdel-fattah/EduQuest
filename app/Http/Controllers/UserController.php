<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\BeInstructorAnswer;
use App\Models\BeInstructorQuestion;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $data = User::orderBy('last_seen','DESC')->get();
        return view('admin.users',compact('data'));
    }

    public function destroy($id){
        $data = User::findOrFail($id);
        if($data->id == Auth::user()->id){
            return redirect()->back()->with('message','you cant remove yourself');
        }

        else
        $data->delete();
        return redirect()->back()->with('message','removed successfully');
    }

    public function user_info_to_admin($id){
        $user = User::findOrFail($id);

        $user_enroll = Enrollment::where('user_id',$id)->count();

        $user_reviews = Review::where('user_id',$id)->count();




        return view('admin.user_data',compact('user','user_enroll','user_reviews'));

    }


    public function add_admin($id){
        $admin = User::findOrFail($id);
        $admin->update(['is_admin'=> 1]);
        $admin->save();
        return redirect()->back()->with('message','successfully added');
    }

    public function drop_admin($id){
        $admin = User::findOrFail($id);
        if($admin->where('is_admin',1)->count() < 2)
        {
            return redirect()->back()->with('message','their must be at least one admin');
        }
        else
        {

            $admin->update(['is_admin'=> 0]);
            $admin->save();
            return redirect()->back()->with('message','successfully droped');
        }
    }
}
