<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class UpdateBoardsAddColumnStatus extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->boolean('status')->default(1)->comment('状态 1启用 0禁用')->after('sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boards', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
