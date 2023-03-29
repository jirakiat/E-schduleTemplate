<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('users_ldap')->comment('เก็บ Ldap ของผู้ใช้');
            $table->integer('status_acept_id')->comment('สถานะ acept reject');
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
        Schema::dropIfExists('setting_statuses');
    }
}
