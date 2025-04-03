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
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type_id');
            $table->string('title', 50);
            $table->date('due_date');
            $table->enum('status', ['finish', 'progress', 'fail']);
            $table->string('description', 200);

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('type_id')->references('id')->on('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};