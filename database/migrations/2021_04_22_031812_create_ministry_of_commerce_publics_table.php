<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryOfCommercePublicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministry_of_commerce_publics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->comment('ชื่อพืช')->nullable();
            $table->double('price', 8, 2)->comment('ราคา')->nullable();
            $table->enum('unit', ['กิโลกรัม', 'กรัม','ขีด','ตัน','',])->nullable();
            $table->double('moisture', 8, 2)->nullable()->comment('หักความชื้นร้อยละ')->nullable();
            $table->double('moisture_min', 8, 2)->nullable()->comment('ความชื้นน้อยสุด')->nullable();
            $table->double('moisture_max', 8, 2)->nullable()->comment('ความชื้นมากสุด')->nullable();
            $table->double('Foreign_matter', 8, 2)->nullable()->comment('สิ่งแปลกปลอม')->nullable();
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
        Schema::dropIfExists('ministry_of_commerce_publics');
    }
}
