<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token_password')->nullable();
            $table->rememberToken();
            $table->string('resume')->nullable();
            $table->string('profile_picture')->default('public/images/defaultProfilePicture.png');
            $table->boolean('active')->default(1);
            $table->string('bio')->nullable();
            $table->string('subtitle')->default('Freelancers User');
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
        Schema::dropIfExists('users');
    }
}
