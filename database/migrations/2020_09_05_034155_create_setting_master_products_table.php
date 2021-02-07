<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_master_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ref_id')->index()->nullable()->comment('อ้างอิงตัวแม่');
            $table->string('code')->nullable()->comment('รหัสสินค้า');
            $table->string('name_th')->comment('ชื่อสินค้า/หมวด Th');
            $table->string('name_en')->comment('ชื่อสินค้า/หมวด Eng');
            $table->integer('retail_price')->nullable()->comment('ราคาขายปลีก');
            $table->enum('type', ['หมวดหมู่', 'ตัวรถ', 'อะไหล่', 'ต่อพ่วง'])->comment('ประเภท');

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
        Schema::dropIfExists('setting_master_products');
    }
}
