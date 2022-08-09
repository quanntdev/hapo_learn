<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UserService;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $course = $user->courses()->get();
        return view('user.show' , compact('user', 'course'));
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

    protected $updateImage;

    public function __construct()
    {
        $this->updateImage = new UserService();

    }
    public function update(UpdateUserProfileRequest $request, $id)
    {
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'about_me' => $request['about_me'],
            'date_of_birth' => $request['date_of_birth'],
        ];

        $user = User::find($id);
        $user->update($data);

        if($request['avatar'] != null) {
            $this->updateImage->handleUploadImage($request['avatar'], $id);
        }

        return redirect()->back()->with('success', __('user.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
