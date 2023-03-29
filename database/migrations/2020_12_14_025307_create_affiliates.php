<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id('affiliate_id')->comment('ไอดี');
            $table->string('affiliate_name')->comment('ชื่อของหน่วยงาน');
            $table->string('affiliate_description')->comment('รายระเอียดหน่วยงาน')->nullable();
            $table->integer('affiliates_status')->comment('สถานะหน่วยงาน')->nullable();
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้')->nullable();
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
        Schema::dropIfExists('affiliates');
    }
}
