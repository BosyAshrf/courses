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
            $table->text('title');
            $table->text('subtitle');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video_preview')->nullable();
            $table->string('preview_cover')->nullable();
            $table->integer('price');
            $table->integer('offer_price')->nullable();
            $table->string('status')->default('draft');
            $table->string('type')->default('online');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->boolean('has_certificate')->default(false);
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
