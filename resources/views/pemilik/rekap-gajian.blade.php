@extends('template.template_pemilik')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Rekap Gaji</h5>
              
          <table class="table ">
       
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Jumlah Upah</th>
                        <th>Jumlah Jahit</th>
                        <th>Gajian Waktu</th>
                        <th>Waktu Penggajian</th>
                                  
                    </tr>
            </thead>
            @foreach($data as $key => $dataGajian)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataGajian->nama_kry }}</td>
                        <td style="color: green; font-weight: bold;">{{ formatRupiah($dataGajian->jumlah_upah) }}</td>
                        <td>{{ $dataGajian->jumlah_jahit }} pcs</td>
                        <td>{{$dataGajian->minggu_gaji}} / {{$dataGajian->bulan_gaji}} / {{$dataGajian->tahun_gaji}}</td>
                        <td>{{ \Carbon\Carbon::parse($dataGajian->created_at)->format('d-m-Y') }}</td>
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