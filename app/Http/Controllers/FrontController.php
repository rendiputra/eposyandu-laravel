<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Auth;

class FrontController extends Controller
{
    //

    /**
     * Landing Page
     * 
     * @return view
     */
    public function index()
    {
        $artikel = DB::Table('artikel')
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                ->limit('3')
                ->get();

        $galeri = DB::Table('galeri')
                ->where('is_deleted', false)
                ->get();
        
        return view('welcome',compact('artikel', 'galeri'));
    }

    /**
     * Daftar artikel
     * 
     * @return view
     */
    public function article()
    {
        $artikel = DB::Table('artikel')
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                // ->limit('3')
                ->paginate(12);

        return view('article',compact('artikel'));
    }

    /**
     * @param mixed $slug
     * 
     * @return view|abort
     */
    public function article_detail($slug)
    {
        $artikel = DB::Table('artikel')
                ->join('users','artikel.id_user','users.id')
                ->select('artikel.*','users.name as username')
                ->where('slug', $slug)
                ->where('is_deleted',false)
                ->first();

        if($artikel)
        {
            $allarticle = DB::Table('artikel')
                ->where('slug','!=',$slug)
                ->where('is_deleted',false)
                ->orderby('updated_at','desc')
                ->limit('8')
                ->get();

            return view('article-detail',compact('artikel','allarticle'));
        }
        return abort(404);
    }
    
