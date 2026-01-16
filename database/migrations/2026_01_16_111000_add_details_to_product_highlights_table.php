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
        Schema::table('product_highlights', function (Blueprint $table) {
            $table->string('price')->nullable()->after('image_path');
            $table->string('weight')->nullable()->after('price');
            $table->string('source')->nullable()->after('weight');
            $table->string('benefit')->nullable()->after('source');
            $table->boolean('in_stock')->default(true)->after('benefit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_highlights', function (Blueprint $table) {
            $table->dropColumn(['price', 'weight', 'source', 'benefit', 'in_stock']);
        });
    }
};
