<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       public function up(): void
    {
        Schema::create('koord_toko', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko'); // Nama toko (misal: Canggu)
            $table->text('alamat')->nullable(); // Opsional: alamat lengkap
            $table->decimal('latitude', 10, 8);  // Presisi untuk koordinat GPS
            $table->decimal('longitude', 11, 8);
            $table->integer('radius')->default(50); // Radius dalam meter untuk validasi presensi
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koord_toko');
    }
};
