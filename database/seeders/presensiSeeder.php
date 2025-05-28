<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class presensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        for ($i = 1; $i <= 2; $i++) {
            $tanggal = now()->subDays(rand(0, 30))->format('Y-m-d');
            $jamIn = now()->setTime(rand(7, 9), rand(0, 59))->format('H:i:s');
            $jamOut = now()->setTime(rand(16, 18), rand(0, 59))->format('H:i:s');

            DB::table('presensi')->insert([
                'nik' => '0987654321',
                'tanggal_presensi' => $tanggal,
                'jam_in' => $jamIn,
                'jam_out' => $jamOut,
                'foto_in' => 'dummy-in-' . $i . '.png',
                'foto_out' => 'dummy-out-' . $i . '.png',
                'location_in' => '-8.6' . rand(10000, 99999) . ',115.2' . rand(10000, 99999),
                'location_out' => '-8.6' . rand(10000, 99999) . ',115.2' . rand(10000, 99999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
