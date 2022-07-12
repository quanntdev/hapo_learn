<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;


class LogoutUserController extends Controller
{
    public function index()
    {
        Auth::logout();
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('password'));
        return redirect()->route('home');
    }
}
