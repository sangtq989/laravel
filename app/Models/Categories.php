<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	 protected $table = 'categories';
    
    public function getAllDataCategories()
    {
    	$result =  [];
    	$data = Categories::all();
    	if ($data) {
    		$result = $data->toArray();    		
    	}
    	return $result;
    }
    
	  public function posts()
    {
        return $this->hasMany('App\Models\Posts');
        # code...
    }
     public function countPostCategories()
    {
        //inner join orm

       $data = Categories::with('posts')->get();
       return $data;
    }
    public function getDataCateById($id)
    {
        $result=[];
        $data = Categories::find($id);
        if ($data) {
            $result = $data->toArray();
        }
        return $result;
        
    }
    
}
