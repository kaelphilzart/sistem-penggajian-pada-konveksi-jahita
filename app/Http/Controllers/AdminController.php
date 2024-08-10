<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Busana;
use App\Models\Pesanan;
use App\Models\RekapGaji;
use App\Models\Rekap;
use App\Models\DetailPesanan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Api;
use Twilio\Rest\Client;
use Carbon\Carbon;
use PDF; 

class AdminController extends Controller
{
    //

// notif
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function fetchNotifications()
    {
        $jumlah_baru = Rekap::whereIn('status', ['baru', 'ambil'])->count();
        $dataNotif = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
                            ->join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id')
                            ->join('karyawan', 'rekap_jahitan.id_pengerja', '=', 'karyawan.id')
                            ->join('detail_pesanan as tugas_detail', 'rekap_jahitan.id_detail', '=', 'tugas_detail.id')
                            ->join('karyawan as tugas_karyawan', 'tugas_detail.id_karyawan', '=', 'tugas_karyawan.id')
                            ->join('busana', 'rekap_jahitan.id_busana', '=', 'busana.id')
                            ->select('rekap_jahitan.*', 'karyawan.nama_kry AS karyawan', 'pesanan.nama_pemesan', 'detail_pesanan.nama_pcs',
                                     'busana.jenis_busana', 'tugas_karyawan.nama_kry as karyawan_tugas', 'pesanan.tgl_pengambilan')
                            ->orderBy('rekap_jahitan.created_at', 'desc')
                            ->get();

        $today = Carbon::now();
        $dueDate = $today->copy()->addDays(2);
        $pesananDueSoon = \DB::table('pesanan')
                             ->whereBetween('tgl_pengambilan', [$today->format('Y-m-d'), $dueDate->format('Y-m-d')])
                             ->select('pesanan.*')
                             ->orderBy('tgl_pengambilan', 'desc')
                             ->get();

        $allNotifications = collect($dataNotif)->merge($pesananDueSoon)->sortByDesc('created_at');

        return response()->json([
            'count' => $jumlah_baru,
            'notifications' => $allNotifications->values()->all()
        ]);
    }



        public function konfirmasiJahitan(Request $request, $id)
        {
            // Mengambil data rekap jahitan berdasarkan id
            $data = Rekap::find($id);
            if ($data) {
                $data->status = "dikonfirmasi";
                $data->update();

                // Mengambil id detail pesanan dari rekap jahitan
                $detail_id = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
                    ->where('rekap_jahitan.id', $id)
                    ->select('detail_pesanan.id')
                    ->first();

                if ($detail_id) {
                    // Mengambil data detail pesanan berdasarkan id
                    $data1 = DetailPesanan::find($detail_id->id);
                    if ($data1) {
                        $data1->status = "selesai";
                        $data1->update();
                    }
                }

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        }

        public function abaikanJahitan(Request $request, $id)
        {
            // Mengambil data rekap jahitan berdasarkan id
            $data = Rekap::find($id);
            if ($data) {
                $data->status = "diabaikan";
                $data->update();

                // Mengambil id detail pesanan dari rekap jahitan
                $detail_id = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
                    ->where('rekap_jahitan.id', $id)
                    ->select('detail_pesanan.id')
                    ->first();

                if ($detail_id) {
                    // Mengambil data detail pesanan berdasarkan id
                    $data1 = DetailPesanan::find($detail_id->id);
                    if ($data1) {
                        $data1->status = "selesai";
                        $data1->update();
                    }
                }

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        }

        public function disetujui(Request $request, $id)
        {
            // Mengambil data rekap jahitan berdasarkan id
            $data = Rekap::find($id);
            if ($data) {
                $data->status = "disetujui";
                $data->update();

                // Mengambil id detail pesanan dari rekap jahitan
                $detail_id = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
                    ->where('rekap_jahitan.id', $id)
                    ->select('detail_pesanan.id')
                    ->first();

                if ($detail_id) {
                    // Mengambil data detail pesanan berdasarkan id
                    $data1 = DetailPesanan::find($detail_id->id);
                    if ($data1) {
                        $data1->status = "disetujui";
                        $data1->update();
                    }
                }

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        }

        public function ditolak(Request $request, $id)
        {
            // Mengambil data rekap jahitan berdasarkan id
            $data = Rekap::find($id);
            if ($data) {
                $data->status = "dtolak";
                $data->update();

                // Mengambil id detail pesanan dari rekap jahitan
                $detail_id = Rekap::join('detail_pesanan', 'rekap_jahitan.id_detail', '=', 'detail_pesanan.id')
                    ->where('rekap_jahitan.id', $id)
                    ->select('detail_pesanan.id')
                    ->first();

                if ($detail_id) {
                    // Mengambil data detail pesanan berdasarkan id
                    $data1 = DetailPesanan::find($detail_id->id);
                    if ($data1) {
                        $data1->status = "ditolak";
                        $data1->update();
                    }
                }

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false]);
        }


//karyawan
    public function dataKaryawan(){
        $data = Karyawan::paginate(5);
        $data1 = User::where('level', 'karyawan')
                 ->whereDoesntHave('karyawan')
                 ->get(); 
        return view('admin.data-karyawan', ['data' => $data, 'data1' => $data1]);
    }
    
    public function tambahKaryawan(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
        ];

        $attributes = request()->validate([
            'id_user' => 'required|unique:karyawan',
            'nama_kry'=> 'required',
            'alamat_kry' => 'required',
            'no_tlp' => 'required',
        ], $message);
        
        $data = new Karyawan;
        $data->id_user = $request->id_user;
        $data->nama_kry = $request->nama_kry;
        $data->alamat_kry = $request->alamat_kry;
        $data->no_tlp = $request->no_tlp;
        $data->save($attributes);
        return redirect('/data-karyawan')->with('success', 'karyawab berhasil disimpan');
    }

    public function updateKaryawan(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'nama_kry' => 'required',
            'alamat_kry' => 'required',
            'no_tlp' => 'required',
        ], $message);

