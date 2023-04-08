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
        Schema::create('user_gpt_keys', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('用户聊天认证key');
            $table->timestamp('start_at')->comment('生效时间');
            $table->timestamp('end_at')->comment('过期时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_gpt_keys');
    }
};
