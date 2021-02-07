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
            $table->string('name')->comment('ชื่อพนักงาน');
            $table->string('identification_number')->comment('เลขประจำตัวประชาชน');
            $table->string('username')->nullable()->comment('ชื่อผู้ใช้');
            $table->string('password')->nullable()->comment('รหัส');
            $table->string('code')->comment('รหัสพนักงาน');
            $table->string('financial')->nullable()->comment('วงเงิน');
            $table->uuid('setting_master_users_id')->index()->nullable()->comment('เชื่อมตั้งค่าuser');
            $table->uuid('branch_id')->nullable()->comment('เชื่อมสาขา');
            $table->string('email')->nullable()->comment('อีเมล');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestampsBy();
            $table->softDeletes();
            $table->softDeletesBy();
            $table->foreign('branch_id')->references('id')->on('setting_basic_branches')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('setting_master_users_id')->references('id')->on('setting_master_users')
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
        Schema::dropIfExists('users');
    }
}