        $data = Karyawan::find($id);
        $data->nama_kry = $request->nama_kry;
        $data->alamat_kry = $request->alamat_kry;
        $data->no_tlp = $request->no_tlp;
        $data->update();
        return redirect('/data-karyawan')->with('success', 'Pengguna berhasil diubah');;
    }
 
    public function deleteKaryawan($id){
        $data = Karyawan::find($id);
        $data->delete();
        return redirect('/data-karyawan')->with('success', 'Data berhasil dihapus');;
    }

//buasana
    public function dataBusana(){
        $data = Busana::orderBy('created_at', 'desc')
                        ->paginate(5);

        return view('admin.busana', ['data' => $data]);
    }

    public function tambahBusana(Request $request)
    {
        // Validasi form
        $request->validate([
            'jenis_busana' => ['required', 'max:50', Rule::unique('Busana', 'jenis_busana')],
            'upahPcs' => 'required',
        ], [
            'jenis_busana.required' => 'Jenis Busana tidak boleh kosong',
            'jenis_busana.max' => 'Jenis Busana tidak boleh lebih dari 50 karakter',
            'jenis_busana.unique' => 'Jenis Busana sudah ada',
            'upahPcs.required' => 'Upah PerPCS tidak boleh kosong',
        ]);
    
        $data = new Busana;
        $data->jenis_busana = $request->jenis_busana;
        $data->upahPcs = $request->upahPcs;
        $data->save();
    
        return redirect('/data-busana')->with('success', 'Data berhasil disimpan');
    }

    public function updateBusana(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'jenis_busana' => 'required',
            'upahPcs' => 'required',
        ], $message);

        $data = Busana::find($id);
        $data->jenis_busana = $request->jenis_busana;
        $data->upahPcs = $request->upahPcs;
        $data->update();
        return redirect('/data-busana')->with('success', 'Pengguna berhasil diubah');;
    }
 
    public function deleteBusana($id){
        $data = Busana::find($id);
        $data->delete();
        return redirect('/data-busana')->with('success', 'Data berhasil dihapus');;
    }

