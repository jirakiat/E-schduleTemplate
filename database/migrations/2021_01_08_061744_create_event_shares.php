<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventShares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_shares', function (Blueprint $table) {
            $table->id('event_shares_id')->comment('ไอดี');
            $table->integer('event_shares_statuss')->comment('สถานะ เช่น accept');
            $table->dateTime('event_shares_vertify_time')->comment('เวลาที่ accept')->nullable();
            $table->string('share_users_ldap')->comment('เก็บ Ldap ของผู้แชร์');
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
        Schema::dropIfExists('event_shares');
    }
}
