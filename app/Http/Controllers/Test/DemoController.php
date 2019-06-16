<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemoController extends Controller
{
   public function index()
   {
   		return redirect()->route('admin.prf');
   }
}
