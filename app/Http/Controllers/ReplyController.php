<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReplyRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function store(StoreReplyRequest $request)
    {
        $reply = Comment::create([
            'user_id' => auth()->user()->id,
            'course_id' => $request['course_id'],
            'comment' => $request['comment'],
            'parent_id' => $request['parent_id'],
        ]);
        $reply->save();
        return redirect()->back()->with('success', __('comment.comment_success'));
    }
}
