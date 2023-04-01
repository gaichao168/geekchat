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
        Schema::table('open_ai_keys', function (Blueprint $table) {
            $table->decimal('total_granted')->default(0.00)->comment('总额');
            $table->decimal('total_used')->default(0.00)->comment('已用');
            $table->decimal('total_available')->default(0.00)->comment('剩余');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('open_ai_keys', function (Blueprint $table) {
            $table->dropColumn('total_granted');
            $table->dropColumn('total_used');
            $table->dropColumn('total_available');
        });
    }
};
