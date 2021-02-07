<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('partner_id')->nullable()->comment('คู่ค้า');
            $table->uuid('user_id')->nullable()->comment('พนักงานที่เป็นคนสั่ง');
            $table->uuid('setting_master_product_id')->nullable()->comment('ประเภทสินค้า');
            $table->string('code')->nullable()->comment('รหัสใบสั่งฝั่งเรา');
            $table->string('code_ref')->nullable()->comment('รหัสยืนยันจากฝั่งคู่ค้า');
            $table->decimal('total_price', 19, 2)->nullable()->comment('รวมราคาใบสั่ง');
            $table->enum('type', ['ประจำเดือน', 'เร่งด่วน'])->comment('ประเภทใบสั่ง');
            $table->enum('status', ['ร่าง', 'รอยืนยัน', 'ยืนยัน', 'ยกเลิก'])->nullable()->comment('สถานะใบสั่ง');
            $table->string('print')->nullable()->comment('สถานะการพิมพ์ใบสั่ง');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('setting_master_customers')
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
        Schema::dropIfExists('orders');
    }
}
