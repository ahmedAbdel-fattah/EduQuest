<?php

namespace App\Http\Controllers;

use App\Models\AdVideo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdVideoController extends Controller
{
    public function index()
    {
        $adVideo = AdVideo::all();

        return view('admin.adVideo-controll', compact('adVideo'));
    }

    public function add_Video(){
        $adVideo = AdVideo::all();
        return view('admin.adVideo-add', compact('adVideo'));
    }

    public function store(Request $request)
{
    // التحقق من صحة البيانات المدخلة
    $request->validate([
        'description' => 'required|max:20000',
        'video' => 'required|mimes:mp4,avi,mov|max:200000', // التأكد من أن الملف هو فيديو بصيغة صحيحة
    ]);

    // التحقق من أن هناك فيديو مرفوع
    if ($request->hasFile('video')) {
        // الحصول على الملف المرفوع
        $video = $request->file('video');

        // إنشاء اسم فريد للفيديو باستخدام الوقت والامتداد الصحيح
        $videoName = time() . '.' . $video->getClientOriginalExtension();

        // نقل الفيديو إلى مجلد 'videos' داخل 'public'
        $video->move(public_path('videos'), $videoName);

        // حفظ الوصف واسم الفيديو فقط في قاعدة البيانات
        AdVideo::create([
            'description' => $request->description,
            'video' => $videoName, // تخزين اسم الفيديو في قاعدة البيانات
        ]);

        // إرجاع رسالة نجاح
        return back()->with('success', 'Video uploaded successfully.');
    }

    // في حالة عدم وجود فيديو، إعادة التوجيه مع رسالة
    return redirect()->route('about')->with('error', 'No video uploaded.');
}



    public function edit($id){
        $user = User::all();
        $adVideo = AdVideo::findOrFail($id);
        return view('admin.videoEdit' ,compact('adVideo','user'));
    }

    public function update(Request $request, $id)
{
    // تحقق من صحة البيانات المُدخلة
    $request->validate([
        'description' => 'required',
        'video' => 'required|mimes:mp4,avi,mov|max:20000', // التحقق من صيغة وحجم الفيديو
    ]);

    // جلب الفيديو من قاعدة البيانات
    $adVideo = AdVideo::findOrFail($id);

    if ($adVideo) {
        // تحقق من وجود الفيديو القديم وحذفه
        if ($adVideo->video && Storage::disk('public')->exists('videos/' . $adVideo->video)) {
            Storage::disk('public')->delete('videos/' . $adVideo->video);
        }

        // تخزين الفيديو الجديد في مجلد "videos" داخل مجلد "public"
        $newVideoName = time() . '.' . $request->file('video')->getClientOriginalExtension();
        $request->file('video')->move(public_path('videos'), $newVideoName);

        // تحديث البيانات في قاعدة البيانات
        $adVideo->update([
            'description' => $request->description, // تحديث الوصف
            'video' => $newVideoName, // تخزين اسم الفيديو الجديد فقط
        ]);

        return redirect()->route('adVideo-controll')->with('success', 'Video updated successfully.');
    } else {
        return response()->json(['error' => 'Video not found'], 404);
    }
}

public function delete_video($id){
    $adVideo = AdVideo::findOrFail($id);
    $adVideo->delete();
    return redirect()->back()->with('success','deleted successfully');
}
}
