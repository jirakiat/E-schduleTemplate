<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignees', function (Blueprint $table) {
            $table->id('assignees_id')->comment('ไอดี');
            $table->integer('assignees_status')->comment('สถานะ เช่น accept');
            $table->dateTime('assignees_time')->comment('เวลาที่ ถูกเพิ่มงาน');
            $table->dateTime('vertify_time')->comment('เวลาที่ accept')->nullable();
            $table->string('creat_users_ldap')->comment('เก็บ Ldap ของผู้แอด');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
            $table->unsignedBigInteger('events_id')->comment('ไอดี');
            $table->foreign('events_id')->references('events_id')->on('events');
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
        Schema::dropIfExists('assignees');
    }
}
