<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class NormalUserController extends Controller
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
     * Menampilkan view dashboard user
     * 
     * @return view
     */
    public function dashboard()
    {
        $user = Auth::user();

        $dataJumlahBalita = DB::table('balita')
                ->select(DB::raw('count(id_balita) as jumlah'))
                ->where([
                    ['is_deleted', 0],
                    ['created_at', '>', Carbon::now()->subYear()],
                    ['nik', $user->nik],
                ])->get();

        $dataBalita = DB::table('pemeriksaan_balita')
                ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
                ->select("pemeriksaan_balita.*")
                ->where([
                    ['pemeriksaan_balita.is_deleted', 0],
                    ['pemeriksaan_balita.created_at', '>', Carbon::now()->subYear()],
                    ['balita.nik', $user->nik],
                ])->get();
        
        return view('normal_user.dashboard', compact(
            'dataJumlahBalita', 
            'dataBalita',
        ));
    }

    /**
     * menampilkan balita di keluarga berdasarkan no kk
     * 
     * @return view
     */
    public function list_balita() 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita', 'pemeriksaan_balita.id_balita', 'balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.id_balita', 'balita.nik', 'balita.no_kk', 'balita.nama', 'balita.jenis_kelamin')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['balita.is_deleted', 0],
                ['balita.nik_ibu', $user->nik],
            ])->orderByDesc('pemeriksaan_balita.id_pemeriksaan_balita')
            ->get();
        // dd($data);
        $empty = count($data);

        return view('normal_user.balita.index', compact(['data', 'empty']));
    }

    /**
     * menampilkan riwayat pemeriksaan balita berdasarkan no kk
     * 
     * @var id_balita $id
     * 
     * @return view
     */
    public function riwayat_balita($id) 
    {
        $user = Auth::user();

        $data = DB::table('pemeriksaan_balita')
            ->join('balita','pemeriksaan_balita.id_balita','balita.id_balita')
            ->select('pemeriksaan_balita.*', 'balita.nik', 'balita.nama')
            ->where([
                ['pemeriksaan_balita.is_deleted', 0],
                ['pemeriksaan_balita.id_balita', $id],
                ['balita.is_deleted', 0],
                ['balita.nik', $user->nik],
            ])->orderByDesc('id_pemeriksaan_balita')
            ->get();
        // dd($data);
        $empty = count($data);

        return view('normal_user.balita.riwayat_pemeriksaan', compact(['data', 'empty']));
    }
      
    /**
     * Menampilkan view update data akun
     * 
     * @return view
     */
    public function update_akun()
    {
        $data = User::where([
                    ['is_delete', 0],
                    ['id', Auth::user()->id],
                ])->firstOrFail();

        return view('normal_user.update-akun', compact('data'))->with('sukses', 'Berhasil menambahkan data akun.');
    }

    /**
     * mengubah data akun
     * 
     * @param Request $req
     * @param user_id $id
     * 
     * @return [type]
     */
    public function update_akun_act(Request $req)
    {
        $req->validate([
            'nama'=> 'required',
            // 'nik'=> 'required|digits:16|numeric',
            // 'no_kk'=> 'required|digits:16|numeric',
            'no_telp'=> 'numeric',
            'jenis_kelamin'=> [Rule::in(['Laki-laki', 'Perempuan'])],

        ],
        [
            'nama.required'=> 'Kolom "Nama" wajib diisi.',
            // 'nik.required'=> 'Kolom "NIK" wajib diisi.',
            // 'nik.digits'=> 'Jumlah digit "NIK" tidak valid.',
            // 'nik.numeric'=> 'Kolom "NIK" tidak bisa diisikan selain angka.',
            // 'no_kk.required'=> 'Kolom "No Kartu Keluarga" wajib diisi.',
            // 'no_kk.digits'=> 'Jumlah digit "No Kartu Keluarga" tidak valid.',
            // 'no_kk.numeric'=> 'Kolom "No Kartu Keluarga" tidak bisa diisikan selain angka.',
            'no_telp.numeric'=> 'Jumlah digit "No telepon" tidak valid.',
            'jenis_kelamin.required'=> 'Kolom "jenis kelamin" wajib diisi.',
            'jenis_kelamin.in'=> $req->jenis_posyandu . ' tidak valid.',
        ]);

        DB::transaction(function () use ($req){
            $user = User::findOrFail(Auth::user()->id);
            $user->name = $req->nama;
            $user->no_telp = $req->no_telepon;
            $user->alamat = $req->alamat;
            $user->jenis_kelamin = $req->jenis_kelamin;
            $user->update();
        });

        return redirect()->route('user.update_akun')->with('sukses', 'Berhasil mengubah data akun '. $req->nama . '.');
    }

    /**
     * Mengubah password akun pengguna
     * 
     * @param Request $req
     * 
     * @return redirect
     */
    public function update_password_act(Request $req)
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

        DB::transaction(function () use ($req){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($req->password);
            $user->update();
        });

        return redirect()->route('user.update_akun')->with('sukses', 'Berhasil mengganti password baru.');
    }

    /**
     * Menampilkan detail data pemeriksaan balita berdasarkan id pemeriksaan balita.
     * 
     * @param integer id_balita
     * @return void $data
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

        return view('normal_user.balita.detailpemeriksaan', compact('data', 'umur_bulan'));
    }
}
