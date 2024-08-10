@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Data Rekap </h5>
              
          <table class="table ">

          
          
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Jenis Busana</th>
                        <th>Jumlah Pesanan</th>
                        <th>Jumlah Selesai</th>
                        <th>Aksi</th>               
                    </tr>
            </thead>
            @foreach($data as $key => $dataPesanan)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataPesanan->nama_pemesan }}</td>
                        <td>{{ $dataPesanan->jenis_busana }}</td>
                        <td>{{ $dataPesanan->jumlah }}</td>
                        <td>{{ $dataPesanan->jumlah_selesai }}</td>
                        <td>
                        <form action="{{route('delete-pesanan', $dataPesanan->id)}}" method="post">@csrf
                        <a href="{{ route('detail-rekap', $dataPesanan->id) }}" class="text-dark btn btn-warning px-4">Detail Rekap</a>
                         <!-- <button class="btn btn-danger px-3" onClick="return confirm('Yakin Hapus Karyawan?')">Delete</button> -->
                    </form>
                        </td>
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