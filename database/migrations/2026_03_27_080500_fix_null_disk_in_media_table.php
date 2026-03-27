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
