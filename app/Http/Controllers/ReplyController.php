<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReplyRequest;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'course_id' => $request['course_id'],
            'comment' => $request['comment'],
            'parent_id' => $request['parent_id'],
        ];

        Comment::create($data);

        return redirect()->back()->with('success', __('comment.comment_success'));
    }

    public function update(StoreReplyRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return redirect()->back()->with('success', __('comment.comment_success'));
    }
}
