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
        Schema::table('user_gpt_keys', function (Blueprint $table) {
            $table->unsignedBigInteger('wechat_id')->nullable()->comment('关联微信用户');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gpt_keys', function (Blueprint $table) {
            $table->dropColumn('wechat_id');
        });
    }
};
