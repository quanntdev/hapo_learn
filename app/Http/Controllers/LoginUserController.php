<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class LoginUserController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $message = [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự'
        ];

        $validator = validator($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $email = $request->input('email');
            $password = md5($request->input('password'));

            $user = User::where('email', $email)->where('password', $password)->first();

            $minutes = 3600*10*10;
            $password_cookie = cookie('password', $password, $minutes);
            $email_cookie = cookie('email', $email, $minutes);

            if(isset($user)) {
                Auth::login($user);
                return redirect()->route('home')->withCookie($password_cookie)->withCookie($email_cookie);
            } else {
                return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
            }
        }
    }
}
