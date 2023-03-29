<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupShares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_shares', function (Blueprint $table) {
            $table->id();
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้อยู่ในกลุ่ม');
            $table->bigInteger('group_id')->unsigned()->comment('ไอดีของกลุ่มงาน');
            $table->foreign('group_id')->references('group_id')->on('groups');
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
        Schema::dropIfExists('group_shares');
    }
}
