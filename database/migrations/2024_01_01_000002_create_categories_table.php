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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // null = kategori default/global (bisa dipakai semua user)
            // diisi = kategori custom bikinan user sendiri
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->enum('type', ['income', 'expense']);
            $table->string('icon')->default('category'); // nama icon Material Symbols
            $table->string('color')->default('primary');  // dipakai buat warna chip/icon di UI
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};