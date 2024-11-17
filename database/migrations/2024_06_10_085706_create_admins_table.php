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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_superadmin')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->text('image')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('type')->default('admin');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->text('bio')->nullable();
            $table->float('years_of_experience')->default(0)->nullable();
            $table->text('cv_file')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
