<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id')->comment('ไอดี');
            $table->string('group_name')->comment('ชื่อกลุ่มงาน');
            $table->string('group_description')->comment('คำอธิบายกลุ่มงาน')->nullable();
            $table->integer('group_status')->comment('สถานะของกลุ่ม');
            $table->string('create_users_ldap')->comment('เก็บ Ldap ของผู้สร้างกลุ่ม');
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
        Schema::dropIfExists('groups');
    }
}
