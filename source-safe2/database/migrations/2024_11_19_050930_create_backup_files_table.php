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
        Schema::create('backup_files', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('path');
            $table->integer('file_id');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->integer('version');
            $table->integer('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_files');
    }
};
