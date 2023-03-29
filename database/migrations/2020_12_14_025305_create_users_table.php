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
            $table->id('user_id')->comment('ไอดี');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
            $table->string('users_name')->comment('ชื่อของผู้ใช้')->nullable();
            $table->string('users_email')->unique()->comment('อีเมล')->nullable();
            $table->timestamp('email_verified_at')->nullable()->comment('ยืนยันอีเมล')->nullable();
            $table->string('users_password')->comment('รหัสผ่าน')->nullable();
            $table->unsignedBigInteger('status_id')->unsigned()->comment('ไอดีของสถานะ level user')->nullable();
            $table->foreign('status_id')->references('status_id')->on('user_statuses');
            $table->rememberToken();
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
