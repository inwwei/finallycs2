<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref_id')->nullable()->comment('ข้อมูลก่อน');
            $table->string('table_name')->nullable()->comment('ข้อมูลก่อน');
            $table->text('before_data')->nullable()->comment('ข้อมูลก่อน');
            $table->text('after_data')->nullable()->comment('ข้อมูลปัจจุบัน');
            $table->string('time')->comment('จำนวนครั้ง');
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
        Schema::dropIfExists('logs');
    }
}
