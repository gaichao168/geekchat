<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_gpt_keys', function (Blueprint $table) {
            $table->bigInteger("numbers", false, true)->default(0)->comment("可使用次数");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gpt_keys', function (Blueprint $table) {
            //
        });
    }
};
