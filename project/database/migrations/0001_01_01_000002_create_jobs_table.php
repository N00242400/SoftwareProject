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

    Schema::create('services', function (Blueprint $table) {

        $table->id(); // service_id

        $table->foreignId('category_id')

              ->constrained()

              ->onDelete('cascade');

        $table->string('name');

        $table->text('description')->nullable();

        $table->string('email')->nullable();

        $table->string('phone')->nullable();

        $table->string('address');

        $table->enum('noise_level', ['low', 'medium', 'high']);

        $table->enum('lighting_level', ['low', 'medium', 'high']);

        $table->enum('crowd_level', ['low', 'medium', 'high']);

        $table->string('autism_friendly_hours')->nullable();

        $table->timestamps();

    });


 
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
