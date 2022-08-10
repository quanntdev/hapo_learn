<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UpdateAvatarService;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        $course = $user->courses()->get();
        return view('user.show', compact('user', 'course'));
    }

    protected $updateImage;

    public function __construct()
    {
        $this->updateImage = new UpdateAvatarService();
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

        if ($request['avatar'] != null) {
            $this->updateImage->handleUploadImage($request['avatar'], $id);
        }

        return redirect()->back()->with('success', __('user.update_success'));
    }
}
