<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Posts extends Model
{
	protected $table = 'posts';

	public function categories()
	{
		return $this->belongsTo('App\Models\Categories','categories_id');
	}
	public function getTopPostsFocus()
	{
		# chi lay ra 3 bai viet moi nhat gom ten, danh muc, thumbnail, tac gia
		$posts = DB::table('posts as p')
			->select('p.id','p.title','p.sapo','p.publish_date','p.avatar','c.id as cate_id','c.name','a.username','a.id as user_id')
			->join('categories as c','c.id','=','p.categories_id')
			->join('admin as a','a.id','=','p.user_id')
			->where('p.status',1)
			
			->limit(3)
			->orderBy('p.publish_date','DESC')
			->get();		
		$posts = json_decode(json_encode($posts),true);
		return $posts;
	}
	public function getLastesPostsBypage($arrId = [])
	{
		//lay ra cai bai moi vet ko trung voi 3 bai tren slider
		//$arrId : la ay 3 id cua 3 bai viet noi bat
		
		$posts = DB::table('posts as p')
			->select('p.id','p.title','p.slug','p.sapo','p.publish_date','p.avatar','a.username','a.id as user_id')
			->join('admin as a','a.id','=','p.user_id')
			->where('p.status',1)
			->whereNotIn('p.id',$arrId)		
			->orderBy('p.publish_date','DESC')
			->paginate(5);		
		
		return $posts;
	}
	public function mostViewPosts()
	{
		$post = Posts::select('id','title','publish_date','avatar','view_count')
				->where('status',1)
				->orderBy('view_count','DESC')
				->limit(3)
				->get();

		// $post = DB::table('posts as p')
		// ->select('p.id','p.title','p.publish_date','p.avatar','p.view_count')
		// ->where('p.status',1)
		// ->orderBy('p.view_count','DESC')
		// ->limit(3)
		// ->get();


		//$post =json_decode(json_encode($post),true);
		$post = ($post) ? $post->toArray() : [];
		return $post;
		
	}
	public function getDataPostById($id)
	{
		$data=Posts::select('posts.id','posts.title','posts.categories_id','posts.sapo','posts.publish_date','posts.avatar','posts.slug','c.content_web','categories.name as cate_name','admin.username')
		->join('contents as c','c.post_id','=','posts.id')
		->join('categories','categories.id','=','posts.categories_id')
		->join('admin','admin.id','=','posts.user_id')
		->where('posts.id',$id)
		->where('posts.status',1)
		->first();
		$data = ($data) ? $data->toArray() : [];
		return $data;
	}


	public function getDataTagsByPostsId($id)
	{
		$data =DB::table('tags as t')
		->select('t.name as name_tag','t.id as tag_id','t.slug as slug_tag')
		->join('post_tag as pt','pt.tag_id','=','t.id')
		->where('pt.posts_id',$id)
		->get();
		$data = json_decode(json_encode($data),true);
		return $data;
	}
	public function getDataRelatedPost($id,$idCate)
	{
		$data = DB::table('posts as p')
		->select('p.id','p.title','p.slug','p.avatar','p.publish_date','c.name as name_cate','c.slug as cate_slug','c.id as cate.id')
		->join('categories as c','c.id','=','p.categories_id')
		->where('p.categories_id',$idCate)
		->where('p.id','<>',$id)
		->limit(3)->get();
		$data = json_decode(json_encode($data),true);
		return $data;
	}
	public function updateCountView($id,$count)
	{
		$count++;
		 DB::table('posts')
		->where('id',$id)
		->update(['view_count'=> $count])
		;

	}
	public function getDataPostByCateID($cateid)
	{
		$data = DB::table('posts as p')
				->select('p.id','p.title','p.slug','p.avatar','p.publish_date','c.name as name_category','a.username','a.id as id_author')
				->join('categories as c','c.id','=','p.categories_id')
				->join('admin as a','a.id','=','p.user_id')
				->where('p.categories_id',$cateid)
				->where('p.status',1)
				->orderBy('p.publish_date','DESC')
				->paginate(2);
		return $data;
	}
	public function getDataPostByKeyword($keyword)
	{
		$data = DB::table('posts as p')
				->select('p.id','p.title','p.slug','p.avatar','p.publish_date','c.name as name_category','a.username','a.id as id_author')
				->join('categories as c','c.id','=','p.categories_id')
				->join('admin as a','a.id','=','p.user_id')
				->where('p.title','like','%'.$keyword.'%')
				->where('p.status',1)
				->orderBy('p.publish_date','DESC')
				->paginate(2);
		return $data;
	}
    //
}
