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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('show_id')->unique();
            $table->string('genre_ids')->nullable();
            $table->string('name');
            $table->float('rating')->default(0);
            $table->string('original_language')->default('N/A');
            $table->string('release_date')->nullable();
            $table->string('poster')->nullable();
            $table->string('backdrop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
