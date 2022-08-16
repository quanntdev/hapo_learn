<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateImageService.
 */
class UpdateImageService
{
    public function handleUploadImage($avatar, $id)
    {
        $getNameImage = $avatar->getClientOriginalName();
        $nameImage = current(explode('.', $getNameImage));
        $accessToken = Str::random(40);
        $nameImage = $nameImage . $accessToken . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs(config('course.image_path'), $nameImage);
        return config('course.storage_path') . $nameImage;
    }
}
