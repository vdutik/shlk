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
            $table->string('model_type',255)->nullable();
            $table->unsignedBigInteger("model_id")->nullable();
            $table->string('name', 128);
            $table->string('file_name', 128);
            $table->string('mime_type', 128);
            $table->text('description')->nullable();
            $table->string('extension', 8);
            $table->string('path', 512);
            $table->string('collection_name');
            $table->string('disk');
            $table->unsignedBigInteger('size');
            $table->json('custom_properties');
            $table->unsignedInteger('order_column')->nullable();
            $table->timestamps();

            $table->index(["model_type", "model_id"]);
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
