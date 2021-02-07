<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingMasterCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_master_customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ref_id')->index()->nullable()->comment('อ้างอิงตัวแม่');
            $table->string('name_th')->comment('ชื่อ th');
            $table->string('name_en')->comment('ชื่อ en');
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
        Schema::dropIfExists('setting_master_customers');
    }
}
