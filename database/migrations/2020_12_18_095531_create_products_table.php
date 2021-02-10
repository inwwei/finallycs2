<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('machine_code')->nullable()->comment('รหัสเครื่อง');
            $table->string('vin')->nullable()->comment('รหัสตัวถัง');
            $table->string('description')->nullable()->comment('รายละเอียด');
            $table->integer('quantity')->default(1)->comment('จำนวน');
            $table->integer('wholesale_price')->nullable()->comment('ราคาขายส่ง');
            $table->text('tags')->nullable()->comment('แท๊ก');
            $table->integer('retail_price')->nullable()->comment('ราคาขายปลีก');
            $table->date('received_date')->nullable()->comment('วันที่รับ');
            $table->date('date')->nullable()->comment('วันที่ผลิต');
            $table->enum('type_received', ['เพิ่ม','รับเข้า'])->default('รับเข้า')->nullable()->comment('สถานะการรับ');
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
        Schema::dropIfExists('products');
    }
}
