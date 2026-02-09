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
        Schema::create('menus', function (Blueprint $table) {;
            $table->id();
            $table->string('name'); // Nama Menu
            $table->string('slug')->unique(); // Slug untuk URL
            $table->string('icon')->nullable(); // Ikon untuk menu, bisa berupa nama kelas ikon atau URL gamba
            $table->boolean('is_active')->default(true); // Status aktif menu
            $table->integer('order')->default(0); // Urutan menu
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade'); // Menyimpan parent menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
