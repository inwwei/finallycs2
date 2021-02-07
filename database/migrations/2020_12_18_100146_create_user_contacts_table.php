<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable()->comment('เชื่อมพนักงาน');
            $table->uuid('setting_master_contact_id')->nullable()->comment('รหัสช่องทางการติดต่อ');
            $table->string('value', 50)->nullable()->comment('ข้อมูลติดต่อทั่วไป');
            $table->string('house_number', 50)->nullable()->comment('บ้านเลขที่');
            $table->string('district', 50)->nullable()->comment('ตำบล');
            $table->string('amphure', 50)->nullable()->comment('อำเภอ');
            $table->string('province', 50)->nullable()->comment('จังหวัด');
            $table->string('postal_code', 50)->nullable()->comment('รหัสไปรษณีย์');
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('setting_master_contact_id')->references('id')->on('setting_master_contacts')
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
        Schema::dropIfExists('user_contacts');
    }
}
