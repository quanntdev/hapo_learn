<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginHapoController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

       dd($data);
    }
}
