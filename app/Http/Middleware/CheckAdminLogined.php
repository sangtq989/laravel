<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLogined
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
        $user = $request->session()->get('username');
        $id = $request->session()->get('id');
        if (!$this->adminIsLogined($id,$user)) {
           return redirect()->route('admin.viewLogin');
           //NGAN TRUY CAP VAO DASHBOARD KHI CHUA LOGIN
        }
        return $next($request);
    }
    private function adminIsLogined($id, $user){
        $id = (is_numeric($id) && $id>0)? true : false;
        $user = empty($user) ? false : true;
        if ($id && $user) {
           return true;
        }
        return false;
    }
}
