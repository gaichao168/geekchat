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
        Schema::create('up_vip_config', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('会员时长配置');
            $table->unsignedInteger('type')->unique()->comment('1天2周3月4季度5半年6全年7终生8次数收费');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_vip_config');
    }
};
