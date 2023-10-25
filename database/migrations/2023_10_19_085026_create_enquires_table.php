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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('organName');
            $table->string('phone');
            $table->text('message');
            $table->foreignId('trainer_id')->nullable();
            $table->foreignId('course_id')->nullable();
            $table->timestamps();

            $table->foreign('trainer_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
