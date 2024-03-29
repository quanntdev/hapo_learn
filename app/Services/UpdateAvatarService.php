<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Class UpdateAvatarService.
 */
class UpdateAvatarService
{
    public function UpdateAvatarService($avatar, $id)
    {
        $getNameImage = $avatar->getClientOriginalName();
        $nameImage = current(explode('.', $getNameImage));
        $accessToken = now()->timestamp;
        $nameImage = $nameImage . $accessToken . '.' . $avatar->getClientOriginalExtension();
        $avatar->storeAs(config('user.avatar_path'), $nameImage);

        $data = [
            'avatar' => config('user.storage_path') . $nameImage,
        ];

        $user = User::find($id);
        $user->update($data);
    }
}
