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
        Schema::table('hero_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('hero_contents', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('description_two');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_contents', function (Blueprint $table) {
            $table->dropColumn('whatsapp_number');
        });
    }
};
