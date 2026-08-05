<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        return view('admin.setting.index');
    }

    // public function update(UpdateSettingRequest $request)
    // {

    //     foreach ($request->validated() as $key => $value) {
    //         Setting::updateOrCreate(
    //             ['key' => $key],
    //             [
    //                 'key' => $key,
    //                 'value' => $value,
    //             ]
    //         );
    //     }

    //     $settingService = app(SettingService::class);
    //     $settingService->clearCachedSettings();

    //     return redirect()->back()
    //         ->with('success', 'Updated Successfully');
    // }


    public function update(UpdateSettingRequest $request, SettingService $settingService)
    {
        foreach ($request->validated() as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingService->clearCachedSettings();

        return redirect()->back()->with('success', 'Updated Successfully');
    }
}
