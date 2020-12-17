<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreatUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account', 30)->comment('账号');
            $table->string('phone', 11)->comment('手机号');
            $table->string('name', 20)->nullable()->comment('姓名');
            $table->string('id_card_num', 30)->nullable()->comment('身份证号码');
            $table->enum('gender', ['unknown', 'male', 'female'])->default('unknown')->comment('性别');
            $table->string('address')->nullable()->comment('地址');
            $table->string('nationality', 10)->nullable()->comment('民族');
            $table->date('birth')->nullable()->comment('出生日期');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
