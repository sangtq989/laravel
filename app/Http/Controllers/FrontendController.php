<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Helper\Common\BuildTreeCate;

class FrontendController extends Controller
{
    public function __construct()
    {
    	$data = [];
    	$data['name'] = 'sang blog';
    	$data['age'] = 28;
    	$listCate=DB::table('categories')
    		->where('status',1)
    		->get();
    	$listCate=json_decode(json_encode($listCate),true);
    	$data['cates'] = BuildTreeCate::layoutTreeCategory($listCate);
    	 	
    	//dd($listCate);
    	//share du lie cho tat ca view dung chung
    	View::share('info',$data);
    }
}
