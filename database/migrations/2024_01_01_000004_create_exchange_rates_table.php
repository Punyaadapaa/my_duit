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
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('base_currency', 3)->default('USD');
            $table->string('target_currency', 3)->default('IDR');
            $table->decimal('rate', 15, 4);

            // Dipakai buat hitung naik/turun kurs (kayak di fitur "Cek Kurs Real-time")
            $table->decimal('change_percent', 8, 4)->default(0);

            $table->timestamp('fetched_at');
            $table->timestamps();

            $table->unique(['base_currency', 'target_currency', 'fetched_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_rates');
    }
};