// pesanan
    public function dataPesanan(){
        $data = Pesanan::join('busana', 'pesanan.id_busana', '=', 'busana.id')
                        ->select('pesanan.*', 'busana.jenis_busana','busana.upahPcs')
                        ->orderBy('pesanan.created_at', 'desc')
                        ->paginate(5);

        $data1 = Busana::all();
        // $data2 = Karyawan::all();

        return view('admin.data-pesanan', ['data' => $data,
                                            'data1'=> $data1,]);
    }

    public function tambahPesanan(Request $request){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
        ];

        $attributes = request()->validate([
            'nama_pemesan' => 'required',
            'id_busana' => 'required',
            'jumlah' => 'required',
            'tgl_pengambilan' => 'required',
        ], $message);
        
        $data = new Pesanan;
        $data->nama_pemesan = $request->nama_pemesan;
        $data->id_busana = $request->id_busana;
        $data->jumlah = $request->jumlah;
        $data->tgl_pengambilan = $request->tgl_pengambilan;
        $data->save($attributes);
        return redirect('/data-pesanan')->with('success', 'Pesanan berhasil disimpan');
    }

    public function updatePesanan(Request $request, $id){
        //validasi form
        $message= [
            'required' =>':attribute tidak boleh kosong',
            'unique' => 'attribute sudah digunakan',
            'numeric' => 'attribute harus berupa angka',
        ];

        $this->validate($request, [
            'nama_pemesan' => 'required',
            'id_busana' => 'required',
            'jumlah' => 'required',
            'tgl_pengambilan' => 'required',
        ], $message);

        $data = Pesanan::find($id);
        $data->nama_pemesan = $request->nama_pemesan;
        $data->id_busana = $request->id_busana;
        $data->jumlah = $request->jumlah;
        $data->tgl_pengambilan = $request->tgl_pengambilan;
        $data->update();
        return redirect('/data-pesanan')->with('success', 'Pesanan berhasil diubah');;
    }
 
    public function deletePesanan($id){
        $data = Pesanan::find($id);
        $data->delete();
        return redirect('/data-pesanan')->with('success', 'Pesanan berhasil diserahkan');;
    }

    public function serahPesanan(Request $request, $id) {
        $data = Pesanan::find($id);
    
        // Mendapatkan tanggal pengambilan dari request
        $tgl_pengambilan = $request->input('tgl_pengambilan');
    
        // Mendapatkan tanggal hari ini
        $today = date('Y-m-d');
    
        // Memperbarui status berdasarkan perbandingan tanggal
        if ($today > $tgl_pengambilan) {
            $data->status = 'terlambat';
        } else {
            $data->status = 'tepat waktu';
        }
    
        $data->update();
    
        return redirect('/data-pesanan')->with('success', 'Pesanan berhasil diubah');
    }

