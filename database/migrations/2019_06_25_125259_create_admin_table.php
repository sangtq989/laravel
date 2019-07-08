<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            //day la khoa chinh vi u dong tang
            //unsigned() cho biet cot nay la so nguyen ko am
            $table->increments('id')->unsigned();


            //var char max 100 ki tu    
            //username ko trung nhau        
            $table->string('username',100)->unique();
            $table->string('password',60);
            //email ko trung nhau
            $table->string('email',60)->unique();
            $table->tinyInteger('role')->default(-1);
            $table->tinyInteger('status')->default(1);
            $table->string('phone',20);
            $table->text('address')->nullable();


            //create_at va update_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
