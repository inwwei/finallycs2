<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id')->nullable()->comment('เชื่อมใบสั่ง');
            $table->uuid('setting_master_product_id')->nullable()->comment('เชื่อมประเภทสินค้า');
            $table->uuid('ref_id')->nullable()->comment('อ้างอิงตัวแม่');
            $table->date('recieve_date')->nullable()->comment('วันรับสินค้า');
            $table->string('machine_code')->nullable()->comment('รหัสเครื่อง');
            $table->string('description')->nullable()->comment('รายละเอียด');
            $table->string('vin')->nullable()->comment('เลขตัวถัง');
            $table->string('serial_number')->nullable()->comment('ซีเรียวนัมเบอร์');
            $table->string('receiver')->nullable()->comment('ผู้รับ');
            $table->integer('amount')->nullable()->comment('จำนวนชื้น');
            $table->integer('amount_recieve')->default(0)->nullable()->comment('จำนวนที่รับมา');
            $table->decimal('wholesale_price', 19, 2)->nullable()->comment('ราคาส่ง');
            $table->decimal('retail_price', 19, 2)->nullable()->comment('ราคาปลีก');
            $table->decimal('total_price', 19, 2)->nullable()->comment('รวมเป็นเงิน');
            $table->decimal('shipping_price', 19, 2)->default(0)->nullable()->comment('ราคาจัดส่ง');
            $table->enum('type', ['สั่ง', 'รับ'])->nullable()->comment('สถานะการดำเนินการ');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('setting_master_product_id')->references('id')->on('setting_master_products')->onUpdate('cascade')
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
        Schema::dropIfExists('order_details');
    }
}
