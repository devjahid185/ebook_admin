<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // 1–5 stars
            $table->text('review')->nullable();
            $table->timestamps();

            $table->unique(['book_id', 'user_id']); // per-user one review
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_reviews');
    }
};
