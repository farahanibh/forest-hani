<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$user_type)
    {
        if (in_array($request->user()->user_type, $user_type)){
            return $next($request);
        }
        return redirect('/');
    }
}
