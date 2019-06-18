<?php

namespace App\Http\Middleware;

use Closure;

class checkNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $params = null)
    {
        //in param ra test
        dd($params);
        //sau do co the xu ly cho param
        $respone =  $next($request); //dat mot bien respone
        //after middleware
        //kiem tra cac tham so cua router sau
        $myNumber = $request->number;
        if ($myNumber%2 != 0 ) {
           return redirect('test-num');
        }

        return $respone;
    }
}
