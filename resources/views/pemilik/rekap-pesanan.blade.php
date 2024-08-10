@extends('template.template_pemilik')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Rekap Pesanan</h5>
              
          <table class="table ">
       
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Pesanan</th>
                        <th>Jenis Busana</th>
                        <th>Jumlah</th>
                        <th>Waktu Pesan</th>
                        <th>Waktu Pengambilan</th>
                                  
                    </tr>
            </thead>
            @foreach($data as $key => $dataKaryawan)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataKaryawan->nama_pemesan }}</td>
                        <td>{{ $dataKaryawan->jenis_busana }}</td>
                        <td>{{ $dataKaryawan->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataKaryawan->created_at)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataKaryawan->tgl_pengambilan)->format('d-m-Y') }}</td>
                           </tr>
                   @endforeach
            </tbody>
          </table>
          <div class="pagination py-2 px-2">
            <div class="d-flex justify-content-center align-items-center">
             
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection