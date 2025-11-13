<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Перевіряємо та додаємо відсутні колонки безпосередньо через SQL
        // для уникнення проблем з hasColumn на деяких версіях MySQL
        $columns = DB::select("SHOW COLUMNS FROM `media`");
        $columnNames = array_column($columns, 'Field');
        
        if (!in_array('uuid', $columnNames)) {
            DB::statement("ALTER TABLE `media` ADD COLUMN `uuid` CHAR(36) NULL UNIQUE AFTER `model_id`");
        }
        
        if (!in_array('conversions_disk', $columnNames)) {
            DB::statement("ALTER TABLE `media` ADD COLUMN `conversions_disk` VARCHAR(255) NULL AFTER `disk`");
        }
        
        if (!in_array('generated_conversions', $columnNames)) {
            DB::statement("ALTER TABLE `media` ADD COLUMN `generated_conversions` JSON NOT NULL AFTER `custom_properties`");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = DB::select("SHOW COLUMNS FROM `media`");
        $columnNames = array_column($columns, 'Field');
        
        if (in_array('uuid', $columnNames)) {
            DB::statement("ALTER TABLE `media` DROP COLUMN `uuid`");
        }
        
        if (in_array('conversions_disk', $columnNames)) {
            DB::statement("ALTER TABLE `media` DROP COLUMN `conversions_disk`");
        }
        
        if (in_array('generated_conversions', $columnNames)) {
            DB::statement("ALTER TABLE `media` DROP COLUMN `generated_conversions`");
        }
    }
};

