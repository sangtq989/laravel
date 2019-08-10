<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use voku\helper\AntiXSS;
use App\Models\Posts;

class SearchController extends FrontendController
{
   	public function index(Request $request,AntiXSS $xss,Posts $post)
   	{
   		$keyword = $request->q;
   		$keyword = $xss->xss_clean($keyword);
   		$listPost = $post->getDataPostByKeyword($keyword);
   		$mainData = json_decode(json_encode($listPost),true);
   		$data['ltsSearch'] = $mainData['data'] ?? [];
   		$data['keyword'] = $keyword;
   		$data['paginate'] = $listPost;
   		return view('frontend.search.index',$data);

   	}
}
