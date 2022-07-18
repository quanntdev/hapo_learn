<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\UserCourse;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);

        $courses = Course::whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();

        return view('layouts.profile')->with(compact('user','courses'));
    }
}
