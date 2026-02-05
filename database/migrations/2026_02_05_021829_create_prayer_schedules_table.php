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
        Schema::create('prayer_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // Satu tanggal satu jadwal
        
            // Waktu Sholat 5 Waktu
            $table->time('subuh');
            $table->time('dzuhur');
            $table->time('ashar');
            $table->time('maghrib');
            $table->time('isya');

            // Khusus Hari Jumat
            $table->boolean('is_friday')->default(false);
            $table->time('waktu_jumat')->nullable(); // Jam sholat Jumat
            $table->string('khatib')->nullable(); // Nama Khatib
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_schedules');
    }
};
