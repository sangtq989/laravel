<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Posts;
use App\Models\Categories;

class CategoryController extends FrontendController
{
    public function index($slug,$id, Request $request,Posts $post,Categories $cate)
    {
    	$id = is_numeric($id) ? $id : 0;
    	$paginate = $post->getDataPostByCateID($id);
    	$infCate = $cate->getDataCateById($id);
    	// dd($infCate);
    	$mainData = json_decode(json_encode($paginate),true);
    	// dd($slug,$id);

    	$data =[];
    	$data['listCate'] = $mainData['data'] ?? [];
    	$data['paginate'] = $paginate;
    	$data['infoCate'] = $infCate;
    	$data['slug'] = $slug;
    	// dd($mainData);

    	return view('frontend.category.index',$data);
    }
}
