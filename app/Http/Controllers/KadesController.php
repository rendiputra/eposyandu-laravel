<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KadesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan view dashboard admin
     * 
     * @return view
     */
    public function dashboard()
    {
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()]
                ])->get();

        $dataJumlahPosyandu = DB::table('posyandu')
                ->select(DB::raw('count(id_posyandu) as jumlah'))
                ->where('is_deleted', 0)
                ->get();
        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where('is_deleted', 0)
                ->get();

        // dd($dataJumlahBalita);
        return view('kades.dashboard', compact(
            'dataPemeriksaanBalita', 
            'dataJumlahPosyandu',
            'dataJumlahBalita'
        ));
    }
}
