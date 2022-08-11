<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Jobs\RegisterMailler;

class SendMailController extends Controller
{
    public function store(RegisterFormRequest $request)
    {
        $data = $request->all();
        $code = rand(100000, 999999);
        RegisterMailler::dispatch($data, $code);
        return view('mail.confirm', compact('data', 'code'));
    }
}
