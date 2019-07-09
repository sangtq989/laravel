<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
   protected $table = 'tags';
   public function getAllDataTags()
    {
    	$result =  [];
    	$data = Tags::all();
    	if ($data) {
    		$result = $data->toArray();    		
    	}
    	return $result;
    }
}
