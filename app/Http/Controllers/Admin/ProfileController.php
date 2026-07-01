<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
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

        $data = $request->validated();

        $oldAvatar = $user->avatar;
        $oldBanner = $user->banner;

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $filename, 'avatars');
            $data['avatar'] = $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('', $bannerName, 'banners');
            $data['banner'] = $bannerName;
        }
        $user->update($data);

        if (isset($data['avatar']) && $oldAvatar) {
            Storage::disk('avatars')->delete($oldAvatar);
        }
        if (isset($data['banner']) && $oldBanner
        ) {
            Storage::disk('banners')->delete($oldBanner);
        }
    }
}
