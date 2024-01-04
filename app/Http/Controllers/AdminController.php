<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Posyandu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Webp;

class AdminController extends Controller
{

    /**
     * Menampilkan view dashboard admin
     * 
     * @return view
     */
    public function dashboard()
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

        $dataJumlahPosyandu = DB::table('posyandu')
                ->select(DB::raw('count(id_posyandu) as jumlah'))
                ->where('is_deleted', 0)
                ->get();
        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where('is_deleted', 0)
                ->get();

        $dataJumlahBalitaStuntingPerBulanIni = DB::table(DB::raw("
                    (SELECT id_balita, status_stunting
                    FROM pemeriksaan_balita
                    WHERE status_stunting IN ('severely stunted', 'stunted')
                    AND created_at BETWEEN CURRENT_DATE - INTERVAL 1 MONTH AND CURRENT_DATE)
                    AS filtered_data
                "))
                ->select(DB::raw('COUNT(DISTINCT id_balita) AS total_balita'))
                ->first();

        // dd($dataJumlahBalitaStuntingPerBulanIni);
        return view('admin.dashboard', compact(
            'dataPemeriksaanBalita', 

            'dataJumlahBalitaLaki', 
            'dataJumlahBalitaPerempuan', 
            
            'dataJumlahPosyandu',
            'dataJumlahBalita',
            'dataJumlahBalitaStuntingPerBulanIni'
        ));
    }


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
     * Menampilkan daftar data posyandu
     * 
     * @return void
     */
    public function list_posyandu() 
    {
        $data = DB::table('posyandu')
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-posyandu', compact(['data', 'empty']));
    }

     /**
      * Menampilkan view admin/tambah-posyandu
      * 
      * @return view admin/tambah-posyandu
      */
    public function tambah_posyandu() 
    {
        return view('admin.tambah-posyandu');
    }

     /**
      * Menyimpan data posyandu ke database
      * 
      * @param Request $req
      * @return redirect()
      */
    public function tambah_posyandu_act(Request $req) 
    {

        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu wajib diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat wajib diisi.',
        ]);

        DB::transaction(function () use ($req){
            $posyandu = new Posyandu();
            $posyandu->nama = $req->nama;
            $posyandu->jenis_posyandu = $req->jenis_posyandu;
            $posyandu->alamat = $req->alamat;
            $posyandu->save();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil menambahkan data posyandu.');
    }

    /**
      * Menampilkan view admin/update-posyandu
      * 
      * @param id_posyandu $id
      * @return view admin/update-posyandu
      */
    public function update_posyandu($id) 
    {
        $data = Posyandu::findOrFail($id);

        return view('admin.update-posyandu', compact('data'));
    }

    /**
      * Update data posyandu ke database
      * 
      * @param Request $req
      * @param id_posyandu $id
      * @return redirect to admin.list_posyandu
      */
    public function update_posyandu_act(Request $req, $id) 
    {
        $req->validate([
            'nama'=> 'required|max:255',
            'jenis_posyandu'=> [Rule::in(['balita', 'lansia']), 'required'],
            'alamat'=> 'required',

        ],
        [
            'nama.required'=> 'Kolom nama wajib diisi.',
            'nama.max'=> 'Jumlah karakter melebihi 255 karakter.',
            'jenis_posyandu.required'=> 'Kolom jenis posyandu wajib diisi.',
            'jenis_posyandu.in'=> $req->jenis_posyandu . ' tidak valid.',
            'alamat.required'=> 'Kolom alamat wajib diisi.',
        ]);

        DB::transaction(function () use ($req, $id){
            $posyandu = Posyandu::findOrFail($id);
            $posyandu->nama = $req->nama;
            $posyandu->jenis_posyandu = $req->jenis_posyandu;
            $posyandu->alamat = $req->alamat;
            $posyandu->update();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil mengubah data posyandu.');
    }

    /**
      * Menghapus data posyandu
      * 
      * @param id_posyandu $id
      * @return redirect()
      */
    public function delete_posyandu($id) 
    {
        DB::transaction(function () use ($id){
            $posyandu = Posyandu::findOrFail($id);
            $posyandu->is_deleted = 1;
            $posyandu->update();
        });

        return redirect()->route('admin.list_posyandu')->with('sukses', 'Berhasil menghapus data posyandu.');
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
            ->where('is_deleted', 0)
            ->get();
        
        $empty = count($data);

        return view('admin.list-balita', compact(['data', 'empty']));
    }


    /**
      * Menampilkan view admin/tambah-balita
      * 
      * @return view admin/tambah-balita
      */
    public function tambah_balita() 
    {
        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.tambah-balita', compact('posyandu'));
    }

    /**
      * Menyimpan data balita ke database
      * 
      * @return redirect to admin.list_balita
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
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
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
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
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
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
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
            $balita->id_posyandu = $req->posyandu;
            $balita->save();
        });

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil menambahkan data balita.');
    }

    /**
      * Menampilkan view admin/update-balita
      * 
      * @param id_balita $id
      * @return view admin/update-balita
      */
    public function update_balita($id) 
    {
        $data = Balita::findOrFail($id);

        $posyandu = DB::table('posyandu')
                    ->select('id_posyandu', 'nama')
                    ->where('is_deleted', 0)
                    ->get();

        return view('admin.update-balita', compact('data', 'posyandu'));
    }

    /**
      * Mengubah data balita
      * 
      * @param id_balita $id
      * @return redirect to admin.list_balita
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
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',
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
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
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
            $balita->id_posyandu = $req->posyandu;
            $balita->update();
        });

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil mengubah data balita.');
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

        return redirect()->route('admin.list_balita')->with('sukses', 'Berhasil menghapus data balita.');
    }

    /**
     * Menampilkan daftar data akun
     * 
     * @return view admin.list-akun
     */
    public function list_akun() 
    {
        $data = DB::table('users')
            ->join('posyandu', 'users.id_posyandu', 'posyandu.id_posyandu')
            ->where('users.is_delete', 0)
            ->select('users.id', 'users.name', 'users.no_telp', 'users.nik', 'users.role', 'users.alamat', 'posyandu.nama')
            ->get();
        
        $empty = count($data);

        return view('admin.list-akun', compact(['data', 'empty']));
    }

    /**
     * Menampilkan view tambah akun
     * 
     * @return view
     */
    public function tambah_akun() {
        $posyandu = DB::table('posyandu')
            ->select('id_posyandu', 'nama')
            ->where('is_deleted', 0)
            ->get();

        // dd($posyandu);
        return view('admin.tambah-akun', compact('posyandu'));
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
            'role'=> ['required', Rule::in(['1', '2', '3', '4'])],
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',

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
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
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
            $user->id_posyandu = $req->posyandu;
            $user->save();
        });

        return redirect()->route('admin.list_akun')->with('sukses', 'Berhasil menambahkan data akun '. $req->nama . '.');
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
                ])->firstOrFail();

