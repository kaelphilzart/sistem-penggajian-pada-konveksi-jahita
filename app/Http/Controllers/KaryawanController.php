<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Rekap;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    //
    public function dashboard(){
        return view('karyawan.dashboard');
    }

    public function ProfileKaryawan(){
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Mengambil data karyawan berdasarkan ID pengguna yang sedang login
        $data = Karyawan::where('id_user', $userId)->first();
        
        // Memeriksa apakah data karyawan ditemukan
        if(!$data) {
            // Jika tidak ditemukan, arahkan pengguna ke halaman isi profil
            return view ('karyawan.isi-profile');
        }
    
        // Jika ditemukan, tampilkan halaman profil karyawan
        return view('karyawan.profile', compact('data'));
    }
    

    public function TugasKaryawan()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Mengambil id_karyawan dari relasi Karyawan dengan User
        $karyawanId = Karyawan::where('id_user', $userId)->value('id');
    
        // Mengambil data tugas karyawan berdasarkan id_karyawan dengan status 'belum selesai' atau 'proses'
        $dataKaryawan = DetailPesanan::join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id')
                     ->join('busana', 'pesanan.id_busana', '=', 'busana.id')
                     ->join('karyawan', 'detail_pesanan.id_karyawan', '=', 'karyawan.id')
                     ->select('detail_pesanan.*', 'busana.jenis_busana AS nama_busana', 'karyawan.nama_kry')
                     ->where('detail_pesanan.id_karyawan', $karyawanId)
                     ->where(function($query) {
                        $query->where('detail_pesanan.status', 'belum selesai')
                              ->orWhere('detail_pesanan.status', 'proses')
                              ->orWhere('detail_pesanan.status', 'pengerjaan');
                    })
                    
                     ->get();
    
        // Jika tidak ada tugas karyawan, ambil tugas karyawan lain
        // if ($dataKaryawan->isEmpty()) {
        //     $data = DetailPesanan::join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id')
        //              ->join('busana', 'pesanan.id_busana', '=', 'busana.id')
        //              ->join('karyawan', 'detail_pesanan.id_karyawan', '=', 'karyawan.id')
        //              ->select('detail_pesanan.*', 'busana.jenis_busana AS nama_busana', 'karyawan.nama_kry')
        //              ->where('detail_pesanan.id_karyawan', '!=', $karyawanId)
        //              ->whereIn('detail_pesanan.status', ['belum selesai', 'proses', 'nunggu validasi', 'disetujui'])
        //              ->get();
        // } else {
            $data = $dataKaryawan;
        // }
    
        // Menghitung jumlah tugas dengan status 'belum selesai' atau 'proses' untuk karyawan yang sedang login
        $tugas = DetailPesanan::where('id_karyawan', $karyawanId)
                     ->where(function($query) {
                         $query->where('status', 'belum selesai')
                               ->orWhere('status', 'proses');
                     })
                     ->count();
    
        return view('karyawan.tugas-jahitan', compact('data', 'tugas', 'karyawanId'));
    }
    
    

    public function tugasSelesai($id){
        $data = DetailPesanan::find($id);
        $data->status = "proses";
        $data->update();

        $userId = Auth::id();
        
        // Mengambil id_karyawan dari relasi Karyawan dengan User
        $karyawanId = Karyawan::where('id_user', $userId)->value('id');

        $id_pesanan = $data->id_pesanan;

        // Menggunakan id_pesanan untuk mendapatkan id_busana
        $busana = Pesanan::where('id', $id_pesanan)->value('id_busana');

        Rekap::create([
            'id_detail' => $data->id,
            'id_pengerja' => $karyawanId,
            'id_busana' => $busana,
            'status' => "baru"
            // Anda mungkin perlu menambahkan kolom lainnya sesuai kebutuhan
        ]);
        return redirect('/dashboard_karyawan')->with('success', 'Tugas telah dikerjakan nunggu validasi dari admin');;
    }

    public function tugasAmbil($id){
        $data = DetailPesanan::find($id);
        $data->status = "nunggu validasi";
        $data->update();

        $userId = Auth::id();
        
        // Mengambil id_karyawan dari relasi Karyawan dengan User
        $karyawanId = Karyawan::where('id_user', $userId)->value('id');

        $id_pesanan = $data->id_pesanan;

        // Menggunakan id_pesanan untuk mendapatkan id_busana
        $busana = Pesanan::where('id', $id_pesanan)->value('id_busana');

        Rekap::create([
            'id_detail' => $data->id,
            'id_pengerja' => $karyawanId,
            'id_busana' => $busana,
            'status' => "ambil"
            // Anda mungkin perlu menambahkan kolom lainnya sesuai kebutuhan
        ]);
        return redirect('/dashboard_karyawan')->with('success', 'Tugas telah diambil nunggu validasi dari admin');;
    }

    public function tugasLepas($id){
        $data = DetailPesanan::find($id);
        $data->status = "lepas";
        $data->update();

     
        return redirect('/dashboard_karyawan')->with('success', 'Tugas telah diserahkan kepada admin');;
    }

    public function tugasProses($id){
        $data = DetailPesanan::find($id);
        $data->status = "pengerjaan";
        $data->update();

     
        return redirect('/dashboard_karyawan')->with('success', 'Tugas sedang diproses');;
    }


    public function rekapJahit(Request $request)
    {
        $userId = Auth::id();
    
        // Mengambil id_karyawan dari relasi Karyawan dengan User
        $karyawanId = Karyawan::where('id_user', $userId)->value('id');
    
        // Mendapatkan filter dari request, default ke minggu, bulan, dan tahun sekarang
        $week = $request->input('week', $this->getCurrentWeek());
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
    
        // Mengatur tanggal awal dan akhir minggu atau bulan yang dipilih
        $startOfWeek = null;
        $endOfWeek = null;
    
        switch ($week) {
            case 1:
                $startOfWeek = Carbon::createFromDate($year, $month, 1)->startOfDay();
                $endOfWeek = Carbon::createFromDate($year, $month, 7)->endOfDay();
                break;
            case 2:
                $startOfWeek = Carbon::createFromDate($year, $month, 8)->startOfDay();
                $endOfWeek = Carbon::createFromDate($year, $month, 14)->endOfDay();
                break;
            case 3:
                $startOfWeek = Carbon::createFromDate($year, $month, 15)->startOfDay();
                $endOfWeek = Carbon::createFromDate($year, $month, 21)->endOfDay();
                break;
            case 4:
                $startOfWeek = Carbon::createFromDate($year, $month, 22)->startOfDay();
                $endOfWeek = Carbon::createFromDate($year, $month, Carbon::createFromDate($year, $month)->endOfMonth()->day)->endOfDay();
                break;
        }
    
        $query = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
            ->join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id')
            ->join('busana as busana1', 'pesanan.id_busana', '=', 'busana1.id')
            ->join('karyawan as karyawan_tugas', 'detail_pesanan.id_karyawan', '=', 'karyawan_tugas.id')
            ->join('karyawan as karyawan_pengerja', 'rekap_jahitan.id_pengerja', '=', 'karyawan_pengerja.id')
            ->select('rekap_jahitan.*', 'busana1.jenis_busana', 'karyawan_tugas.nama_kry as nama_tugas', 
                     'busana1.upahPcs AS upah', 'karyawan_pengerja.nama_kry as nama_pengerja', 'detail_pesanan.nama_pcs')
            ->where('rekap_jahitan.id_pengerja', $karyawanId)
            ->where('rekap_jahitan.status', 'dikonfirmasi') // Tambahkan kondisi ini
            ->whereBetween('rekap_jahitan.created_at', [$startOfWeek, $endOfWeek]);
    
        $data = $query->paginate(10);
    
        // Menghitung jumlah jahitan
        $data1 = $query->count();
    
        // Menghitung total upah dengan filter yang sama
        $data2 = $query->sum('busana1.upahPcs');
    
        return view('karyawan.rekap-jahit', [
            'data' => $data, 
            'data1' => $data1, 
            'data2' => $data2, 
            'selectedWeek' => $week, 
            'selectedMonth' => $month, 
            'selectedYear' => $year
        ]);
    }
    
    
    private function getCurrentWeek()
    {
        $day = date('j');
        if ($day <= 7) {
            return 1;
        } elseif ($day <= 14) {
            return 2;
        } elseif ($day <= 21) {
            return 3;
        } else {
            return 4;
        }
    }
    

    public function isiProfile(Request $request){

        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
        ];

        $attributes = request()->validate([
            'nama_kry' => 'required',
            'alamat_kry' => 'required',
            'no_tlp' => 'required',
        ], $message);
        
        $userId = Auth::id();

        $data = new Karyawan;
        $data->id_user = $userId;
        $data->nama_kry = $request->nama_kry;
        $data->alamat_kry = $request->alamat_kry;
        $data->no_tlp = '+62' . ltrim($request->no_tlp, '62');
        $data->save();
        return redirect('dashboard_karyawan')->with('success', 'Profile berhasil dibuat');
    }
}
