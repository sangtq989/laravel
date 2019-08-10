<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Helper\Common\BuildTreeCate;
use Illuminate\Support\Facades\Route;
use App\Models\Categories;
use App\Models\Tags;
use App\Models\Posts;

class FrontendController extends Controller
{
	public function __construct(Categories $cate, Tags $tag, Posts $post)
	{
		$data = [];
		$data['name'] = 'sang blog';
		$data['age'] = 28;
		$listCate=DB::table('categories')
		->where('status',1)
		->get();
		$listCate=json_decode(json_encode($listCate),true);
		$data['cates'] = BuildTreeCate::layoutTreeCategory($listCate);
		$data['listCate'] = $cate->countPostCategories();
		$data['listTag'] = $tag->getAllDataTags();	    
	    $data['mostViewsPost'] = $post->mostViewPosts(); 
		// dd($data['listCate']);
    	//dd($listCate);
    	//share du lie cho tat ca view dung chung
    	//kiem tra neu la trang chu home thi moi hien slider
    	$data['homePage'] = Route::currentRouteName();

		View::share('info',$data);
	}
}
