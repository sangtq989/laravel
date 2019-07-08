<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin;

class AccountController extends Controller
{
	public function viewLogin()
	{
		return view('admin.account.login');
	}
	public function handleLogin(Request $request, admin $admin)
	{
		//dd($request->all());
		$user = $request->email;
		$pass = $request->password;
		if ($user && $pass) {
			//xu ly dang nhap'
			$data = $admin->loginAdmin($user, $pass);

			if ($data) {
				//luu thong tin vao trong session
				//vao trang dashbroad
				$request->session()->put('username', $data['username']);
				//~~ $_SESSION['username'] = data['username']
				$request->session()->put('email', $data['email']);
				$request->session()->put('id', $data['id']);
				return redirect()->route('admin.dashboard');

			}else{
				//quay ve trang dang nhap
				return redirect()->route('admin.viewLogin',['state'=>'wrongUsernamePass']);
			}
		}else{
			return redirect()->route('admin.viewLogin',['state'=>'fail']);
		}
	}
	public function logOut(Request $request)
	{
		//xoa het session va tro ve form login
		$request->session()->forget('username');
		$request->session()->forget('email');
		$request->session()->forget('id');
		return redirect()->route('admin.viewLogin');
	}
    //
}
