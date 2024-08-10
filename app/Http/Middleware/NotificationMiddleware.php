<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Rekap;


class NotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Menghitung jumlah rekap jahitan yang belum selesai
        $jumlah_baru = Rekap::where('status', 'baru')->count();
        $dataNotif = Rekap::join('detail_pesanan','rekap_jahitan.id_detail','=','detail_pesanan.id')
                            ->join('pesanan','detail_pesanan.id_pesanan','=','pesanan.id')
                            ->join('karyawan','rekap_jahitan.id_pengerja','=','karyawan.id')
                            ->join('busana','rekap_jahitan.id_busana','=','busana.id')
                            ->select('rekap_jahitan.*','karyawan.nama_kry AS karyawan','pesanan.nama_pemesan','detail_pesanan.nama_pcs',
                                     'busana.jenis_busana')
                            ->orderBy('rekap_jahitan.created_at', 'desc')
                            ->get();
    
        // Menyediakan variabel untuk semua view
        view()->share('jumlah_baru', $jumlah_baru);
        view()->share('dataNotif', $dataNotif);
    
        return $next($request);
    }
    
}
