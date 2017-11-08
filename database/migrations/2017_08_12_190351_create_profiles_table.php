<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->string('avatar');
            $table->string('dob',10)->nullable();
            $table->string('phone')->nullable();
            $table->string('country',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->text('description')->nullable();
            $table->string('birthplace',100)->nullable();
            $table->string('gender',1)->nullable();
            $table->string('occupation');
            $table->string('profile_id');
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('goo')->nullable();
            $table->integer('club_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
