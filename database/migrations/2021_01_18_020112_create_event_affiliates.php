<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAffiliates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_affiliates', function (Blueprint $table) {
            $table->id('event_affiliates_id')->comment('ไอดี');
            $table->dateTime('event_affiliate_time')->comment('เวลาเพิ่มงาน');
            $table->string('event_users_ldap')->comment('เก็บ Ldap ของผู้แอด');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
            $table->unsignedBigInteger('events_id')->comment('ไอดี');
            $table->foreign('events_id')->references('events_id')->on('events');
            $table->unsignedBigInteger('affiliate_id')->comment('ไอดี ของหน่วยงาน');
            $table->foreign('affiliate_id')->references('affiliate_id')->on('affiliates');
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
        Schema::dropIfExists('event_affiliates');
    }
}