        $posyandu = DB::table('posyandu')
                ->select('id_posyandu', 'nama')
                ->where('is_deleted', 0)
                ->get();

        return view('admin.update-akun', compact('data', 'posyandu'))->with('sukses', 'Berhasil menambahkan data akun.');
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
            'role'=> ['required', Rule::in(['1', '2', '3', '4'])],
            'posyandu'=> 'required|exists:App\Models\Posyandu,id_posyandu',

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
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
            'posyandu.exists'=> 'Posyandu tidak ada didalam database.',
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
            $user->id_posyandu = $req->posyandu;
            $user->update();
        });

        return redirect()->route('admin.list_akun')->with('sukses', 'Berhasil mengubah data akun '. $req->nama . '.');
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
            $user->update();
        });

        return redirect()->route('admin.list_akun')->with('sukses', 'Berhasil mengganti password baru.');
    }

    /**
     * Menampilkan daftar artikel
     * 
     * @return view
     */
    public function list_artikel() 
    {
        $data = DB::table('artikel')
                ->where([
                    ['is_deleted', 0]
                ])->get();

        $empty = count($data);

        return view('admin.list-artikel', compact('data', 'empty'));
    }

    /**
     * @return view
     */
    public function tambah_artikel() 
    {                
        return view('admin.tambah-artikel');
    }

    /**
     * Menyimpan artikel
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function tambah_artikel_act(Request $req)
    {
        $req->validate([
            'title'=> 'required|max:255',
            'image'=> 'required|image|mimes:png,jpg,jpeg|max:2500',
            'description'=> 'required',
        ]);

        // $img = $req->image;
        $img = $req->file('image');
        // dd($img);
        $img = Webp::make($req->file('image'));
        
        $name = $req->title . time().'.webp';
        $lokasi = public_path('image');
        
        $slug = $req->title . '-' . time();
        $slug = Str::kebab($slug);
        
        if($img->save($lokasi."/".$name)){
            DB::transaction(function () use ($req, $slug, $name){
                $artikel = new Artikel();
                $artikel->id_user = Auth::user()->id;
                $artikel->title = $req->title;
                $artikel->image = $name;
                $artikel->slug = $slug;
                $artikel->description = $req->description;
                $artikel->id_user = Auth::user()->id;

                if($artikel->save()){
                    return redirect()->route('admin.list_artikel')->with('sukses','Berhasil menulis artikel!');
                }
            });

            return redirect()->route('admin.list_artikel')->with('error','Gagal menyimpan artikel!');
        }
    }

    /**
     * Menampilkan halaman ubah artikel
     * 
     * @param id_artikel $id
     * 
     * @return view
     */
    public function update_artikel($id) 
    {
        $data = Artikel::where([
            ['is_deleted', 0]
        ])->findOrFail($id);

        return view('admin.update-artikel', compact('data'));
    }

    /**
     * Mengubah data artikel
     * 
     * @param Request $req
     * @param id_artikel $id
     * 
     * @return redirect
     */
    public function update_artikel_act(Request $req, $id)
    {
        $req->validate([
            'title'=> 'required|max:255',
            'image'=> 'image|mimes:png,jpg,jpeg|max:2500',
            'description'=> 'required',
        ]);

        if($req->image){
            $img = $req->image;
            $img = Webp::make($img);
            
            $name = Str::kebab($req->title) . time().'.webp';
            $lokasi = public_path('image');
            
            $slug = $req->title . '-' . time();
            $slug = Str::kebab($slug);
            
            if($img->save($lokasi."/".$name)){
                DB::transaction(function () use ($req, $id, $slug, $name){
                    $artikel = Artikel::findOrFail($id);
                    $artikel->title = $req->title;
                    $artikel->image = $name;
                    $artikel->slug = $slug;
                    $artikel->description = $req->description;
                    $artikel->id_user = Auth::user()->id;

                    if($artikel->save()){
                        return redirect()->route('admin.list_artikel')->with('sukses','Berhasil menulis artikel!');
                    }
                });

                return redirect()->route('admin.list_artikel')->with('error','Gagal menyimpan artikel!');
            }

        }else{

            $slug = $req->title . '-' . time();
            $slug = Str::kebab($slug);

            DB::transaction(function () use ($req, $id, $slug){
                $artikel = Artikel::findOrFail($id);
                $artikel->title = $req->title;
                $artikel->slug = $slug;
                $artikel->description = $req->description;
                $artikel->id_user = Auth::user()->id;

                if($artikel->save()){
                    return redirect()->route('admin.list_artikel')->with('sukses','Berhasil menulis artikel!');
                }
            });

            return redirect()->route('admin.list_artikel')->with('error','Gagal menyimpan artikel!');
        }
    }

    /**
     * menghapus artikel
     * 
     * @param id_artikel $id
     * 
     * @return redirect
     */
    public function delete_artikel($id)
    {
        DB::transaction(function () use ($id){
            $artikel = Artikel::findOrFail($id);
            $artikel->is_deleted = 1;
            $artikel->update();
        });

        return redirect()->route('admin.list_artikel')->with('sukses', 'Berhasil menghapus artikel.');
    }

    /**
     * Menampilkan daftar data pemeriksaan balita semua posyandu
     * 
     * @return void
     */
    public function list_pemeriksaan_balita() 
    {
        $balita = DB::table('balita')
            ->join('posyandu','balita.id_posyandu','posyandu.id_posyandu')
            ->select('balita.id_balita', 'balita.nama', 'balita.nama_ibu', 'posyandu.nama as nama_posyandu')
            ->where([
                ['balita.is_deleted', 0],
            ])->orderByDesc('balita.id_balita')
            ->get();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->join('posyandu','pemeriksaan_balita.id_posyandu','posyandu.id_posyandu')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama', 'posyandu.nama as nama_posyandu')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
            ])->orderByDesc('id_pemeriksaan_balita')
            ->get();
        
        $empty = count($data);

        // dd($data);

        return view('admin.pemeriksaan-balita.index', compact(['data', 'empty', 'balita']));
    }

    /**
     * Menampilkan detail data pemeriksaan balita berdasarkan id pemeriksaan balita.
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

        return view('admin.pemeriksaan-balita.detailpemeriksaan', compact('data', 'umur_bulan'));
    }

    /**
     * Menampilkan daftar galeri
     * 
     * @return view data, empty
     */
    public function list_galeri() 
    {
        $data = DB::table('galeri')
                ->where([
                    ['is_deleted', 0]
                ])->get();

        $empty = count($data);

        return view('admin.list-galeri', compact('data', 'empty'));
    }
}
