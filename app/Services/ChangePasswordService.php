<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class ChangePasswordService.
 */
class ChangePasswordService
{
    public function ChangePasswordService($oldPassword, $newPassword)
    {
        $user = User::find(auth()->user()->id);
        if (Hash::check($oldPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return true;
        } else {
            return false;
        }
    }
}
