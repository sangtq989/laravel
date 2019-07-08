<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <= 5; $i++) { 
        	
	        DB::table('categories')->insert([
	        	'name'=>Str::random(5),
	       		'slug'=>Str::random(5),
	       		'parrent_id'=>0,
	       		'status'=>1,
	       		'created_at'=>date('Y-m-h H:i:s'),
	       		'updated_at'=>NULL
	        ]);
        }
    }
}
