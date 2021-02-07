<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id')->index()->nullable()->comment('เชื่อมสินค้า');
            $table->integer('quantity')->nullable()->comment('จำนวนคงเหลือ');
            $table->integer('sell_out')->nullable()->comment('จำนวนขายออก');
            $table->integer('admit')->nullable()->comment('จำนวนเบิก/รับ');
            $table->timestamps();
            $table->rememberToken();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('product_id')->references('id')->on('products')
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
        Schema::dropIfExists('products_log');
    }
}
