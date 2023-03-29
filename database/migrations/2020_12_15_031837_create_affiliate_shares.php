<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateShares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_shares', function (Blueprint $table) {
            $table->id('affiliate_shares_id');
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
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
        Schema::dropIfExists('affiliate_shares');
    }
}
