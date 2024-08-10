<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\karyawan;
use App\Models\Pesanan;
use App\Models\RekapGaji;

class PemilikController extends Controller
{
    //
    public function dashboard(){
        return view('pemilik.dashboard');
    }

    public function dataKaryawan(){
        $data = Karyawan::paginate(5);
        return view('pemilik.data-karyawan', ['data' => $data]);
    }

    public function rekapPesanan(){
        $data = Pesanan::join('busana','pesanan.id_busana','=','busana.id')
                        ->select('pesanan.*','busana.jenis_busana')
                        ->paginate(5);
        return view('pemilik.rekap-pesanan', ['data' => $data]);
    }

    public function rekapGajian(){
        $data = RekapGaji::join('karyawan','rekap_gaji.id_karyawan_gaji','=','karyawan.id')
                        ->select('rekap_gaji.*','karyawan.nama_kry')
                        ->paginate(5);
        return view('pemilik.rekap-gajian', ['data' => $data]);
    }
    
    
    
}