    /**
     * Menampilkan info grafik
     * 
     * @return view
     */
    public function infografik()
    {
        // dd(Carbon::now()->subYear(1));
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()]
                ])->get();

        $dataJumlahBalitaLaki = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Laki-laki'],
                ])->get();

        $dataJumlahBalitaPerempuan = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Perempuan'],
                ])->get();

        $dataJumlahBalitaUmur = DB::table('balita')
                ->select(DB::raw('timestampdiff(year, tanggal_lahir, curdate()) as umur, count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                ])->groupBy('umur')
                ->get();

        $nowMonth = Carbon::now()->month;
        $nowYear = Carbon::now()->year;

        $dataStuntingLaki = DB::table('pemeriksaan_balita')
                ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->select('pemeriksaan_balita.status_stunting', DB::raw('count(pemeriksaan_balita.created_at) as jumlah'))
                ->whereRaw("
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = 'severely stunted' AND
                    month(pemeriksaan_balita.created_at) = $nowMonth AND
                    year(pemeriksaan_balita.created_at) = $nowYear AND
                    balita.jenis_kelamin = 'Laki-laki'
                ")->groupBy('status_stunting')
                ->get();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where('is_deleted', 0)
                ->get();

        return view('infografik', compact(
            'dataPemeriksaanBalita', 

            'dataJumlahBalitaLaki', 
            'dataJumlahBalitaPerempuan', 
            'dataJumlahBalitaUmur', 

            'dataJumlahBalita',            
            'dataStuntingLaki'
        ));
    }

    /**
     * Menampilkan info grafik balita
     * 
     * @return view
     */
    public function infografik_balita()
    {
        // dd(Carbon::now()->format('m'));
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()]
                ])->get();

        $dataPemeriksaanBalitaPerempuanSangatStunting = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "severely stunted" AND
                    balita.jenis_kelamin = "Perempuan" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();
        
        $dataPemeriksaanBalitaLakiSangatStunting = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "severely stunted" AND
                    balita.jenis_kelamin = "Laki-laki" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();

        $dataPemeriksaanBalitaPerempuanStunting = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "stunted" AND
                    balita.jenis_kelamin = "Perempuan" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();
        
        $dataPemeriksaanBalitaLakiStunting = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "stunted" AND
                    balita.jenis_kelamin = "Laki-laki" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();

        $dataPemeriksaanBalitaPerempuanBeratSangatKurang = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "severely underweight" AND
                    balita.jenis_kelamin = "Perempuan" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();
        
        $dataPemeriksaanBalitaLakiBeratSangatKurang = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "severely underweight" AND
                    balita.jenis_kelamin = "Laki-laki" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();

        $dataPemeriksaanBalitaPerempuanBeratKurang = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "underweight" AND
                    balita.jenis_kelamin = "Perempuan" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();
        
        $dataPemeriksaanBalitaLakiBeratKurang = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "underweight" AND
                    balita.jenis_kelamin = "Laki-laki" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();

        $dataPemeriksaanBalitaPerempuanBeratLebih = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "overweight" AND
                    balita.jenis_kelamin = "Perempuan" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();
        
        $dataPemeriksaanBalitaLakiBeratLebih = DB::table('pemeriksaan_balita')
                ->rightJoin('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->selectRaw('count(pemeriksaan_balita.id_balita) as jumlah')
                ->whereRaw('
                    pemeriksaan_balita.is_deleted = 0 AND
                    pemeriksaan_balita.status_stunting = "overweight" AND
                    balita.jenis_kelamin = "Laki-laki" AND
                    MONTH(pemeriksaan_balita.created_at) = MONTH(CURRENT_DATE())
                ')->get();

        $dataJumlahBalitaLaki = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Laki-laki'],
                ])->get();

        $dataJumlahBalitaPerempuan = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Perempuan'],
                ])->get();

        $dataJumlahBalitaUmur = DB::table('balita')
                ->select(DB::raw('timestampdiff(year, tanggal_lahir, curdate()) as umur, count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                ])->groupBy('umur')
                ->get();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where('is_deleted', 0)
                ->get();

        // dd($dataJumlahBalita);
        return view('infografik_balita', compact(
            'dataPemeriksaanBalita', 

            'dataJumlahBalitaLaki', 
            'dataJumlahBalitaPerempuan', 
            'dataJumlahBalitaUmur', 

            'dataJumlahBalita',
            'dataPemeriksaanBalitaLakiSangatStunting',
            'dataPemeriksaanBalitaPerempuanSangatStunting',
            'dataPemeriksaanBalitaLakiStunting',
            'dataPemeriksaanBalitaPerempuanStunting',

            'dataPemeriksaanBalitaLakiBeratSangatKurang',
            'dataPemeriksaanBalitaPerempuanBeratSangatKurang',
            'dataPemeriksaanBalitaLakiBeratKurang',
            'dataPemeriksaanBalitaPerempuanBeratKurang',
            'dataPemeriksaanBalitaLakiBeratLebih',
            'dataPemeriksaanBalitaPerempuanBeratLebih',

        ));
    }

    /**
     * Tembak endpoint flask model stunting
     * 
     * @return var $data_status
     */
    public static function GetStatusStunting($umur, $jk, $tinggi)
    {
        $client = new Client(['base_uri' => env('URL_STUNTING_MODEL_SERVICE', 'http://127.0.0.1:5000')]);
        $response = $client->request('GET', '/tt-u', [
            'json' => [
                'umur' => $umur,
                'jk' => $jk,
                'tinggi' => $tinggi
            ]
        ]);
        $data_status = $response->getBody();
        $data_status = json_decode($data_status);

        switch ($data_status->data[0]) {
            case "0" :
                $data_status = "severely stunted";
                break;
            case "1" :
                $data_status = "stunted";
                break;
            case "2" :
                $data_status = "normal";
                break;
            case "3" :
                $data_status = "tinggi";
                break;
            default :
                $data_status = "-";
        }

        return $data_status;
    }

    /**
     * Tembak endpoint flask model berat badan
     * 
     * @return var $data_status
     */
    public static function GetStatusBeratBadan($umur, $berat, $jk)
    {
        $client = new Client(['base_uri' => env('URL_STUNTING_MODEL_SERVICE', 'http://127.0.0.1:5000')]);
        $response = $client->request('GET', '/bb-u', [
            'json' => [
                'umur' => $umur,
                'berat' => $berat,
                'jk' => $jk
            ]
        ]);
        $data_status = $response->getBody();
        $data_status = json_decode($data_status);

        switch ($data_status->data[0]) {
            case "0" :
                $data_status = "severely underweight";
                break;
            case "1" :
                $data_status = "underweight";
                break;
            case "2" :
                $data_status = "normal";
                break;
            case "3" :
                $data_status = "overweight";
                break;
            default :
                $data_status = "-";
        }

        return $data_status;
    }

    public function test()
    {
        $data_status = FrontController::GetStatusBeratBadan(0, 3, 1);

        dd($data_status);
    }

}
