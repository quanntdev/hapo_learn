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
        $course = auth()->user()->courses;
        return view('profile.index', compact('course'));
    }

    public function update(UpdateUserProfileRequest $request, $id)
    {
        $data = $request->except('avatar');
        auth()->user()->update($data);

        if ($request['avatar'] != null) {
            $this->updateImage->UpdateAvatarService($request['avatar'], $id);
        }

        return redirect()->back()->with('success', __('user.update_success'));
    }
}
