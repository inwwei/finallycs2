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
            $table->uuid('setting_master_product_id')->index()->comment('เชื่อมตั้งค่า');
            $table->uuid('setting_basic_branch_id')->index()->comment('เชื่อมสาขา');
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
            $table->foreign('setting_basic_branch_id')->references('id')->on('setting_basic_branches')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        $table->foreign('setting_master_product_id')->references('id')->on('setting_master_products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
