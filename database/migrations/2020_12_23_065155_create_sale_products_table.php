<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('seller_id')->nullable()->comment('เชื่อมพนักงาน');
            $table->uuid('customer_id')->nullable()->comment('เชื่อมลูกค้า');
            $table->string('code')->nullable()->comment('รหัสขาย');
            $table->string('date')->nullable()->comment('วันที่ขาย');
            $table->string('print')->nullable()->comment('สถานะการพิมพ์ใบสั่ง');
            $table->decimal('sumPrice', 19, 2)->nullable()->comment('ราคารวม');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('seller_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')
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
        Schema::dropIfExists('sale_products');
    }
}
