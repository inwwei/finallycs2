<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBestPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_prices', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('company_id')->nullable()->comment('เชื่อมบริษัท')->nullable();
            $table->string('plant_id')->nullable()->comment('เชื่อมบริษัท')->nullable();
            $table->string('name')->comment('ชื่อพืช')->nullable();
            $table->double('price', 8, 2)->comment('ราคาต่อกิโลกรัม')->nullable();


            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('best_prices');
    }
}
