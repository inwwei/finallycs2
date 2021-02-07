<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_product_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sell_id')->nullable()->comment('เชื่อมใบขายสินค้า');
            $table->uuid('product_id')->nullable()->comment('เชื่อมสินค้า');
            $table->integer('amount')->nullable()->comment('จำนวนชื้น');
            $table->decimal('wholesale_price', 19, 2)->nullable()->comment('ราคาส่ง');
            $table->decimal('total_price', 19, 2)->nullable()->comment('ราคารวม');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('sell_id')->references('id')->on('sale_products')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')
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
        Schema::dropIfExists('sale_product_details');
    }
}
