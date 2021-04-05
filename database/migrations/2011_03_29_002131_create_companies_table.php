<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable()->comment('เชื่อมผู้ใช้');
            $table->string('identification_number')->nullable()->comment('เลขประจำตัวประชาชน');
            $table->string('name')->nullable()->comment('ชื่อบริษัท');
            $table->string('branch')->nullable()->comment('สาขา');
            $table->string('email')->nullable()->comment('อีเมล');
            $table->string('ceo_firstname')->nullable()->comment('ชื่อ');
            $table->string('ceo_lastname')->nullable()->comment('นามสกุล');
            $table->string('company_tel')->nullable()->comment('เบอร์โทรบิรษัท');
            $table->string('ceo_tel')->nullable()->comment('เบอร์ceo');
            $table->string('amphoe')->nullable()->comment('อำเภอ');
            $table->string('district')->nullable()->comment('ตำบล');
            $table->string('province')->nullable()->comment('จังหวัด');
            $table->string('postal_code')->nullable()->comment('รหัสไปรษณีย์');
            $table->string('name_location')->nullable()->comment('ตำแหน่ง');
            $table->float('lat', 16, 8)->nullable()->comment('ลติจูด');
            $table->float('lng', 16, 8)->nullable()->comment('ลองติจูด');
            $table->string('zoom')->nullable()->comment('ซูม');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('companies');
    }
}
