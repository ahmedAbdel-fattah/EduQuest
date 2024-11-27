<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        
        return view('admin.admin-developers', compact('developers'));
    }
    

}