//Detail pesanan
            public function detailPesanan($id)
        {
            // Mengambil data pesanan berdasarkan ID
            $dataPesanan = Pesanan::join('busana', 'pesanan.id_busana', '=', 'busana.id')
                    ->select('pesanan.*', 'busana.jenis_busana')
                    ->find($id);
            
            // Mengambil detail pesanan berdasarkan ID pesanan
            $data = DetailPesanan::join('karyawan','detail_pesanan.id_karyawan', '=' ,'karyawan.id')
                                  ->select('detail_pesanan.*', 'karyawan.nama_kry')
                                  ->orderBy('detail_pesanan.created_at', 'desc')
                                  ->where('id_pesanan', $id)->get();
            $data1 = Karyawan::all();

            $data2 = DetailPesanan::where('id_pesanan', $id)
                                    ->where('status', 'lepas')
                                    ->join('karyawan', 'detail_pesanan.id_karyawan', '=', 'karyawan.id')
                                    ->select('detail_pesanan.*', 'karyawan.nama_kry')
                                    ->get();
            
            $data3 = Karyawan::leftJoin('detail_pesanan', function($join) {
                                $join->on('karyawan.id', '=', 'detail_pesanan.id_karyawan')
                                    ->where('detail_pesanan.status', 'belum selesai');
                            })
                            ->whereNull('detail_pesanan.id_karyawan')
                            ->select('karyawan.*')
                            ->get();

            
            return view('admin.detail-pesanan', compact('dataPesanan', 'data','data1','data2','data3'));
        }

    
        public function tambahDetailPesanan(Request $request){
            // Validasi form
            $message = [
                'required' => ':attribute tidak boleh kosong',
                'unique' => ':attribute sudah digunakan',
                'numeric' => ':attribute harus berupa angka',
            ];
        
            $this->validate($request, [
                'nama_pcs' => 'required',
                'id_pesanan' => 'required',
                'panjang_lengan' => 'required',
                'lingkar_dada' => 'required',
                'lingkar_pinggang' => 'required',
                'panjang_baju' => 'required',
                'lingkar_lengan' => 'required',
                'id_karyawan' => 'required'
            ], $message);
        
            $pesanan_id = $request->id_pesanan;
        
            // Menghitung total detail pesanan yang sudah ada
            $totalDetailPesanan = DetailPesanan::where('id_pesanan', $pesanan_id)->count();
        
            // Mendapatkan jumlah pesanan dari tabel pesanan
            $pesanan = Pesanan::find($pesanan_id);
        
            if ($pesanan) {
                if ($totalDetailPesanan >= $pesanan->jumlah) {
                    return redirect()->route('detail-pesanan', [
                        'id' => $pesanan_id,
                    ])->with('error', 'Jumlah detail pesanan sudah mencapai jumlah pesanan.');
                } else {
                    $data = new DetailPesanan;
                    $data->id_pesanan = $request->id_pesanan;
                    $data->nama_pcs = $request->nama_pcs;           
                    $data->panjang_lengan = $request->panjang_lengan;
                    $data->lingkar_dada = $request->lingkar_dada;
                    $data->lingkar_pinggang = $request->lingkar_pinggang;
                    $data->panjang_baju = $request->panjang_baju;
                    $data->lingkar_lengan = $request->lingkar_lengan;
                    $data->id_karyawan = $request->id_karyawan;
                    $data->save();
        
                    // Redirect ke halaman detail pesanan dengan parameter id_pesanan
                    return redirect()->route('detail-pesanan', [
                        'id' => $pesanan_id,
                    ])->with('success', 'Pembagian berhasil dilakukan');
                }
            } else {
                return redirect()->route('detail-pesanan', [
                    'id' => $pesanan_id,
                ])->with('error', 'Pesanan tidak ditemukan.');
            }
        }

        public function updateDetailPesanan(Request $request, $id){
            //validasi form
            $message= [
                'required' =>':attribute tidak boleh kosong',
                'unique' => 'attribute sudah digunakan',
                'numeric' => 'attribute harus berupa angka',
            ];
    
            $this->validate($request, [
                'nama_pcs' => 'required',
                'panjang_lengan' => 'required',
                'lingkar_dada' => 'required',
                'lingkar_pinggang' => 'required',
                'panjang_baju' => 'required',
                'lingkar_lengan' => 'required',
                'id_karyawan' => 'required'
            ], $message);
    
            $data = DetailPesanan::find($id);
            $data->nama_pcs = $request->nama_pcs;           
            $data->panjang_lengan = $request->panjang_lengan;
            $data->lingkar_dada = $request->lingkar_dada;
            $data->lingkar_pinggang = $request->lingkar_pinggang;
            $data->panjang_baju = $request->panjang_baju;
            $data->lingkar_lengan = $request->lingkar_lengan;
            $data->id_karyawan = $request->id_karyawan;
            $data->update();
            return redirect()->route('detail-pesanan', [
                'id' => $request->id_pesanan,
            ])->with('success', 'Update pembagian berhasil dilakukan');
        }

        public function deleteDetail($id){
            $data = DetailPesanan::find($id);
            $data->delete();
            return redirect()->route('detail-pesanan', [
                'id' => $request->id_pesanan,
            ])->with('success', 'Pembagian berhasil dihapus');
        }

        public function cetakDetail($id)
        {
            $dataDetail = DetailPesanan::find($id);
            $pdf = PDF::loadView('admin.cetak-detail', compact('dataDetail'));
            
            return $pdf->stream('detail-' . $dataDetail->nama_pcs . '.pdf');
        }

        public function bagiTugasLepas(Request $request)
        {
            $id_detail = $request->id_detail;
        
            $data = DetailPesanan::find($id_detail);
            $data->id_karyawan = $request->id_karyawan;
            $data->status = "belum selesai";
            $data->update();
        
            return redirect()->route('detail-pesanan', [
                'id' => $request->id_pesanan,
            ])->with('success', 'Tugas telah diberikan');
        }
        

