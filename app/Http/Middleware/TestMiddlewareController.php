<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddlewareController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $myage = null)
    {
        dd($myage);
        $myName = $request->name;
        if ($myName != 'admin') {
           return redirect('test-num');
        }
        return $next($request);
    }
}
