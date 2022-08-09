<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
/**
 * Class UserService.
 */
class UserService
{
    public static function handleUploadImage($avatar, $id)
    {
        $get_image = $avatar;
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        $path = $get_image->storeAs('public/profile', $new_image);

        $data = [
            'avatar' => 'storage/profile/' . $new_image,
        ];

        $user = User::find($id);
        $user->update($data);
    }
}
