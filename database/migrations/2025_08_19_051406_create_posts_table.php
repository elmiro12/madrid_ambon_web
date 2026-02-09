<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Slug untuk URL
            $table->string('title'); // Judul Postingan
            $table->text('content'); // Konten Postingan
            $table->string('image')->nullable(); // Gambar Postingan
            $table->timestamp('published_at')->nullable(); // Waktu publikasi, nullable jika belum dipublikasikan
            $table->boolean('is_published')->default(false); // Status Publikasi
            $table->string('summary');
            $table->string('keywords')->nullable();
            $table->integer('hits')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('post_categories')->onDelete('set null');//set null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
