
@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body ">
        <div class="row my-4">
        <div class="col-md-3">
            <h5 class="">Nama Pemesan : {{ ($dataPesanan->nama_pemesan) }}</h5>
            </div>
            <div class="col-md-3">
            <h5 class="">Jenis Busana : {{ ($dataPesanan->jenis_busana) }}</h5>
            </div>
            <!-- <div class="col-md-2">
            <h5 class="">Jumlah : {{ ($dataPesanan->jumlah) }}</h5>
            </div> -->
            <!-- <div class="col-md-4">
            <h5 class="">Pengambilan : {{ ($dataPesanan->tgl_pengambilan) }}</h5>
            </div> -->
            </div>
          <table class="table">
          
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Perpcs</th>
                        <th>Tugas Jahit</th>
                        <th>Pengerja Jahit</th>
                        <th>Penyelesaian Jahit</th>              
                    </tr>
            </thead>
            @foreach($data as $key => $dataDetail)
            <tbody>
            <tr class="">
                      <td>{{  $data ->firstItem() + $key }}</td>
                      <td>{{ $dataDetail->nama_pcs }}</td>
                        <td>{{ $dataDetail->karyawan_tugas }}</td>
                        <td>{{ $dataDetail->karyawan_pengerja }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataDetail->tgl_selesai)->format('d-m-Y') }}</td>
                           </tr>
                          
                   @endforeach
            </tbody>
          </table>
        
        </div>
      </div>

    </div>
  </div>
</section>

@endsection