<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $age = $request->age;
        //tro vao param cua route tren url
        if ($age<18) {
            return redirect('/');
        }
        // cho phep thuc thi cac request tiep theo
        return $next($request);
    }
}
