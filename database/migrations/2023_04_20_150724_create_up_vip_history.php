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
        Schema::create('up_vip_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wechat_id')->comment('用户id');
            $table->unsignedDecimal('times',10,2)->comment('开通时常');
            $table->unsignedDecimal('money',10,2)->default('0.00')->comment('金额');
            $table->unsignedInteger('vip_config_id')->comment('VIP配置');
            $table->string('remark')->nullable()->comment('备注');
            $table->timestamp('start_time')->comment('生效时间');
            $table->timestamp('end_time')->comment('结束时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_vip_history');
    }
};
