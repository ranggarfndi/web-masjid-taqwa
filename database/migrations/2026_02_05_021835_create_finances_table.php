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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('category', ['masjid', 'yatim']); // Kategori: Masjid atau Yatim
            $table->enum('type', ['pemasukan', 'pengeluaran'])->default('pemasukan');
            $table->decimal('amount', 15, 2); // Nominal uang (support desimal/koma)
            $table->string('description')->nullable(); // Keterangan transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
