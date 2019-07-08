<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
	public function __construct(){
		//goi middleware  day
		//$this->middleware('testMiddlewareontroller:role')->only(['demo','testDemo']);
		//$this->middleware('testMiddlewareontroller:29')->except(['demo','testDemo']);
	}
	public function demo()
	{
		return "This is ".__FUNCTION__;
	}
	public function testDemo(){
		return "This is ".__CLASS__;
	}
	public function index(){
		return "this is index";
	}
	public function profile($nameProduct,$idProduct){//truyen dung thu tu
		//lam nhu nao de nhan duoc tham so chuyen duoc tu router chuyen len
		return "name product {$nameProduct} / id {$idProduct}";

	}
	public function detailProfile(Request $request){
		$id = $request->id;//id o day la bien tren url
		$page=$request->page;
		$key=$request->key;
		$age=$request->input('age',30);
		return "this is {$id} - page {$page} - key {$key} - age {$age}";
	}
	public function login(){
		//get view - nap view vao method controller
		return view('login.index');//mo file html index trong folder login
	}
	public function handleLogin(Request $request){
		//nhan du lieu tu form thong qua Request
		// $data=$request->all();
		// dd($data);
		$user=$request->input('user');
		//$user=$request->user
		$pass=$request->pass;
		dd($user,$pass);
	}
	public function template(){
		//return view('test-layout');
		return view('home.index');

	}
	public	function testHome(){
		$data = [];

		$data['lstInfoStudent']=[
			[
				'msv' =>'123',
				'name'=>'sangtq',
				'age'=> 20,
				'phone' => 123123,
				'money' => 213123,
				'gender' => 0,
			],
			[
				'msv' =>'123',
				'name'=>'sang2',
				'age'=> 22,
				'phone' => 123123,
				'money' => 555,
				'gender' => 1,
			],
			[
			'msv' =>'123',
			'name'=>'sang3',
			'age' => 44,
			'phone' => 23423,
			'money' => 1233,
			'gender' => 0,
			]

		];
		


		return view('home.indexhome',$data);
	}
	public function testAbout(){
		$age = 29;

		return view('about.index')->with('myAge',$age);
	}
}
