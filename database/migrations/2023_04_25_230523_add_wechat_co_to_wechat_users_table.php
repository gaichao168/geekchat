<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wechat_users', function (Blueprint $table) {
            $table->string('wechat_number')->nullable()->comment('微信号');
            $table->string('wechat_name')->nullable()->comment('微信昵称');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wechat_users', function (Blueprint $table) {
            $table->dropColumn('wechat_number');
            $table->dropColumn('wechat_name');
        });
    }
};
