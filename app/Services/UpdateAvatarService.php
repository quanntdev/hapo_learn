<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;

/**
 * Class UpdateAvatarService.
 */
class UpdateAvatarService
{
    public static function handleUploadImage($avatar, $id)
    {
        $getNameImage = $avatar->getClientOriginalName();
        $nameImage = current(explode('.', $getNameImage));
        $nameImage = $nameImage . rand(0, 999) . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs(config('user.avatar_path'), $nameImage);

        $data = [
            'avatar' => config('user.storage_path') . $nameImage,
        ];

        $user = User::find($id);
        $user->update($data);
    }
}
