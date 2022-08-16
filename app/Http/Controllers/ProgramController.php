<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Lesson;
use App\Models\User;
use App\Http\Requests\CreateProgramsRequest;
use App\Models\UserProgram;
use Illuminate\Support\Facades\Gate;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProgramsRequest $request)
    {
        if(Gate::allows('view', auth()->user())) {
            $data = $request->all();
            Program::create($data);
            return redirect()->back()->with('success', __('program.create_success'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProgramsRequest $request, $id)
    {
        if(Gate::allows('view', auth()->user())) {
            $data = $request->all();
            Program::find($id)->update($data);
            UserProgram::where('program_id', $id)->delete();
            return redirect()->back()->with('success', __('program.update_success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        if(Gate::allows('view', auth()->user())) {
            $program->delete();
            return redirect()->back()->with('success', __('program.delete_success'));
        }
    }
}
