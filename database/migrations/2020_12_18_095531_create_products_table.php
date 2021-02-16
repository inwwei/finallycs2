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
            $table->uuid('user_id')->nullable()->comment('เชื่อมผู้ใช้');
            $table->string('name')->comment('ชื่อพืช')->nullable();
            $table->double('moisture', 8, 2)->comment('หักความชื้นร้อยละ')->nullable();
            $table->double('moisture_min', 8, 2)->comment('ความชื้นน้อยสุด')->nullable();
            $table->double('moisture_max', 8, 2)->comment('ความชื้นมากสุด')->nullable();
            $table->double('Foreign_matter', 8, 2)->comment('สิ่งแปลกปลอม')->nullable();
            $table->double('price_per_kk', 8, 2)->comment('ราคาต่อกิโลกรัม')->nullable();
            $table->double('price_per_ton', 8, 2)->comment('ราคาต่อตัน')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');

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
