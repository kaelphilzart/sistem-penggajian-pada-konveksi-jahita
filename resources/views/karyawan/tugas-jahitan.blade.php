@extends('template.template_karyawan')

@section('content')
<style>
    .btn-light {
        background-color: #f8f9fa;
        color: #000;
    }
    .btn-clicked {
        background-color: #D3D3D3;
        color: #000;
    }
</style>
<div class="container py-4">
    <div class="col-md-12 text-end">
        <h4 style="font-weight: bold;">Tugas Jahitan Anda: {{$tugas}} pcs</h4>
    </div>
    <h4 class="text-center"><b>Detail Jahit</b></h4>
    <div class="row">
        @foreach($data as $key => $dataJahit)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm bg-ijo">
                <div class="card-body">
                    <div class="text-dark mt-3">
                        <h5 class="card-title">Nama pcs : {{ strtoupper($dataJahit->nama_pcs) }}</h5>
                        <div class="row">
                            <div class="col-md-7" style="font-weight: bold;">
                                <p>Jenis Busana</p>
                                <p>Panjang Lengan</p>
                                <p>Lingkar Dada</p>
                                <p>Lingkar Pinggang</p>
                                <p>Panjang Baju</p>
                                <p>Lingkar Lengan</p>
                            </div>
                            <div class="col-md-5">
                                <p>{{$dataJahit->nama_busana}}</p>
                                <p>{{$dataJahit->panjang_lengan}} cm</p>
                                <p>{{$dataJahit->lingkar_dada}} cm</p>
                                <p>{{$dataJahit->lingkar_pinggang}} cm</p>
                                <p>{{$dataJahit->panjang_baju}} cm</p>
                                <p>{{$dataJahit->lingkar_lengan}} cm</p>
                            </div>
                        </div>
                        <p>Tugas Menjahit : {{$dataJahit->nama_kry}}</p>
                    </div>
                    <div class="text-end">
                        @if($dataJahit->id_karyawan != $karyawanId)
                            @if($dataJahit->status == 'belum selesai')
                                <form action="{{ route('tugas-ambil', $dataJahit->id) }}" method="post">@csrf
                                    <button class="btn btn-primary px-3" onClick="return confirm('Yakin mau ambil?')">Ambil</button>
                                </form>
                            @elseif($dataJahit->status == 'nunggu validasi')
                                <button class="btn btn-secondary px-3" disabled>Menunggu</button>
                            @elseif($dataJahit->status == 'disetujui')
                                <form action="{{ route('tugas-selesai', $dataJahit->id) }}" method="post">@csrf
                                    <button class="btn btn-warning px-3" onClick="return confirm('Yakin sudah selesai?')">Selesai</button>
                                </form>
                            @elseif($dataJahit->status == 'proses')
                                <button class="btn btn-secondary px-3" disabled>Proses</button>
                            @elseif($dataJahit->status == 'tidak disetujui')
                                <button class="btn btn-secondary px-3" disabled>Ditolak</button>
                            @endif
                        @else
                            @if($dataJahit->status == 'belum selesai')
                            <div class="row">
                                <div class="col-auto">
                                <form action="{{ route('tugas-lepas', $dataJahit->id) }}" method="post">@csrf
                                        <button class="btn btn-primary px-3" onClick="return confirm('Yakin anda akan melepas tugas ini?')">Lepaskan</button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                <form action="{{ route('tugas-proses', $dataJahit->id) }}" method="post">@csrf
                                        <button class="btn btn-light px-3" onClick="return confirm('Yakin anda akan memulai mengerjakan tugas ini?')">Proses</button>
                                    </form>
                                </div>
                            </div>
                            @elseif($dataJahit->status == 'pengerjaan')
                            <div class="row">
                                <div class="col-auto">
                                <button class="btn btn-light px-3" disabled>diproses</button>
                                </div>
                            <div class="col-auto">
                                    <form action="{{ route('tugas-selesai', $dataJahit->id) }}" method="post">@csrf
                                        <button class="btn btn-warning px-3" onClick="return confirm('Yakin sudah selesai?')">Selesai</button>
                                    </form>
                                </div>
                                </div>
                            @elseif($dataJahit->status == 'proses')
                                <button class="btn btn-secondary px-3" disabled>menunggu validasi</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
