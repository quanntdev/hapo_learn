<?php

namespace App\Http\Middleware;

use App\Models\Program;
use Closure;
use Illuminate\Http\Request;

class LearnProgram
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
        $program = Program::find($request['program_id']);
        if ($program->isLearnedPrograms) {
            return redirect('home');
        }
        return $next($request);
    }
}
