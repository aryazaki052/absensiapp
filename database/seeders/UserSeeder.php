<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari nama toko
        $cangguId = DB::table('koord_toko')->where('nama_toko', 'Vape Escape Canggu')->value('id');
        $ubudId = DB::table('koord_toko')->where('nama_toko', 'Vape Escape Ubud')->value('id');
        $kutaId = DB::table('koord_toko')->where('nama_toko', 'Vape Escape Kuta')->value('id');
        $gnsalakId = DB::table('koord_toko')->where('nama_toko', '69 Vape Gunung Salak')->value('id');

        DB::table('karyawan')->insert([
            [
                'nik' => '1234567890',
                'nama_lengkap' => 'Agus Santoso',
                'jabatan' => 'Staff',
                'no_hp' => '081234567890',
                'password' => Hash::make('password123'),
                'penempatan' => $cangguId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '0987654321',
                'nama_lengkap' => 'Dewi Lestari',
                'jabatan' => 'Admin',
                'no_hp' => '081298765432',
                'password' => Hash::make('adminpass'),
                'penempatan' => $ubudId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '12345678',
                'nama_lengkap' => 'Arya Zaki',
                'jabatan' => 'Admin',
                'no_hp' => '081298765432',
                'password' => Hash::make('adminpass'),
                'penempatan' => $kutaId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '0000',
                'nama_lengkap' => 'Agus Setyadi',
                'jabatan' => 'Vaporista',
                'no_hp' => '081298765432',
                'password' => Hash::make('12345678'),
                'penempatan' => $gnsalakId,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

