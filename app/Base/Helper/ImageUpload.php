<?php

namespace App\Base\Helper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public static function uploadImage($image, $path = 'uploads/')
    {
        $imageName = Str::uuid() .  '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put($path . $imageName, file_get_contents($image));


        return 'storage/' . $path . $imageName;
    }
}
