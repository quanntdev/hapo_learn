<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'course_id' => $request['course_id'],
            'comment' => $request['comment'],
            'star' => $request['star'],
        ]);
        $comment->save();
        return redirect()->back()->with('success', __('comment.comment_success'));
    }
}
