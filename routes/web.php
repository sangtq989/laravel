<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home',function(){
	return "hello world - home";
});

//1 - get
Route::get('/demo/laravel', function(){
	return "This is method GET";
});

//2 - post
Route::post('/demo-post',function(){
	return "This is demo POST";
});

//3 - put
Route::put('demo-put',function(){
	return "this is PUT";
});

//4-match
//cho phep 1 request co the lam viec voi nhieu phuong thuc route
Route::match(['get','post','put'],'demo-match',function (){
	return "this is match method";
});

//5- any cho phep lam viec voi tat ca method
Route::any('demo-method-any',function(){
	return "This is method any";
});

//6-truyen tham so vao route
Route::get('samsung/{nameproduct}',function($name){
	return "samsung - {$name}";
});
Route::get('iphone/{id}/{nameProduct?}',function($id,$name = null){
	return "iphone - {$name} - {$id}";
});
//7 - route tra ve view
Route::view('demo-view','demo');
//demo la ten cua file view

//dieu huong - chuyen huong 
Route::get('xem-phim',function(){
	return redirect('demo-view');
});
//chuyen thang tu '/home' ve '/'
Route::redirect('/home','/',301);


//regular expression Constrain
//kiem tra - validate tham so cua route
Route::get('phim-hay/tap/{num}',function($number){
	return "Ban dang xem tap {$number}";
})->where('num','\d+');

//kiem tra 2 hoac nhieu tham so 1 luc
Route::get('phim-hay/{nameFilm}/tap/{tap}',function($name,$chapter){
	return "ban dang xem phim {$name} tap {$chapter}";
})->where([	
	'nameFilm' => '[A-Za-z0-9]+',
	'tap' => '\d+' 
]);

// Route::get('/product/{id}',function($id){
// 		return "Ban dang xem sp {$id}";
// });
Route::get('/music/{id}',function($id){
		return "Ban dang xem bai {$id}";
})->where('id','\d+')->name('music');


Route::get('nghe-nhac',function(){
	//return redirect('music/10');
	return redirect()->route('music',['id'=>10]);
});

//get info url 

Route::get('info-url',function(){
	$url = route('music',['id'=>100]);
	echo "<pre>";
	print_r($url);
});


///Route group
//nhom cac route thanh 1 nhom
Route::group([
	'prefix' =>'admin', //fix duong dan thanh admin/...
	'namespace'=>'Test',//ten namespace
	'as' => 'admin.'
],function(){
	Route::get('dashbroad',function(){
		return "this is admin dashbroad";
	})->name('dash');
	Route::get('profile',function(){
		//return "this is admin profile";
		return redirect()->route('admin.dash');
	})->name('prf');
	Route::get('demo-namespace','DemoController@index')->name('demoNameSpace');
});
///fallback neu sai route no se ve trang bao loi
// Route::fallback(function(){
// 	return redirect('/');
// });
//su dung middleware

Route::get('xem-phim-a/{age}',function(){
	return "ban da du tuoi xem phim";
})->middleware('myCheckAge');

//

Route::get('kiem-tra-chan-le/{number}',function($num){
	return "{$num} la so chan";
})->middleware('myCheckNumber:admin');// admin la tham so cua middleware

Route::get('test-num',function(){
	return "test";
});
//su dung router va controller

Route::get('test-controller/{name}','TestController@demo')->name('testController');
//
Route::get('test-demo','TestController@testDemo')->name('testDemo');
//
Route::get('index','TestController@index')->name('testIndex');
//
Route::get('profile/{name}/{id}','TestController@profile')->name('profile');
//
Route::get('detail-profile/{id}','TestController@detailProfile');
//
Route::get('demo-login','TestController@login')->name('frmLogin');
//
Route::post('handle-login','TestController@handleLogin')->name('handleLogin');//name giong voi khai bao o html
//
Route::get('template-blade','TestController@template')->name('template');
//
Route::get('test-home','TestController@testHome')->name('testHome');
Route::get('test-about','TestController@testAbout')->name('testAbout');

//
Route::group([ 
		'prefix'=>'query',
		'namespace'=>'Test'
],function(){
	Route::get('select','QueryController@select')->name('select');
	Route::get('orm','QueryController@demoORM')->name('ORM');
});




/*****************Route blog Admin***********************/
Route::group([
	'prefix' =>'admin', //fix duong dan thanh admin/...
	'namespace'=>'Admin',//ten namespace
	'as' => 'admin.',
	
],function(){
	Route::get('/login','AccountController@viewLogin')->name('viewLogin')->middleware('isLogined');
	Route::post('/handle-login','AccountController@handleLogin')->name('handleLogin');
	Route::post('/logout','AccountController@logout')->name('logout');
});

Route::group([
	'prefix' =>'admin', //fix duong dan thanh admin/...
	'namespace'=>'Admin',//ten namespace
	'as' => 'admin.',
	'middleware' => ['web','adminLogined']
],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::get('list-posts','PostsController@index')->name('listPosts');
	Route::get('create-posts','PostsController@createPosts')->name('createPosts');
	Route::post('handle','PostsController@handleCreatePost')->name('handlePost');
	Route::post('/delete-post','PostsController@deletePost')->name('deletePost');
	Route::get('{slug}/{id}','PostsController@editPost')->name('editPost');
	Route::post('handle-edit/{id}','PostsController@handleEdit')->name('handleEdit');
});

/*****************Route blog frontend***********************/
Route::group([
	'namespace' => 'Frontend',
	'as' => 'fr.'
],function(){
	Route::get('/','HomeController@index')->name('home');
	Route::get('{slug}~{id}','DetailController@index')->name('detail');
	Route::get('lg/{id}','DetailController@updateView')->name('viewCount');
	Route::get('category/{slug}~{id}','CategoryController@index')->name('category');
	Route::get('search','SearchController@index')->name('search');
});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
