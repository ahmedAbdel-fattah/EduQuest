<?php

namespace App\Http\Controllers;

use App\Models\AdVideo;
use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class AboutController extends Controller
{
    public function about()
    {
        $adVideo = AdVideo::all();
        $developers = Developer::all();
        if (!$adVideo) {
            // إذا لم يتم العثور على فيديو، يمكنك عرض رسالة أو محتوى بديل
            return view('website.about')->with('message', 'لم يتم العثور على فيديو.');
        }
        return view('website.about', compact('adVideo','developers'));
    }

    public function edit($id){
        $user = User::all();
        $developer=Developer::findOrFail($id);
        return view('admin.aboutEdit' ,compact('developer','user','id'));
    }
    public function update(Request $request, $id){
        $developer=Developer::findOrFail($id);
        if ($request->hasFile('image')) {
            
            // $product = Product::findOrFail($id);
            // $productImage = $request->file('image');
            $image =  time() . '.' . $request->image->extension();
            $request->image->move(public_path('developers'), $image);
            $image = 'developers/' . $image;
            $developer->update([
                'image'  => $image,
            ]);
        }
        $name = request()->name;
        $role = request()->role;
        $facebook = request()->facebook;
        $linkedin = request()->linkedin;
        $github = request()->github;
        $email = request()->email;

        $developer->update([
            'name'  => $name,
            'role'  => $role,
            'facebook'  => $facebook,
            'linkedin'  => $linkedin,
            'github'  => $github,
            'email'  => $email,
        ]);
        return to_route('show.developers', compact('id','developer'));

    }

    public function create()
    {

        $users = User::all();

        return view('admin.createDeveloper', [
            'users' => $users,
            
    ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|nullable|string',
            'role' => 'required|nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook' => 'required|nullable|string',
            'linkedin' => 'required|nullable|string',
            'github' => 'required|nullable|string',
            'email' => 'required|nullable|string',
        ]);

        $image =  time() . '.' . $request->image->extension();
        $request->image->move(public_path('developers'), $image);

        $name = request()->name;
        $role = request()->role;
        $image = 'developers/' . $image;
        $facebook = request()->facebook;
        $linkedin = request()->linkedin;
        $github = request()->github;
        $email = request()->email;

        Developer::create([
            'name'  => $name,
            'role'  => $role,
            'image'  => $image,
            'facebook'  => $facebook,
            'linkedin'  => $linkedin,
            'github'  => $github,
            'email'  => $email,
        ]);

        return to_route('show.developers', compact('image'));
    }

    public function destroy($id)
    {

        $developer = Developer::findOrFail($id);
        $developer->delete();

        return to_route('show.developers', $id);
    }
    

    
   

}
