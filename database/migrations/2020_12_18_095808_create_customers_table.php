<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable()->comment('รหัสลูกค้า');
            $table->uuid('setting_master_customer_id')->nullable()->comment('รหัสสมาชิก');
            $table->uuid('setting_basic_branch_id')->nullable()->comment('รหัสสมาชิก');
            $table->string('customer_name', 100)->nullable()->comment('ชื่อลูกค้า');
            $table->string('tax_id', 50)->nullable()->comment('หมายเลขเสียภาษี');
            $table->string('identification_number', 13)->nullable()->comment('เลขบัตรประชาชน');
            $table->foreign('setting_master_customer_id')->nullable()->references('id')->on('setting_master_customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('setting_basic_branch_id')->references('id')->on('setting_basic_branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('customers');
    }
}
