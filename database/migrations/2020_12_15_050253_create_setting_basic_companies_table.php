<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingBasicCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_basic_companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->comment('ชื่อบริษัท');
            $table->string('tex_id',50)->nullable()->comment('เลขผู้เสียภาษี');
            $table->string('tel',50)->nullable()->comment('เบอร์ติดต่อ');
            $table->string('house_number',50)->nullable()->comment('บ้านเลขที่');
            $table->string('district',50)->nullable()->comment('ตำบล');
            $table->string('amphure',50)->nullable()->comment('อำเภอ');
            $table->string('province',50)->nullable()->comment('จังหวัด');
            $table->string('postal_code',50)->nullable()->comment('รหัสไปรษณีย์');
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
        Schema::dropIfExists('setting_basic_companies');
    }
}
