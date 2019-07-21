<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;

class HomeController extends FrontendController
{
    public function index()
    {
    	return view('frontend.home.index');
    	# code...
    }
}
