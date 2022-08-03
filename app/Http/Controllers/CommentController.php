<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'course_id' => $request['course_id'],
            'comment' => $request['comment'],
            'star' => $request['star'],
            'parent_id' => $request['parent_id'],
        ];

        Comment::create($data);
        return redirect()->back()->with('success', __('comment.comment_success'));
    }

    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        return redirect()->back()->with('success', __('comment.comment_success'));
    }
}
