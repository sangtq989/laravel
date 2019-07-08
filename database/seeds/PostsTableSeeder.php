<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <=10 ; $i++) { 
    		# code...
    
	        DB::table('posts')->insert([
	        	'title'=>Str::random(5),
	        	'slug'=>Str::random(5),
	        	'sapo'=>Str::random(10),
	        	'categories_id'=>1,
	        	'avatar'=>Str::random(5).'png',
	        	'status'=>1,
	        	'publish_date'=>date('Y-m-d H:i:s'),
	        	'lang_id'=>1,
	        	'created_at'=>date('Y-m-d H:i:s'),
	        	'created_at'=>null,

	        ]);
     	}
    }
}
