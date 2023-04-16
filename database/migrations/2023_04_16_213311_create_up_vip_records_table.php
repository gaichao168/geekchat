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
        Schema::create('up_vip_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wechat_id');
            $table->unsignedTinyInteger('month')->comment('开通时长');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_vip_records');
    }
};
