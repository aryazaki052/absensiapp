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
Schema::create('presensi', function (Blueprint $table) {
    $table->id();
    $table->string('nik');
    $table->date('tanggal_presensi');
    $table->time('jam_in')->nullable();
    $table->time('jam_out')->nullable();
    $table->string('foto_in')->nullable();
    $table->string('foto_out')->nullable();
    $table->string('location_in')->nullable();
    $table->string('location_out')->nullable();
    $table->timestamps();

    // foreign key relasi ke users.nik
    $table->foreign('nik')->references('nik')->on('karyawan')->onDelete('cascade');
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Presensi');
    }
};
