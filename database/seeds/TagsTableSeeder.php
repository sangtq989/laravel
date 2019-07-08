<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i=1; $i <=10; $i++){ 
       	DB::table('tags')->insert([
       		'name'=>Str::random(5),
       		'slug'=>Str::random(5),
       		'status'=>1,
       		'created_at'=>date('Y-m-h H:i:s'),
       		'updated_at'=>null,
       	]);
       }
    }
}
