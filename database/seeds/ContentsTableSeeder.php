<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
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
	   
	        DB::table('contents')->insert([
	        	'post_id'=>$i,
	        	'content_web'=>Str::random(10),
	        	'content_mobile'=>Str::random(10),
	        	'content_amp'=>Str::random(10),
	        	'created_at'=>date('Y-m-d H:i:s'),
	        	'updated_at'=>null,
	        ]);
    	}
    }
}
