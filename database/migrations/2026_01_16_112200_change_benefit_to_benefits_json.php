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
            // Change benefit from string to JSON to support bullet list
            $table->json('benefits')->nullable()->after('source');
        });

        // Migrate existing benefit data to benefits array
        \DB::table('product_highlights')->whereNotNull('benefit')->get()->each(function ($row) {
            \DB::table('product_highlights')
                ->where('id', $row->id)
                ->update(['benefits' => json_encode([$row->benefit])]);
        });

        Schema::table('product_highlights', function (Blueprint $table) {
            $table->dropColumn('benefit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_highlights', function (Blueprint $table) {
            $table->string('benefit')->nullable()->after('source');
        });

        // Migrate benefits array back to single benefit string
        \DB::table('product_highlights')->whereNotNull('benefits')->get()->each(function ($row) {
            $benefits = json_decode($row->benefits, true);
            \DB::table('product_highlights')
                ->where('id', $row->id)
                ->update(['benefit' => $benefits[0] ?? null]);
        });

        Schema::table('product_highlights', function (Blueprint $table) {
            $table->dropColumn('benefits');
        });
    }
};
