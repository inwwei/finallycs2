<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingGenerateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_generate_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('setting_basic_branch_id')->nullable()->comment('รหัสสาขา');
            $table->string('name')->comment('ชื่อ th');
            $table->string('pattern')->nullable()->comment('รูปแบบ');
            $table->string('code')->nullable()->comment('โค้ด');
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
        Schema::dropIfExists('setting_generate_codes');
    }
}
