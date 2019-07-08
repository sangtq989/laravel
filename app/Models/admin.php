<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
	protected $table = 'admin';
	public function getAllData(){
		$data = admin::all();
		if ($data) {
			$data = $data->toArray();

		}
		return $data;
	}
	public function getDataByCondition($id = 9)
    {

    	$data = admin::find($id);
    	if ($data) {
			$data = $data->toArray();

		}
		return $data;
    }
    public function loginAdmin($user, $pass)
    {
    	$result = [];
    	$data = admin::select('*')->where([
    		'username' => $user,
    		'password' => $pass,
    		'status'=> 1,
    		'role' => -1
    	])->first();
    	if ($data) {
    		$result = $data->toArray();
    	}
    	return $result;

    }

    //
}
