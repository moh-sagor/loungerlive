<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->index()->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->string('instructor');
            $table->string('link')->nullable();
            $table->string('course_author');
            $table->unsignedBigInteger('user_id')->nullable(); // Use unsignedBigInteger
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('download_count')->default(0);
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