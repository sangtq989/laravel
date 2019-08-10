<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Posts;

class DetailController extends FrontendController
{
	public function index($slug,$id, Request $request, Posts $posts)
	{
    	// dd($slug,$id)
		$id=is_numeric($id) ? $id : 0;
		$slug=strip_tags($slug);
		$info = $posts->getDataPostById($id);
		$tag = $posts->getDataTagsByPostsId($id);
		$relatedPost = $posts->getDataRelatedPost($id,$info['categories_id']);
    	//dd($relatedPost);
    	// dd($info);
		if ($info) {
			$data = [];
			$data['detail']=$info;
			$data['tag'] = $tag;
			$data['relatedPost'] =$relatedPost;
    		//
			return view('frontend.detail.index',$data);
		} else {
    		//chuyen sang 404
    		# code...
		}

	}
	public function updateView($id, Request $request,Posts $post)
	{
		$id = is_numeric($id) ? $id :0;
		$detail = Posts::find($id);
		if ($detail) {
			$count = $detail->view_count;

			$post->updateCountView($id,$count);
    		# code...
		}

	}
}
