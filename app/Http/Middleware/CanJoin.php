<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Course;
use Illuminate\Http\Request;

class CanJoin
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
        $course = Course::find($request['course_id']);
        if ($course->isJoined) {
            return redirect('home');
        }
        return $next($request);
    }
}
