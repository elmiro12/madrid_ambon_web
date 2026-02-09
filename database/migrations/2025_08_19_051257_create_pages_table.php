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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul Halaman
            $table->text('content'); // Konten Halaman
            $table->string('slug')->unique(); // Slug untuk URL
            $table->string('image')->nullable(); // Gambar Halaman
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_carousel')->default(false);
            $table->integer('hits')->default(0);
            $table->foreignId('menu_id')->nullable()->constrained('menus')->onDelete('set null');//set null
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
