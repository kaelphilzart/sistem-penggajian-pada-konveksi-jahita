<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('login', [SessionController::class, 'login'])-> name('login');
Route::get('/register', [SessionController::class, 'register'])-> name('register');
Route::post('buat-akun', [SessionController::class, 'createUser'])-> name('buat-akun');
Route::post('login-akun', [SessionController::class, 'login_akun'])->name('login-akun');

Route::middleware(['auth'])->group(function () {
    // Rute untuk pengguna dengan tingkat 'admin'


    Route::middleware(['pemilik'])->group(function () {

        Route::get('dashboard_pemilik', [PemilikController::class, 'dashboard'])-> name('dashboard_pemilik');
        Route::get('logout-pemilik', [SessionController::class, 'destroyPemilik'])->name('logout-pemilik');
        Route::get('data-karyawan-pemilik', [PemilikController::class, 'dataKaryawan'])-> name('data-karyawan-pemilik');
        Route::get('rekap-pesanan', [PemilikController::class, 'rekapPesanan'])-> name('rekap-pesanan-pemilik');
        Route::get('rekap-gajian', [PemilikController::class, 'rekapGajian'])-> name('rekap-gajian');
  
    });

    Route::middleware(['admin'])->group(function () {
       
        Route::get('dashboard_admin', [AdminController::class, 'dashboard'])-> name('dashboard_admin');
        Route::get('logout-admin', [SessionController::class, 'destroyAdmin'])->name('logout-admin');

//karyawan
        Route::get('data-karyawan', [AdminController::class, 'dataKaryawan'])-> name('data-karyawan');
        Route::post('tambah-karyawan', [AdminController::class, 'tambahKaryawan']) -> name('tambah-karyawan');
        Route::post('/karyawan/update/{id}', [AdminController::class, 'updateKaryawan']) -> name('update-karyawan');
        Route::post('/karyawan/delete/{id}', [AdminController::class, 'deleteKaryawan']) -> name('delete-karyawan');
      
//busana
        Route::get('data-busana', [AdminController::class, 'dataBusana'])-> name('data-busana');
        Route::post('tambah-busana', [AdminController::class, 'tambahBusana']) -> name('tambah-busana');
        Route::post('/busana/update/{id}', [AdminController::class, 'updateBusana']) -> name('update-busana');
        Route::post('/busana/delete/{id}', [AdminController::class, 'deleteBusana']) -> name('delete-busana');
    
//pesanan
        Route::get('data-pesanan', [AdminController::class, 'dataPesanan'])-> name('data-pesanan');
        Route::post('tambah-pesanan', [AdminController::class, 'tambahPesanan']) -> name('tambah-pesanan');
        Route::post('/pesanan/update/{id}', [AdminController::class, 'updatePesanan']) -> name('update-pesanan');
        Route::post('/pesanan/delete/{id}', [AdminController::class, 'deletePesanan']) -> name('delete-pesanan');
        Route::post('/serah/pesanan/{id}', [AdminController::class, 'serahPesanan']) -> name('serah-pesanan');
        
// Detail pesanan    
        Route::get('/pesanan/detail/{id}', [AdminController::class, 'detailPesanan']) -> name('detail-pesanan');
        Route::post('tambah-detail', [AdminController::class, 'tambahDetailPesanan']) -> name('tambah-detail');
        Route::post('/detail/update/{id}', [AdminController::class, 'updateDetailPesanan']) -> name('update-detail');
        Route::post('/detail/delete/{id}', [AdminController::class, 'deleteDetail']) -> name('delete-detail');
        Route::get('/cetak-detail/{id}', [AdminController::class, 'cetakDetail'])->name('cetak-detail');
        Route::post('bagi-tugas-lepas', [AdminController::class, 'bagiTugasLepas'])-> name('bagi-tugas-lepas');


        
//rekap
        Route::get('data-rekap', [AdminController::class, 'dataRekap'])-> name('data-rekap');
        Route::get('/rekap/detail/{id}', [AdminController::class, 'rekapDetail']) -> name('detail-rekap');
        Route::get('data-gaji', [AdminController::class, 'dataGaji'])-> name('data-gaji');

     

// beri gaji
        // Route::post('sendMessage', [AdminController::class, 'sendMessage'])->name('sendMessage');
        Route::post('/send-whatsapp', [AdminController::class, 'sendMessage'])->name('send-whatsapp');
        Route::get('rekap-gaji', [AdminController::class, 'rekapGaji'])-> name('rekap-gaji');


        Route::post('/konfirmasi-jahitan/{id}', [AdminController::class, 'konfirmasiJahitan'])->name('konfirmasi-jahitan');
        Route::post('/abaikan-jahitan/{id}', [AdminController::class, 'abaikanJahitan'])->name('abaikan-jahitan');
        Route::get('/fetch-notifications', [AdminController::class, 'fetchNotifications']);

        Route::post('/disetujui/{id}', [AdminController::class, 'disetujui'])->name('disetujui');
        Route::post('/ditolak/{id}', [AdminController::class, 'ditolak'])->name('ditolak');

      


    });

    Route::middleware(['karyawan'])->group(function () {
    
        Route::get('dashboard_karyawan', [KaryawanController::class, 'dashboard'])-> name('dashboard_karyawan');
        Route::get('logout-karyawan', [SessionController::class, 'destroyKaryawan'])->name('logout-karyawan');

        Route::get('profile', [KaryawanController::class, 'ProfileKaryawan'])-> name('profile');
        Route::get('tugas-jahitan', [KaryawanController::class, 'TugasKaryawan'])-> name('tugas-jahitan');
        Route::post('tugas/selesai/{id}', [KaryawanController::class, 'tugasSelesai'])-> name('tugas-selesai');
        Route::get('rekap-jahit', [KaryawanController::class, 'rekapJahit'])-> name('rekap-jahit');
        Route::post('isi-profile', [KaryawanController::class, 'isiProfile'])-> name('isi-profile');
        Route::post('tugas/ambil/{id}', [KaryawanController::class, 'tugasAmbil'])-> name('tugas-ambil');
        Route::post('tugas/lepas/{id}', [KaryawanController::class, 'tugasLepas'])-> name('tugas-lepas');
        Route::post('tugas/proses/{id}', [KaryawanController::class, 'tugasProses'])-> name('tugas-proses');

      
      
    });
    
});