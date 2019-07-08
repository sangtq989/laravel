<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=10 ; $i++) { 
        	DB::table('post_tag')->insert([
        		'posts_id' => rand(1,10),
        		'tag_id' => rand(1,5),
        		'primary' => rand(0,1),
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => null,
        	]);
        }
    }
}
