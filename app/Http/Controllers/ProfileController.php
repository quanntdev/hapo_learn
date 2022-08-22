<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UpdateAvatarService;

class ProfileController extends Controller
{
    protected $updateImage;

    public function __construct()
    {
        $this->updateImage = new UpdateAvatarService();
    }

    public function index()
    {
        $user = User::find(auth()->id());
        $course = $user->courses()->get();
        return view('profile.index', compact('user', 'course'));
    }

    public function update(UpdateUserProfileRequest $request, $id)
    {
        $user = User::find(auth()->id());
        $user->update($request->all());

        if ($request['avatar'] != null) {
            $this->updateImage->handleUploadImage($request['avatar'], $id);
        }

        return redirect()->back()->with('success', __('success.update_success'));
    }
}