// rekap

        public function dataRekap(){
            $data = Pesanan::join('busana', 'pesanan.id_busana', '=', 'busana.id')
                           ->select('pesanan.*', 'busana.jenis_busana', 
                            DB::raw('(SELECT COUNT(*) FROM detail_pesanan WHERE id_pesanan = pesanan.id AND status = "selesai") as jumlah_selesai'))
                           ->paginate(5);
        
            return view('admin.data-rekap', ['data' => $data]);
        }
        
        public function rekapDetail($id)
        {
            // Mengambil data pesanan berdasarkan ID
            $dataPesanan = Pesanan::join('busana', 'pesanan.id_busana', '=', 'busana.id')
                ->select('pesanan.*', 'busana.jenis_busana')
                ->find($id);
        
            // Mengambil data rekap berdasarkan ID pesanan dan kondisi status 'dikonfirmasi'
            $data = Pesanan::join('detail_pesanan', 'pesanan.id', '=', 'detail_pesanan.id_pesanan')
                ->join('rekap_jahitan', 'detail_pesanan.id', '=', 'rekap_jahitan.id_detail')
                ->join('karyawan as karyawan_pengerja', 'rekap_jahitan.id_pengerja', '=', 'karyawan_pengerja.id')
                ->join('karyawan as karyawan_tugas', 'detail_pesanan.id_karyawan', '=', 'karyawan_tugas.id')
                ->select('pesanan.*', 'detail_pesanan.nama_pcs', 'detail_pesanan.id_karyawan', 
                         'karyawan_tugas.nama_kry as karyawan_tugas', 'karyawan_pengerja.nama_kry as karyawan_pengerja',
                         'rekap_jahitan.id_pengerja', 'rekap_jahitan.created_at AS tgl_selesai')
                ->where('pesanan.id', $id)
                ->where('rekap_jahitan.status', 'dikonfirmasi') // Kondisi tambahan untuk status 'dikonfirmasi'
                ->orderBy('rekap_jahitan.created_at', 'desc')
                ->paginate(5);
        
            return view('admin.rekap-detail', compact('data', 'dataPesanan'));
        }
        
        public function dataGaji(Request $request)
        {
            // Mendapatkan detail tanggal saat ini
            $currentDate = Carbon::now();
            $currentWeek = ceil($currentDate->weekOfMonth);
            $currentMonth = $currentDate->month;
            $currentYear = $currentDate->year;
        
            // Mendapatkan filter yang dipilih atau nilai default
            $selectedWeek = $request->input('week', $currentWeek);
            $selectedMonth = $request->input('month', $currentMonth);
            $selectedYear = $request->input('year', $currentYear);
        
            // Query data dengan filter minggu, bulan, tahun, dan status 'dikonfirmasi'
            $query = DB::table('rekap_jahitan')
                ->join('karyawan', 'rekap_jahitan.id_pengerja', '=', 'karyawan.id')
                ->join('busana', 'rekap_jahitan.id_busana', '=', 'busana.id')
                ->select(
                    'karyawan.nama_kry',
                    'karyawan.no_tlp',
                    'rekap_jahitan.id_pengerja',
                    DB::raw('MAX(rekap_jahitan.id) as id'),
                    DB::raw('SUM(busana.upahPcs) as total_gaji'),
                    DB::raw('COUNT(rekap_jahitan.id) as total_jahit'),
                    DB::raw('FLOOR((DAY(rekap_jahitan.created_at)-1)/7)+1 as minggu_ke')
                )
                ->where('rekap_jahitan.status', 'dikonfirmasi') // Kondisi tambahan untuk status 'dikonfirmasi'
                ->groupBy('rekap_jahitan.id_pengerja', 'karyawan.nama_kry', 'karyawan.no_tlp', 'minggu_ke')
                ->having('minggu_ke', '=', $selectedWeek)
                ->whereMonth('rekap_jahitan.created_at', $selectedMonth)
                ->whereYear('rekap_jahitan.created_at', $selectedYear);
        
            $data = $query->paginate(5);
        
            // Query untuk memeriksa apakah gaji sudah diberikan pada minggu ini untuk setiap karyawan
            $givenSalaries = DB::table('rekap_gaji')
                ->select('id_karyawan_gaji', 'tahun_gaji', 'bulan_gaji', 'minggu_gaji')
                ->where('tahun_gaji', $selectedYear)
                ->where('bulan_gaji', $selectedMonth)
                ->where('minggu_gaji', $selectedWeek)
                ->pluck('minggu_gaji', 'id_karyawan_gaji')
                ->toArray();
        
            return view('admin.data-gaji', [
                'data' => $data,
                'selectedWeek' => $selectedWeek,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'givenSalaries' => $givenSalaries
            ]);
        }
        
        
        
        
        // public function sendMessage(Request $request)
        // {
        //     $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        //     $chatId = '@kraugle';
        //     $message = $request->input('pesan');
    
        //     $reponse = $telegram->sendMessage([
        //         'chat_id' => $chatId,
        //         'text' => $message,
        //     ]);
    
        //     return redirect()->back();
        // }
        
