<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Jobs\ResetPassword;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user) {
            $newPassword = Str::random(8);
            $user->password = Hash::make($newPassword);
            $user->save();
            ResetPassword::dispatch($email, $newPassword);
            return redirect()->route('login')->with('success_reset', 'Password reset successfully');
        } else {
            return redirect()->route('password.request')->with('error', 'Email not found');
        }
    }
}
