<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable()->comment('รหัสพืช');
            $table->string('name')->nullable()->comment('ชื่อพืช');
            $table->date('date')->nullable()->comment('วันที่');
            $table->integer('max_price')->nullable()->comment('ราคาสูงสุด');
            $table->integer('min_price')->nullable()->comment('ราคาต่ำสุด');
            $table->timestamps();
            $table->rememberToken();
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
        Schema::dropIfExists('charts');
    }
}
