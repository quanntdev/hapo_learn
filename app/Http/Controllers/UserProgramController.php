<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserProgramsRequest;
use App\Models\Program;

class UserProgramController extends Controller
{
    public function store(StoreUserProgramsRequest $request)
    {
        $program = Program::find($request['program_id']);
        $program->users()->attach(auth()->user()->id);
        return redirect()->back()->with('success', __('program.succes'));
    }
}
