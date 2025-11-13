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
        Schema::table('media', function (Blueprint $table) {
            // Додаємо відсутні колонки для Spatie MediaLibrary v10
            if (!Schema::hasColumn('media', 'uuid')) {
                $table->uuid('uuid')->nullable()->unique()->after('model_id');
            }
            if (!Schema::hasColumn('media', 'conversions_disk')) {
                $table->string('conversions_disk')->nullable()->after('disk');
            }
            if (!Schema::hasColumn('media', 'generated_conversions')) {
                $table->json('generated_conversions')->after('custom_properties');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            if (Schema::hasColumn('media', 'uuid')) {
                $table->dropColumn('uuid');
            }
            if (Schema::hasColumn('media', 'conversions_disk')) {
                $table->dropColumn('conversions_disk');
            }
            if (Schema::hasColumn('media', 'generated_conversions')) {
                $table->dropColumn('generated_conversions');
            }
        });
    }
};
