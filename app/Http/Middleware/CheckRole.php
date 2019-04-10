<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,...$roles)//...(menandakan bisa banyak)
    {
        if (in_array($request->user()->role,$roles)) {
            return $next($request);
        }
        // return redirect('/');
        return abort(404);
    }
}
