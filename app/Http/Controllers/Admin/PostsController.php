<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tags;
use App\Http\Requests\StorePosts as Posts;
use voku\helper\AntiXSS;

class PostsController extends Controller
{
    public function index()
    {
    	return view('admin.posts.list-post');
    }
    public function createPosts(Category $cat ,Tags $tag)
    {
    	//lay all data tu bang categories
    	
    	$data =[];
    	$data['cate'] = $cat->getAllDataCategories();
    	$data['tag'] = $tag->getAllDataTags();
   		return view('admin.posts.create-post',$data);
    }
    public function handleCreatePost(Posts $request)
    {
    	//dd($request->all());
        $title = $request->titlePost;
        $sapoPost = $request->sapoPost;
        $contentPost = $request->contentPost;
        $language=$request->language;
        $categories =$request->categories;
        $tag = $request->tags;
        //anh dai dien

        $avatar = $request->avatarPost;

    }
}
