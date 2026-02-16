<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('friday_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); // Tanggal Jumat
            
            $table->time('waktu');   // Jam mulai Sholat Jumat
            $table->string('khatib'); // Nama Khatib
            $table->string('imam')->nullable(); // Nama Imam (Opsional)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friday_schedules');
    }
};