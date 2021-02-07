<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attacheds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('attachedable');
            $table->string('name');
            $table->string('path');
            $table->string('full_path');
            $table->string('mime_type')->nullable();
            $table->string('type')->default('file');
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('src')->nullable();
            $table->string('alt')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('attacheds');
    }
}
