<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Lesson;
use Illuminate\Http\Request;

class SeeLesson
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
        $request->route()->parameters();
        $slug = $request['lesson'];
        $lesson = Lesson::with('users', 'course', 'programs')->where('slug_lesson', $slug)->firstOrFail();
        if (!$lesson->course->isJoined) {
            return redirect('home');
        }
        return $next($request);
    }
}