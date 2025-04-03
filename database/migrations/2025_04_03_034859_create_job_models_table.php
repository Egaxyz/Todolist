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
        Schema::create('job_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->enum('priority', ['high', 'mid', 'low']);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('attachment_url')->nullable();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('job');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_details');
    }
};