<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Foreign key to services
            $table->foreignId('service_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Foreign key to users
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Optional review content
            $table->text('description')->nullable();

            // Ratings
            $table->enum('noise_rating', ['low', 'medium', 'high'])->nullable();
            $table->enum('lighting_rating', ['low', 'medium', 'high'])->nullable();
            $table->enum('crowd_rating', ['low', 'medium', 'high'])->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};