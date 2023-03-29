<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_groups', function (Blueprint $table) {
            $table->id('event_group_id')->comment('ไอดี');
            $table->dateTime('event_group_time')->comment('เวลาเพิ่มงาน');
            $table->string('event_users_ldap')->comment('เก็บ Ldap ของผู้แอด');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
            $table->unsignedBigInteger('events_id')->comment('ไอดี');
            $table->foreign('events_id')->references('events_id')->on('events');
            $table->unsignedBigInteger('group_id')->comment('ไอดี ของกลุ่ม');
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
        Schema::dropIfExists('event_groups');
    }
}
