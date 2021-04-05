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
            $table->uuid('company_id')->nullable()->comment('บริษัท');
            $table->uuid('plant_id')->nullable()->comment('เชื่อมพืช');
            $table->string('question')->comment('คำถาม')->nullable();
            $table->string('name')->comment('ชื่อพืช')->nullable();
            $table->double('moisture', 8, 2)->comment('หักความชื้นร้อยละ')->nullable();
            $table->double('moisture_min', 8, 2)->comment('ความชื้นน้อยสุด')->nullable();
            $table->double('moisture_max', 8, 2)->comment('ความชื้นมากสุด')->nullable();
            $table->double('Foreign_matter', 8, 2)->comment('สิ่งแปลกปลอม')->nullable();
            $table->double('price_per_kk', 8, 2)->comment('ราคาต่อกิโลกรัม')->nullable();
            $table->enum('status', ['อัพเดท', 'ปกติ'])->default('ปกติ');
            $table->double('price_per_ton', 8, 2)->comment('ราคาต่อตัน')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('cascade')
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
