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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Platform Social Media
            $table->string('url'); // URL Social Media
            $table->string('icon'); // Icon untuk Social Media, bisa berupa nama class icon font-awesome atau sejenisnya
            $table->boolean('is_active')->default(true); // Status aktif tidaknya social media
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
