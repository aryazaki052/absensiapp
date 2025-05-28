<?php

namespace App\Http\Controllers;

use App\Models\DashboardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama = DB::table('karyawan')
    ->join('koord_toko', 'karyawan.penempatan', '=', 'koord_toko.id')
    ->select('karyawan.*', 'koord_toko.nama_toko as nama_toko')
    ->where('karyawan.nik', $nik)
    ->first();
        $presensiNow = DB::table('presensi')->where('nik',$nik)->where('tanggal_presensi',$now)->first();
         $history = DB::table('presensi')
                ->where('nik', $nik)
                ->orderBy('tanggal_presensi', 'desc')
                ->limit(30)
                ->get();
        return (view('dashboard.dashboard', compact('presensiNow', 'nama', 'history')));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DashboardModel $dashboardModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DashboardModel $dashboardModel)
    {
        //
    }
}
