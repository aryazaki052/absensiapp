<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KoordTokoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('koord_toko')->insert([
            [
                'nama_toko' => 'Vape Escape Canggu',
                'alamat' => 'Canggu, Bali',
                'latitude' => -8.6363029903019,
                'longitude' => 115.14663080712283,
                'radius' => 50
            ],
            [
                'nama_toko' => 'Vape Escape Ubud',
                'alamat' => 'Ubud, Bali',
                'latitude' => -8.51664365890839,
                'longitude' => 115.26938866898207,
                'radius' => 50
            ],
            [
                'nama_toko' => 'Vape Escape Kuta',
                'alamat' => 'Kuta, Bali',
                'latitude' => -8.7234688016332,
                'longitude' => 115.17526292246993,
                'radius' => 50
            ],
            [
                'nama_toko' => '69 Vape Gunung Salak',
                'alamat' => 'Gunung Salak, Bali',
                'latitude' => -8.673197088190436,
                'longitude' => 115.18151508275216,
                'radius' => 50
            ],
            [
                'nama_toko' => '69 Vape Penatih',
                'alamat' => 'Penatih, Denpasar',
                'latitude' => -8.621262731695728,
                'longitude' => 115.24094115130465,
                'radius' => 50
            ],
            [
                'nama_toko' => '69 Vape Kebo Iwa',
                'alamat' => 'Kebo Iwa, Denpasar',
                'latitude' => -8.643317603326487,
                'longitude' => 115.18602944088664,
                'radius' => 50
            ],
            [
                'nama_toko' => 'Vaporsnesia',
                'alamat' => 'Denpasar',
                'latitude' => -8.592159619492703,
                'longitude' => 115.2154268673056,
                'radius' => 50                
            ],
            [
                'nama_toko' => 'Dragon Vape Celuk',
                'alamat' => 'Celuk, Gianyar',
                'latitude' => -8.602902302090735,
                'longitude' => 115.2806479243227,
                'radius' => 50
            ],
            [
                'nama_toko' => 'Black Rabbit Gianyar',
                'alamat' => 'Gianyar, Bali',
                'latitude' => -8.534633370946352,
                'longitude' => 115.31160778199435,
                'radius' => 50
            ],
        ]);
    }
}
