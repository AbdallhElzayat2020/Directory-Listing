<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileHandler
{
    public function uploadFile(Request $request, string $input, ?string $oldFile, string $disk): ?string
    {

        if (!$request->hasFile($input)) {
            return $oldFile;
        }

        if ($oldFile && Storage::disk($disk)->exists($oldFile)) {
            Storage::disk($disk)->delete($oldFile);
        }

        $file = $request->file($input);

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('', $fileName, $disk);

        return $fileName;
    }


//    public function uploadFiles(Request $request, string $input, ?string $oldFile, string $disk)
//    {
//        if ($request->hasFile($input)) {
//            foreach ($request->file($input) as $file) {
//                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
//                $file->storeAs('', $fileName, $disk);
//            }
//        }
//    }

//--------------------
    function deleteFile(?string $fileName, string $disk): bool
    {

        if (!$fileName) {
            return false;
        }

        if (Storage::disk($disk)->exists($fileName)) {
            return Storage::disk($disk)->delete($fileName);
        }

        return false;
    }
}
