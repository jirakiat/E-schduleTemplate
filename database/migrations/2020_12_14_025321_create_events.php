<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('events_id')->comment('ไอดี');
            $table->string('events_name')->comment('ชื่องาน');
            $table->text('event_description')->comment('รายละเอียดงาน')->nullable();
            $table->text('event_note')->comment('หมายเหตุเวลายกเลิกกิจกรรม')->nullable();
            $table->text('color')->comment('สี');
            $table->dateTime('start_event')->comment('เวลาเริ่ม');
            $table->dateTime('end_event')->comment('เวลาสิ้นสุด');
            $table->integer('events_status')->comment('สถานะงาน');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
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
        Schema::dropIfExists('events');
    }
}
