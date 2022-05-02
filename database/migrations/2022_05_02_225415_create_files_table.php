<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('model');
            $table->string('name', 128);
            $table->string('file_name', 128);
            $table->string('mime_type', 64);
            $table->text('description')->nullable();
            $table->string('extension', 8);
            $table->string('path', 512);
            $table->string('collection_name');
            $table->string('disk');
            $table->unsignedBigInteger('size');
            $table->json('custom_properties');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
