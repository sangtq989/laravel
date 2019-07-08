<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;//thu vien thao tac voi database
//nap model vao controller
use App\Models\admin;

class QueryController extends Controller
{
    public function select(){
    	//thuc hanh cac cau lenh query
    	//1-lay all
    	$dt = DB::table('admin')->get();
    	// == select * from admin
    	if ($dt) {
    		$dt=json_decode($dt,true);
    	}
    	// foreach ($dt as $key => $value) {
    	// 	//echo $value->id;
    	// 	echo $value['id'];
    	// 	echo "<br>";
    	// }
    	// dd($dt);

    	//2- lay du lieu theo dieu kien'
    	//select name from categories where id =100 or id=4 or name='abc' or status =0
    	$dt2=DB::table('categories')
    		->select('name')
    		->where('id',100)
    		->orWhere(['id'=>4,'name'=>'abc','status'=>0])
    		// ->orWhere('id',4)
    		// ->orWhere('name','abc')
    		// ->orWhere('status',0)
    		->first();
    	//dd($dt2->name);

    	//SELECT username, password, role FROM admin AS a WHERE a.username = 'sas' AND a.password = '1122'
    	$dt3=DB::table('admin AS a')
    		->select('a.username','a.password','a.role')
    		->where([
    					'a.username'=>'admin1',
    					'a.password'=>'TpDp9vO4',
    					'a.status'=>1
    				])
    		->first();
    	//dd($dt3);
    	$count = DB::table('admin')->count();//dem so hang co trong bang admin
    	//dd($count);
    	$minId = DB::table('admin')->max('id');
    	$maxId = DB::table('admin')->min('id');
    	$avgId = DB::table('admin')->avg('id');
    	$sumId = DB::table('admin')->sum('id');
    	//dd($minId,$maxId,$avgId,$sumId);

    	//SELECT * FROM posts WHERE id IN (1,2,3)
    	$dt4 = DB::table('admin')->select('*')->where('email','LIKE','%zn%')->get();
    	//dd($dt4);

    	//inner join
    	//insert to TAGS table
	    	// DB::table('tags')->insert([
	    	// 	'name'=> 'sang',
	    	// 	'slug'=>'sangtq',
	    	// 	'status'=> 0,
	    	// 	'created_at' => date('Y-m-d H:i:s'),
	    	// 	'updated_at'=> null
	    	// ]);
    	//UPDATE data to table TAGS
    	DB::table('tags')->where('id',6)->update([
    		'name'=>'sangtq969',
    	]);
    	//DELETE table TAGS
    	$del = DB::table('tags')->where('id',5)->delete();
    	if ($del) {
    		echo "ok";
    	}else{
    		echo "no";
    	}
    }
    public function demoORM(admin $admin)
    {
    	//lay du lieu tu model
    	$data = $admin->getAllData();
    	$data1 = $admin->getDataByCondition();
    	dd($data1);
    }

}
