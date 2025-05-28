<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class presensiController extends Controller
{
   public function create()
{
    $hariini = date('Y-m-d');
    $nik = Auth::guard('karyawan')->user()->nik;

    $cek = DB::table('presensi')->where('tanggal_presensi', $hariini)->where('nik', $nik)->count();
    if ($cek>0) {
        $ket = 'out';
    }else{
        $ket = 'in';
    };

    // Ambil koordinat toko
    $penempatan = DB::table('karyawan')->where('nik', $nik)->value('penempatan');
    $toko = DB::table('koord_toko')->where('id', $penempatan)->first();

    if (!$toko) {
        abort(404, "Lokasi toko tidak ditemukan.");
    }

    $lokasi_toko = [
        'latitude' => $toko->latitude,
        'longitude' => $toko->longitude
    ];

    return view('presensi.create', compact('cek', 'lokasi_toko'));
}


public function store(Request $request)
{
    $nik = Auth::guard('karyawan')->user()->nik;

    // Ambil penempatan user (id toko)
    $penempatan = DB::table('karyawan')->where('nik', $nik)->value('penempatan');

    if (!$penempatan) {
        return response()->json(['error' => 'Data penempatan toko tidak ditemukan'], 400);
    }

    // Ambil koordinat toko dari tabel koord_toko
    $toko = DB::table('koord_toko')->where('id', $penempatan)->first();

    if (!$toko) {
        return response()->json(['error' => 'Data toko tidak ditemukan'], 400);
    }

    $tanggalPresensi = date("Y-m-d");
    $jam = date("H:i:s");
    $lokasi = $request->lokasi; // format "lat,lng"
    $image = $request->image;

        // Cek apakah user sudah presensi hari ini
    $cek = DB::table('presensi')
        ->where('tanggal_presensi', $tanggalPresensi)
        ->where('nik', $nik)
        ->first();
    if ($cek !== null) {
        $ket = 'out';
    }else{
        $ket = 'in';
    };

    // Validasi lokasi user
    if (!$lokasi || !str_contains($lokasi, ',')) {
        return response()->json(['error' => 'Lokasi tidak valid'], 400);
    }

    list($latUser, $lngUser) = explode(',', $lokasi);
    $latUser = floatval($latUser);
    $lngUser = floatval($lngUser);

    // Koordinat toko
    $latToko = floatval($toko->latitude);
    $lngToko = floatval($toko->longitude);

    // Hitung jarak dalam meter
    $distance = $this->distance($latUser, $lngUser, $latToko, $lngToko)['meters'];

    if ($distance > 50) {
        return response()->json(['error' => 'Anda berada di luar radius 50 meter dari toko. Absen gagal.'], 400);
    }

    // $folderPath = "public/uploads/absensi/";
    $filename = $nik . "-" . $tanggalPresensi . "-" . $ket . ".png"; 

    // Validasi gambar base64
    $image_parts = explode(";base64,", $image);
    if (!isset($image_parts[1])) {
        return response()->json(['error' => 'Invalid image data'], 400);
    }
    $image_base64 = base64_decode($image_parts[1]);



    if ($cek) {
        // Update jam_out
        $dataPulang = [
            'jam_out' => $jam,
            'foto_out' => $filename,
            'location_out' => $lokasi
        ];

        $update = DB::table('presensi')
            ->where('tanggal_presensi', $tanggalPresensi)
            ->where('nik', $nik)
            ->update($dataPulang);

         if ($update) {
            file_put_contents(public_path('uploads/absensi/' . $filename), $image_base64);
                // Storage::put($folderPath . $filename, $image_base64);
                echo "success|Terimakasih, Hati - Hati Di Jalan|out";
            } else {
                echo "error|Maaf Gagal Absen, Hubungi Tim IT|out";
            }
    } else {
        // Insert jam_in
        $dataMasuk = [
            'nik' => $nik,
            'tanggal_presensi' => $tanggalPresensi,
            'jam_in' => $jam,
            'foto_in' => $filename,
            'location_in' => $lokasi
        ];

        $simpan = DB::table('presensi')->insert($dataMasuk);

        if ($simpan) {
                // Storage::put($folderPath . $filename, $image_base64);
                file_put_contents(public_path('uploads/absensi/' . $filename), $image_base64);

                echo "success|Terimakasih, Selamat Bekerja|in";
            } else {
                echo "error|Maaf Gagal Absen, Hubungi Tim IT|out";
            }
    }
}


   function distance($lat1, $lon1, $lat2, $lon2)
{
    $earthRadius = 6371000; // radius bumi dalam meter

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLon / 2) * sin($dLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c;

    return ['meters' => $distance];
}

}
