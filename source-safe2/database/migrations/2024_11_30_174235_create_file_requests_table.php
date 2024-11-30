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
        Schema::create('file_requests', function (Blueprint $table) {
            $table->integer('id')->autoIncrement(); // Auto-incrementing primary key
            $table->string('file_name'); // Name of the file
            $table->string('file_path'); // Path to the file
            $table->unsignedBigInteger('uploaded_by'); // User ID who uploaded the file
            $table->unsignedBigInteger('group_id'); // Group ID to which the file is uploaded
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // File status
            $table->text('remarks')->nullable(); // Optional remarks (e.g., rejection reason)
            $table->timestamps(); // Created and updated timestamps
            // Foreign keys
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_requests');
    }
};
