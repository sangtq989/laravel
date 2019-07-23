<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Models\Posts;

class HomeController extends FrontendController
{
    public function index(Posts $posts)
    {
    	$data=[];
    	$data['topPosts'] = $posts->getTopPostsFocus();
    	$arrIdTopPost=array_column($data['topPosts'],'id');
    	$lastestPosts = $posts->getLastesPostsBypage($arrIdTopPost);

    	$mainData = json_decode(json_encode($lastestPosts),true);

    	$data['lastestPosts'] = $mainData['data'] ?? [];
    	$data['paginate'] = $lastestPosts;
    	// dd($data['lastestPost'] );
    	return view('frontend.home.index',$data);
    	# code...
    }

}
