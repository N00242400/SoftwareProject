<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->enum('noise_level', ['low', 'medium', 'high'])->nullable();
            $table->enum('lighting_level', ['low', 'medium', 'high'])->nullable();
            $table->enum('crowd_level', ['low', 'medium', 'high'])->nullable();

            $table->string('autism_friendly_hours')->nullable();

            // Add foreign key to categories
            $table->foreignId('category_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};