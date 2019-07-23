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
			->select('p.id','p.title','p.sapo','p.publish_date','p.avatar','a.username','a.id as user_id')
			->join('admin as a','a.id','=','p.user_id')
			->where('p.status',1)
			->whereNotIn('p.id',$arrId)		
			->orderBy('p.publish_date','DESC')
			->paginate(5);		
		
		return $posts;
	}
	public function countPostCategories()
	{
		# code...
	}
    //
}
