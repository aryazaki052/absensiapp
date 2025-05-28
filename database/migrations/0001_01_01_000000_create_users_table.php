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
    Schema::create('karyawan', function (Blueprint $table) {
    $table->id();
    $table->string('nik')->unique();
    $table->string('nama_lengkap');
    $table->string('jabatan');
    $table->unsignedBigInteger('penempatan'); // relasi ke id di koord_toko
    $table->string('no_hp');
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();

    // Foreign key constraint
    $table->foreign('penempatan')->references('id')->on('koord_toko')->onDelete('cascade');
});


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
