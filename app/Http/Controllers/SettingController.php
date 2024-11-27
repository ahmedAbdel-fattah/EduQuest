<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;

class SettingController extends Controller
{

    public function __construct()
    {
        // تطبيق middleware على جميع الدوال باستثناء index و show
        $this->middleware(['auth','Admin'])->except('settingshow');
    }

    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        Setting::create($request->all());
        return redirect()->route('settings.index')->with('success', 'Contact information added successfully.');
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $setting->update($request->all());
        return redirect()->route('settings.index')->with('success', 'Contact information updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Contact information deleted successfully.');
    }

    public function settingshow()
    {
        // Fetch all settings
        $settings = Setting::all(); // This retrieves all settings from the database

        // Pass the settings to the view
        return view('website.contact', compact('settings')); // Replace 'your-view-name' with the actual view file name
    }

    public function dashboard()
    {
        // Retrieve users from the database
        $users = User::all(); // Fetch all users

        // Pass the data to the new dashboard view
        return view('admin.layouts.dash', compact('users')); // Adjusted path if necessary
    }

}

