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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable(); // ie Desktop, Start Menu, ...
            $table->foreignId('parent_id')->nullable()->constrained('files')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('application')->default('file-explorer');
            $table->string('target')->nullable();
            $table->text('other')->nullable();
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
