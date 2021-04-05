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
            $table->string('question')->comment('คำถาม')->nullable();
            $table->string('company_id')->nullable()->comment('เชื่อมบริษัท')->nullable();
            $table->string('name')->comment('ชื่อพืช')->nullable();
            $table->string('name_location')->comment('สถานที่')->nullable();
            $table->float('lat', 16, 8)->nullable()->comment('ลติจูด');
            $table->float('lng', 16, 8)->nullable()->comment('ลองติจูด');
            $table->double('price_per_kk', 8, 2)->comment('ราคาต่อกิโลกรัม')->nullable();
            $table->double('price_per_ton', 8, 2)->comment('ราคาต่อตัน')->nullable();
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
