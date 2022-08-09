<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lesson;

class JoinLesson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lesson = Lesson::find($request['lesson_id']);
        if ($lesson->isJoined()) {
            return redirect('home');
        }
        return $next($request);
    }
}
