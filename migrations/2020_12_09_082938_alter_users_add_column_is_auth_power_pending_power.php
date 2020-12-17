<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AlterUsersAddColumnIsAuthPowerPendingPower extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_auth')->default(0)->comment('是否实名认证 1已认证 0未认证')->after('phone');
            $table->unsignedBigInteger('power')->default(0)->comment('算力')->after('is_auth');
            $table->bigInteger('pending_power')->default(0)->comment('在途算力')->after('power');
            $table->decimal('filecoin', 20, 9)->default(0)->comment('文件币数量')->after('pending_power');
            $table->decimal('pending_filecoin', 20, 9)->default(0)->comment('冻结文件币数量')->after('filecoin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_auth');
            $table->dropColumn('power');
            $table->dropColumn('pending_power');
            $table->dropColumn('filecoin');
            $table->dropColumn('pending_filecoin');
        });
    }
}
