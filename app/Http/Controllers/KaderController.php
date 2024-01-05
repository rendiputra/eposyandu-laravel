<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\PemeriksaanBalita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;

class KaderController extends Controller
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
     * Menampilkan view dashboard kader
     * 
     * @return view
     */
    public function dashboard2()
    {
        $user = Auth::user();
        
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        return view('kader.dashboard', compact(
            'dataPemeriksaanBalita', 
            'dataJumlahBalita', 
        ));
    }

    /**
     * Menampilkan view dashboard kader
     * 
     * @return view
     */
    public function dashboard()
    {
        $user = Auth::user();

        $posyandu = DB::table('posyandu')
                ->select('nama')
                ->where('id_posyandu', $user->id_posyandu)
                ->first();

        // dd(Carbon::now()->subYear(1));
        $dataPemeriksaanBalita = DB::table('pemeriksaan_balita')
                ->select('id_pemeriksaan_balita', 'created_at', DB::raw('YEAR(created_at) as tahun, month(created_at) as bulan, count(created_at) as jumlah'))
                ->groupBy(DB::raw('month(created_at)'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        $dataJumlahBalitaLaki = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Laki-laki'],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();
        $dataJumlahBalitaPerempuan = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['jenis_kelamin', 'Perempuan'],
                    ['id_posyandu', $user->id_posyandu],
                ])->get();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where('is_deleted', 0)
                ->get();

        $dataJumlahBalitaStuntingPerBulanIni = DB::table(DB::raw("
                    (SELECT id_balita, status_stunting
                    FROM pemeriksaan_balita
                    WHERE status_stunting IN ('severely stunted', 'stunted')
                    AND id_posyandu = ".$user->id_posyandu."
                    AND created_at BETWEEN CURRENT_DATE - INTERVAL 1 MONTH AND CURRENT_DATE)
                    AS filtered_data
                "))
                ->select(DB::raw('COUNT(DISTINCT id_balita) AS total_balita'))
                ->first();

        // dd($dataJumlahBalitaStuntingPerBulanIni);
        return view('kader.dashboard', compact(
            'posyandu',
            'dataPemeriksaanBalita', 

            'dataJumlahBalitaLaki', 
            'dataJumlahBalitaPerempuan', 
            
            'dataJumlahBalita',
            'dataJumlahBalitaStuntingPerBulanIni'
        ));
    }

    /**
     * Menampilkan daftar data pemeriksaan balita berdasarkan id_posyandu user.
     * 
     * @return void
     */
    public function list_pemeriksaan_balita() 
    {
        $user = Auth::user();

        $balita = DB::table('balita')
            ->select('id_balita', 'nama', 'nama_ibu')
            ->where([
                ['id_posyandu', $user->id_posyandu]
            ])->get();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['pemeriksaan_balita.id_posyandu', $user->id_posyandu],
            ])->orderByDesc('id_pemeriksaan_balita')
            ->get();

        $posyandu = DB::table('posyandu')
            ->select('nama')
            ->where('id_posyandu', Auth::user()->id_posyandu)
            ->first();
        
        $empty = count($data);

        return view('kader.balita.index', compact(['data', 'empty', 'balita', 'posyandu']));
    }

    /**
     * Menampilkan detail data pemerksaan balita berdasarkan id balita.
     * 
     * @param integer id_balita
     * @return void
     */
    public function detail_pemeriksaan_balita($id)
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.*', 'pemeriksaan_balita.created_at as tanggal_periksa')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['pemeriksaan_balita.id_posyandu', $user->id_posyandu],
                ['pemeriksaan_balita.id_pemeriksaan_balita', $id],
            ])->first();
        
        if(!$data)
        {
            return abort(404);
        }

        // hitung umur
        $tanggal_lahir = Carbon::parse($data->tanggal_lahir);
        $tanggal_pemeriksaan = Carbon::parse($data->tanggal_periksa);
        $umur_bulan = $tanggal_pemeriksaan->diffInMonths($tanggal_lahir);

        return view('kader.balita.detailpemeriksaan', compact('data', 'umur_bulan'));
    }

    /**
     * Menampilkan view kader/balita/create dengan membawa daa balita
     * @param Request $req
     * 
     * @return view
     */
    public function periksa_balita(Request $req) 
    {
        $id_balita = $req->id_balita;
        $data = Balita::select('id_balita', 'nama', 'nik')
            ->findOrFail($id_balita);

        $vaksin = DB::table('vaksin')
            ->where('is_deleted', 0)
            ->get();

        return view('kader.balita.create', compact('data', 'vaksin'));
    }

    /**
     * Menyimpan data hasil pemeriksaan
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function periksa_balita_act(Request $req)
    {
        $req->validate([
            'id_balita'=> 'required|exists:App\Models\Balita,id_balita',
            'berat_badan'=> 'required|numeric',
            'tinggi_badan'=> 'required|numeric',
            'lingkar_lengan_atas'=> 'required|numeric',
            'lingkar_kepala'=> 'required|numeric',
            'tanggal_periksa'=> 'required',
            'vaksin'=> 'required',

        ],
        [
            'berat_badan.required'=> 'Kolom "berat badan" wajib diisi.',
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.required'=> 'Kolom "tinggi badan" wajib diisi.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_lengan_atas.required'=> 'Kolom "Lingkar lengan atas" wajib diisi.',
            'lingkar_lengan_atas.numeric'=> 'Kolom "Lingkar lengan atas" tidak bisa diisikan selain angka.',
            'lingkar_kepala.required'=> 'Kolom "Lingkar kepala" wajib diisi.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);

        $user = Auth::user();

        $data_balita = Balita::selectRaw("timestampdiff(month, tanggal_lahir, curdate()) as umur, jenis_kelamin")->findOrFail($req->id_balita);
        // umur
        $date_lahir = Carbon::parse($data_balita->tanggal_lahir);
        $date_periksa = Carbon::parse($req->tanggal_periksa);
        $umur = $date_lahir->diffInMonths($date_periksa);

        // get endpount
        $data_status_stunting = FrontController::GetStatusStunting($umur, 
                $data_balita->jenis_kelamin == "Laki-laki" ? 0 : 1, 
                $req->tinggi_badan);
        $data_status_berat_badan = FrontController::GetStatusBeratBadan($umur, 
                $req->berat_badan,
                $data_balita->jenis_kelamin == "Laki-laki" ? 0 : 1);

        DB::transaction(function () use ($req, $user, $data_status_stunting, $data_status_berat_badan){
            $balita = new PemeriksaanBalita();
            $balita->id_balita = $req->id_balita;
            $balita->vaksin = $req->vaksin;
            $balita->berat_badan = $req->berat_badan;
            $balita->tinggi_badan = $req->tinggi_badan;
            $balita->lingkar_lengan_atas = $req->lingkar_lengan_atas;
            $balita->lingkar_kepala = $req->lingkar_kepala;
            $balita->status_stunting = $data_status_stunting;
            $balita->status_berat_badan = $data_status_berat_badan;
            $balita->id_posyandu = $user->id_posyandu;
            $balita->created_at = $req->tanggal_periksa;
            $balita->id_user_petugas = $user->id;
            $balita->save();
        });

        if(Auth::user()->role == "4"){
            return redirect()->route('admin.list_pemeriksaan_balita')->with('sukses', 'Berhasil menambahkan data pemeriksaan balita.');
        } else {
            return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil menambahkan data pemeriksaan balita.');
        }
    }

    /**
     * Menampilkan view update data pemeriksaan 
     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return view
     */
    public function update_pemeriksaan_balita($id)
    {
        $data = PemeriksaanBalita::findOrFail($id);

        $balita = Balita::findOrFail($data->id_balita);

        $vaksin = DB::table('vaksin')
            ->where('is_deleted', 0)
            ->get();

        return view('kader.balita.update', compact('data', 'balita', 'vaksin'));
    }

    /**
     * Mengubah data pemeriksaan balita
     * 
     * @param Request $req
     * @param id_pemeriksaan_balita $id
     * 
     * @return redirect]
     */
    public function update_pemeriksaan_balita_act(Request $req, $id)
    {
        $req->validate([
            'berat_badan'=> 'required|numeric',
            'tinggi_badan'=> 'required|numeric',
            'lingkar_lengan_atas'=> 'required|numeric',
            'lingkar_kepala'=> 'required|numeric',
            'tanggal_periksa'=> 'required',
            'vaksin'=> 'required',

        ],
        [
            'berat_badan.required'=> 'Kolom "berat badan" wajib diisi.',
            'berat_badan.numeric'=> 'Kolom "berat badan" tidak bisa diisikan selain angka.',
            'tinggi_badan.required'=> 'Kolom "tinggi badan" wajib diisi.',
            'tinggi_badan.numeric'=> 'Kolom "tinggi badan" tidak bisa diisikan selain angka.',
            'lingkar_lengan_atas.required'=> 'Kolom "Lingkar lengan atas" wajib diisi.',
            'lingkar_lengan_atas.numeric'=> 'Kolom "Lingkar lengan atas" tidak bisa diisikan selain angka.',
            'lingkar_kepala.required'=> 'Kolom "Lingkar kepala" wajib diisi.',
            'lingkar_kepala.numeric'=> 'Kolom "Lingkar kepala" tidak bisa diisikan selain angka.',
        ]);

        $user = Auth::user();
        // $tanggal_periksa = Carbon::createFromFormat('Y-m-d', $req->tanggal_periksa);
        // dd($tanggal_periksa);
        // TODO : date
        $data_balita = Balita::selectRaw("timestampdiff(month, tanggal_lahir, curdate()) as umur, jenis_kelamin, tanggal_lahir")->findOrFail($req->id_balita);
        
        // umur
        $date_lahir = Carbon::parse($data_balita->tanggal_lahir);
        $date_periksa = Carbon::parse($req->tanggal_periksa);
        $umur = $date_lahir->diffInMonths($date_periksa);

        // get endpoint
        $data_status_stunting = FrontController::GetStatusStunting($umur, 
                $data_balita->jenis_kelamin == "Laki-laki" ? 0 : 1, 
                $req->tinggi_badan);
        $data_status_berat_badan = FrontController::GetStatusBeratBadan($umur, 
                $req->berat_badan,
                $data_balita->jenis_kelamin == "Laki-laki" ? 0 : 1);

        DB::transaction(function () use ($req, $id, $data_status_stunting, $data_status_berat_badan){
            $balita = PemeriksaanBalita::findOrFail($id);
            $balita->vaksin = $req->vaksin;
            $balita->berat_badan = $req->berat_badan;
            $balita->tinggi_badan = $req->tinggi_badan;
            $balita->lingkar_lengan_atas = $req->lingkar_lengan_atas;
            $balita->lingkar_kepala = $req->lingkar_kepala;
            $balita->status_stunting = $data_status_stunting;
            $balita->status_berat_badan = $data_status_berat_badan;
            $balita->created_at = $req->tanggal_periksa;
            $balita->id_user_petugas = Auth::user()->id;
            $balita->update();
        });
        
        if(Auth::user()->role == "4"){
            return redirect()->route('admin.list_pemeriksaan_balita')->with('sukses', 'Berhasil mengubah data pemeriksaan balita.');
        } else {
            return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil mengubah data pemeriksaan balita.');
        }
    }

    /**
     * menghapus data pemeriksaan balita     * 
     * @param id_pemeriksaan_balita $id
     * 
     * @return redirect
     */
    public function delete_pemeriksaan_balita($id) 
    {
        DB::transaction(function () use ($id){
            $balita = PemeriksaanBalita::findOrFail($id);
            $balita->is_deleted = 1;
            $balita->update();
        });

        return redirect()->route('kader.list_pemeriksaan_balita')->with('sukses', 'Berhasil menghapus data pemeriksaan balita.');
    }

        /**
     * Menampilkan daftar data balita
     * 
     * @return void
     */
    public function list_balita() 
    {
        $data = DB::table('balita')
            ->select('id_balita', 'nik', 'nama', 'no_kk', 'nama_ibu', 'jenis_kelamin', 'tanggal_lahir')
            ->where([
                ['is_deleted', 0],
                ['id_posyandu', Auth::user()->id_posyandu],
            ])->get();
        
        $empty = count($data);

        return view('kader.list-balita', compact(['data', 'empty']));
    }


    /**
      * Menampilkan view kader/tambah-balita
      * 
      * @return view kader/tambah-balita
      */
    public function tambah_balita() 
    {
        return view('kader.tambah-balita');
    }

    /**
      * Menyimpan data balita ke database
      * 
      * @return redirect to kader.list_balita
      */
    public function tambah_balita_act(Request $req) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\Balita,nik',
            'no_kk'=> 'required|digits:16|numeric',
            'nik_ibu'=> 'required|digits:16|numeric',
            'nama_ibu'=> 'required',
            'nik_ayah'=> 'required|digits:16|numeric',
            'nama_ayah'=> 'required',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tanggal_lahir'=> 'required|date',
            'berat_badan_lahir'=> 'required|numeric',
            'tinggi_badan_lahir'=> 'required|numeric',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'nik.unique'=> 'Nomor "NIK" sudah digunakan.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_ibu.required'=> 'Kolom "NIK Ibu" wajib diisi.',
            'nik_ibu.digits'=> 'Jumlah digit "NIK Ibu" tidak valid.',
            'nik_ibu.numeric'=> 'Kolom "NIK Ibu" tidak bisa diisikan selain angka.',
            'nama_ibu.required'=> 'Kolom "nama Ibu" wajib diisi.',
            'nik_ayah.required'=> 'Kolom "NIK Ayah" wajib diisi.',
            'nik_ayah.digits'=> 'Jumlah digit "NIK Ayah" tidak valid.',
            'nik_ayah.numeric'=> 'Kolom "NIK Ayah" tidak bisa diisikan selain angka.',
            'nama_ayah.required'=> 'Kolom "nama Ayah" wajib diisi.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "tanggal lahir" tidak valid.',
            'berat_badan_lahir.required'=> 'Kolom "berat badan saat lahir" wajib diisi.',
            'berat_badan_lahir.numeric'=> 'Kolom "berat badan saat lahir" tidak bisa diisikan selain angka.',
            'tinggi_badan_lahir.required'=> 'Kolom "tinggi badan saat lahir" wajib diisi.',
            'tinggi_badan_lahir.numeric'=> 'Kolom "tinggi badan saat lahir" tidak bisa diisikan selain angka.',
        ]);

        DB::transaction(function () use ($req){
            $balita = new Balita();
            $balita->nama = $req->nama;
            $balita->nik = $req->nik;
            $balita->no_kk = $req->no_kk;
            $balita->nik_ibu = $req->nik_ibu;
            $balita->nama_ibu = $req->nama_ibu;
            $balita->nik_ayah = $req->nik_ayah;
            $balita->nama_ayah = $req->nama_ayah;
            $balita->tanggal_lahir = $req->tanggal_lahir;
            $balita->jenis_kelamin = $req->jenis_kelamin;
            $balita->berat_badan_lahir = $req->berat_badan_lahir;
            $balita->tinggi_badan_lahir = $req->tinggi_badan_lahir;
            $balita->id_posyandu = Auth::user()->id_posyandu;
            $balita->save();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menambahkan data balita.');
    }

    /**
      * Menampilkan view kader/update-balita
      * 
      * @param id_balita $id
      * @return view kader/update-balita
      */
    public function update_balita($id) 
    {
        $data = Balita::where([
            ['is_deleted', 0],
            ['id_posyandu', Auth::user()->id_posyandu],
        ])->findOrFail($id);

        return view('kader.update-balita', compact('data'));
    }

    /**
      * Mengubah data balita
      * 
      * @param id_balita $id
      * @return redirect to kader.list_balita
      */
    public function update_balita_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'nik_ibu'=> 'required|digits:16|numeric',
            'nama_ibu'=> 'required',
            'nik_ayah'=> 'required|digits:16|numeric',
            'nama_ayah'=> 'required',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tanggal_lahir'=> 'required|date',
            'berat_badan_lahir'=> 'required|numeric',
            'tinggi_badan_lahir'=> 'required|numeric',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'nik_ibu.required'=> 'Kolom "NIK Ibu" wajib diisi.',
            'nik_ibu.digits'=> 'Jumlah digit "NIK Ibu" tidak valid.',
            'nik_ibu.numeric'=> 'Kolom "NIK Ibu" tidak bisa diisikan selain angka.',
            'nama_ibu.required'=> 'Kolom "nama Ibu" wajib diisi.',
            'nik_ayah.required'=> 'Kolom "NIK Ayah" wajib diisi.',
            'nik_ayah.digits'=> 'Jumlah digit "NIK Ayah" tidak valid.',
            'nik_ayah.numeric'=> 'Kolom "NIK Ayah" tidak bisa diisikan selain angka.',
            'nama_ayah.required'=> 'Kolom "nama Ayah" wajib diisi.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'tanggal_lahir.required'=> 'Kolom "Tanggal lahir" wajib diisi.',
            'tanggal_lahir.date'=> 'Format tanggal "tanggal lahir" tidak valid.',
            'berat_badan_lahir.required'=> 'Kolom "berat badan saat lahir" wajib diisi.',
            'berat_badan_lahir.numeric'=> 'Kolom "berat badan saat lahir" tidak bisa diisikan selain angka.',
            'tinggi_badan_lahir.required'=> 'Kolom "tinggi badan saat lahir" wajib diisi.',
            'tinggi_badan_lahir.numeric'=> 'Kolom "tinggi badan saat lahir" tidak bisa diisikan selain angka.',
        ]);
        
        DB::transaction(function () use ($req, $id){
            $balita = Balita::findOrFail($id);
            $balita->nama = $req->nama;
            $balita->nik = $req->nik;
            $balita->no_kk = $req->no_kk;
            $balita->nik_ibu = $req->nik_ibu;
            $balita->nama_ibu = $req->nama_ibu;
            $balita->nik_ayah = $req->nik_ayah;
            $balita->nama_ayah = $req->nama_ayah;
            $balita->tanggal_lahir = $req->tanggal_lahir;
            $balita->jenis_kelamin = $req->jenis_kelamin;
            $balita->berat_badan_lahir = $req->berat_badan_lahir;
            $balita->tinggi_badan_lahir = $req->tinggi_badan_lahir;
            $balita->id_posyandu = Auth::user()->id_posyandu;
            $balita->update();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil mengubah data balita.');
    }

    /**
      * Menghapus data balita
      * 
      * @param id_balita $id
      * @return redirect()
      */
    public function delete_balita($id) 
    {
        DB::transaction(function () use ($id){
            $balita = Balita::findOrFail($id);
            $balita->is_deleted = 1;
            $balita->update();
        });

        return redirect()->route('kader.list_balita')->with('sukses', 'Berhasil menghapus data balita.');
    }
    
    /**
     * Menampilkan daftar data akun
     * 
     * @return view kader.list-akun
     */
    public function list_akun() 
    {
        $data = DB::table('users')
            ->select('id', 'name', 'no_telp', 'nik', 'role', 'alamat')
            ->where([
                ['is_delete', 0],
                ['id_posyandu', Auth::user()->id_posyandu],
            ])->get();
        
        $empty = count($data);

        return view('kader.list-akun', compact(['data', 'empty']));
    }

    /**
     * Menampilkan view tambah akun
     * 
     * @return view
     */
    public function tambah_akun() {
        return view('kader.tambah-akun');
    }

    /**
     * Menyimpan data oengguna
     * 
     * @param Request $req
     * 
     * @return Redirect
     */
    public function tambah_akun_act(Request $req)
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric|unique:App\Models\User,nik',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'role'=> ['required', Rule::in(['1', '2'])],

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'nik.unique'=> 'Nomor "NIK" sudah digunakan.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.min'=> 'Kolom "Password" harus minimal 8 karakter.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $user = new User();
            $user->name = $req->nama;
            // $user->email = 'admin' . rand(1,999) . '@email.test';
            $user->nik = $req->nik;
            $user->no_kk = $req->no_kk;
            $user->password = Hash::make($req->password);
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->role = $req->role;
            $user->id_posyandu = Auth::user()->id_posyandu;
            $user->save();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil menambahkan data akun '. $req->nama . '.');
    }

    
    /**
     * Menampilkan view update data akun
     * 
     * @param user_id $id
     * 
     * @return view
     */
    public function update_akun($id)
    {
        $data = User::where([
                    ['is_delete', 0],
                    ['id', $id],
                    ['id_posyandu', Auth::user()->id_posyandu],
                ])->firstOrFail();

        return view('kader.update-akun', compact('data'));
    }

    /**
     * mengubah data akun
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return [type]
     */
    public function update_akun_act(Request $req, $id)
    {
        $req->validate([
            'nama'=> 'required',
            'nik'=> 'required|digits:16|numeric',
            'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'role'=> ['required', Rule::in(['1', '2'])],

        ],
        [
            'nama.required'=> 'Kolom "Nama" wajib diisi.',
            'nik.required'=> 'Kolom "NIK" wajib diisi.',
            'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_kelamin . ' tidak valid.',
            'role.in'=> $req->role . ' tidak valid.',
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
        ]);

        DB::transaction(function () use ($req, $id){
            $user = User::findOrFail($id);
            $user->name = $req->nama;
            $user->nik = $req->nik;
            $user->no_kk = $req->no_kk;
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->role = $req->role;
            $user->id_posyandu = Auth::user()->id_posyandu;
            $user->update();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil mengubah data akun '. $req->nama . '.');
    }

    /**
     * Mengubah password akun pengguna
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return redirect
     */
    public function update_password_act(Request $req, $id)
    {
        $req->validate([
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'password.required'=> 'Kolom "Password" wajib diisi.',
            'password.confirmed'=> 'Kolom "Password" dan kolom "Konfirmasi Password" tidak sama.',
            'password.min'=> 'Kolom "Password" harus minimal 8 karakter.',
        ]);

        DB::transaction(function () use ($req, $id){
            $user = User::findOrFail($id);
            $user->password = Hash::make($req->password);
            $user->save();
        });

        return redirect()->route('kader.list_akun')->with('sukses', 'Berhasil mengubah password akun.');
    }

}
