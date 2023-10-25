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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->references('id')->on('users');
            $table->string('name');
            $table->Integer('duration');
            $table->float('price', 8, 2);
            $table->integer('min_parts');
            $table->integer('max_parts');
            $table->string('level');
            $table->string('certificate');
            $table->text('description');
            $table->string('region')->nullable();
            $table->string('format');
            $table->boolean('approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
