<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type')->default('external');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            [
                'first_name' => 'Yan',
                'last_name' => 'Doe',
                'email' => 'user@grtech.com.my',
                'password' => Hash::make(env('USER_PASSWORD','password'))
            ]
        ); 
        DB::table('users')->insert(
            [
                'first_name' => 'admin',
                'last_name' => 'Ml',
                'email' => 'admin@grtech.com.my',
                'password' => Hash::make(env('USER_PASSWORD','password')),
                'type' => 'internal'
            ]
        ); 
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
