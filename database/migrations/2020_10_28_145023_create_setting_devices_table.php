<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_devices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->comment('ชื่ออุปกรณ์');
            $table->string('pin')->comment('รหัส PIN');
            $table->timestamp('use_at')->nullable()->comment('ถูกใช้งานเมื่อ');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_devices');
    }
}
