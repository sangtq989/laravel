<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index(Request $request)
    {
    	// $username=$request->session()->get('username');
    	// $email=$request->session()->get('email');
    	// $id=$request->session()->get('id');
    	return view('admin.dashboard.index');
    }
}
