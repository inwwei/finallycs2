<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identification_number')->nullable()->comment('เลขประจำตัวประชาชน');
            $table->string('name')->nullable()->comment('ชื่อบริษัท');
            $table->string('username')->nullable()->comment('ชื่อผู้ใช้');
            $table->string('password')->nullable()->comment('รหัส');
            $table->string('email')->nullable()->comment('อีเมล');
            $table->string('ceo_prefix')->nullable()->comment('คำนำหน้า');
            $table->string('ceo_firstname')->nullable()->comment('ชื่อ');
            $table->string('ceo_lastname')->nullable()->comment('นามสกุล');
            $table->string('company_tel')->nullable()->comment('เบอร์โทรบิรษัท');
            $table->string('ceo_tel')->nullable()->comment('เบอร์ceo');
            $table->string('amphoe')->nullable()->comment('อำเภอ');
            $table->string('district')->nullable()->comment('ตำบล');
            $table->string('province')->nullable()->comment('จังหวัด');
            $table->string('postal_code')->nullable()->comment('รหัสไปรษณีย์');
            $table->string('role')->nullable()->comment('สิทธิ์');
            $table->string('name_location')->nullable()->comment('ชื่อผู้ใช้');
            $table->float('lat', 16, 8)->nullable()->comment('ลติจูด');
            $table->float('lng', 16, 8)->nullable()->comment('ลองติจูด');
            $table->string('zoom')->nullable()->comment('ซูม');
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
        Schema::dropIfExists('users');
    }
}
