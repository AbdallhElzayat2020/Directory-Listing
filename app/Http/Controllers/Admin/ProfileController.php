<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use FileHandler;

    public function index(): View
    {
        $profile = Auth::user();
        return view('admin.profile.index', [
            'profile' => $profile
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = Auth::user();
        $oldAvatar = $user->avatar;
        $oldBanner = $user->banner;


        $data = $request->validated();


//        if ($request->hasFile('avatar')) {
//
//            if ($oldAvatar && $data['avatar']) {
//                Storage::disk('avatars')->delete($oldAvatar);
//            }
//
//            $file = $request->file('avatar');
//            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
//            $file->storeAs('', $filename, 'avatars');
//            $data['avatar'] = $filename;
//        }

//        if ($request->hasFile('banner')) {
//
//            if ($oldBanner && $data['banner']) {
//                Storage::disk('banners')->delete($oldBanner);
//            }
//
//            $file = $request->file('banner');
//            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
//            $file->storeAs('', $filename, 'banners');
//            $data['banner'] = $filename;
//        }

        $data['avatar'] = $this->uploadFile($request, 'avatar', $oldAvatar, 'avatars');
        $data['banner'] = $this->uploadFile($request, 'banner', $oldBanner, 'banners');
        $user->update($data);


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


}
