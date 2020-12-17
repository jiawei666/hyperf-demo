<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('标题');
            $table->mediumText('content')->nullable()->comment('内容');
            $table->unsignedInteger('sort')->default(0)->comment('排序 数值大的靠前');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
}