// berigaji
        public function sendMessage(Request $request)
        {
            // Mengambil SID, token, dan nomor WhatsApp dari variabel lingkungan
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $twilioWhatsAppFrom = env('TWILIO_WHATSAPP_FROM');
            
            // Inisialisasi client Twilio
            $twilio = new Client($sid, $token);
            
            // Mengambil data dari request
            $body = $request->pesan;
            $to = 'whatsapp:' . $request->target;
            
            // Mengirim pesan melalui Twilio
            $message = $twilio->messages->create(
                $to, // to
                [
                    "from" => $twilioWhatsAppFrom,
                    "body" => $body
                ]
            );
            
            // Menyimpan data penggajian ke database
            $data = new RekapGaji;
            $data->id_karyawan_gaji = $request->id_karyawan_gaji;
            $data->jumlah_upah = $request->jumlah_upah;
            $data->jumlah_jahit = $request->jumlah_jahit;
            $data->tahun_gaji = $request->tahun_gaji;
            $data->bulan_gaji = $request->bulan_gaji;
            $data->minggu_gaji = $request->minggu_gaji;
            $data->save();
            
            // Redirect dengan pesan sukses
            return redirect()->route('data-gaji', [
                'week' => $request->minggu_gaji,
                'month' => $request->bulan_gaji,
                'year' => $request->tahun_gaji
            ])->with('success', 'Penggajian berhasil dilakukan');
        }


        public function rekapGaji(Request $request)
        {
            // Mendapatkan detail tanggal saat ini
            $currentDate = \Carbon\Carbon::now();
            $currentWeek = $currentDate->weekOfMonth;
            $currentMonth = $currentDate->month;
            $currentYear = $currentDate->year;
        
            // Mendapatkan filter yang dipilih atau nilai default
            $selectedWeek = $request->input('week');
            $selectedMonth = $request->input('month');
            $selectedYear = $request->input('year');
        
            // Query dasar
            $query = RekapGaji::join('karyawan', 'rekap_gaji.id_karyawan_gaji', '=', 'karyawan.id')
                              ->select('rekap_gaji.*', 'karyawan.nama_kry AS nama_karyawan');
        
            // Menambahkan filter jika ada
            if ($selectedWeek) {
                $query->where('rekap_gaji.minggu_gaji', $selectedWeek);
            }
        
            if ($selectedMonth) {
                $query->where('rekap_gaji.bulan_gaji', $selectedMonth);
            }
        
            if ($selectedYear) {
                $query->where('rekap_gaji.tahun_gaji', $selectedYear);
            }
        
            // Mendapatkan data yang sudah difilter atau semua data
            $data = $query->paginate(5);
        
            return view('admin.rekap-gaji', [
                'data' => $data,
                'selectedWeek' => $selectedWeek,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear
            ]);
        }
        
        
        
        
}