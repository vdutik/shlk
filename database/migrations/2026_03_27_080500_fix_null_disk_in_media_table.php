<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $defaultDisk = config('medialibrary.disk_name', 'public');

        // Old rows may contain invalid JSON payloads. MySQL re-validates JSON
        // constraints on any update, so we normalize these fields first.
        DB::statement("
            UPDATE media
            SET manipulations = '{}'
            WHERE manipulations IS NULL
               OR manipulations = ''
               OR JSON_VALID(manipulations) = 0
        ");

        DB::statement("
            UPDATE media
            SET custom_properties = '{}'
            WHERE custom_properties IS NULL
               OR custom_properties = ''
               OR JSON_VALID(custom_properties) = 0
        ");

        DB::statement("
            UPDATE media
            SET generated_conversions = '{}'
            WHERE generated_conversions IS NULL
               OR generated_conversions = ''
               OR JSON_VALID(generated_conversions) = 0
        ");

        DB::statement("
            UPDATE media
            SET responsive_images = '{}'
            WHERE responsive_images IS NULL
               OR responsive_images = ''
               OR JSON_VALID(responsive_images) = 0
        ");

        DB::table('media')
            ->whereNull('disk')
            ->orWhere('disk', '')
            ->update(['disk' => $defaultDisk]);

        DB::table('media')
            ->whereNull('conversions_disk')
            ->orWhere('conversions_disk', '')
            ->update(['conversions_disk' => $defaultDisk]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Data fix migration, no rollback needed.
    }
};
