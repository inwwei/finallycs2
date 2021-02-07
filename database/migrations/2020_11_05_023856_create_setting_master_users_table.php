<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingMasterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_master_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ref_id')->index()->nullable()->comment('อ้างอิงตัวแม่');
            $table->string('name_th')->comment('ตำแหน่ง');
            $table->string('name_en')->comment('ตำแหน่ง Eng');
            $table->string('default_financial')->nullable()->comment('วงเงินเริ่มต้น');
            $table->string('checkLogin')->comment('เช็คล็อคอิน');
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
        Schema::dropIfExists('setting_master_users');
    }
}
