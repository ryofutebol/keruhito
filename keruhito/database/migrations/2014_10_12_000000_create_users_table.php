<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable()->degfault(NULL);
            $table->string('email')->unique()->nullable()->degfault(NULL);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable()->degfault(NULL);
            $table->rememberToken();
            $table->string('twitter_id')->nullable()->degfault(NULL);
            $table->string('access_token')->nullable()->degfault(NULL);
            $table->string('access_token_secret')->nullable()->degfault(NULL);
            $table->string('avatar')->nullable()->degfault(NULL);
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
