<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class SeeProfile
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
        $user = $request['profile'];
        if ($user != auth()->id()) {
            return redirect( route('profile.show', auth()->id()));
        }
        return $next($request);
    }
}
