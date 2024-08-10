
@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body ">
            <div class="row mt-4">
            <div class="col-md-3">
            <h5 class="">Nama Pemesan : {{ ($dataPesanan->nama_pemesan) }}</h5>
            </div>
            <div class="col-md-3">
            <h5 class="">Jenis Busana : {{ ($dataPesanan->jenis_busana) }}</h5>
            </div>
            <div class="col-md-2">
            <h5 class="">Jumlah : {{ ($dataPesanan->jumlah) }}</h5>
            </div>
            <div class="col-md-4">
            <h5 class="">Pengambilan : {{ ($dataPesanan->tgl_pengambilan) }}</h5>
            </div>
            </div>
            <div class="row gy-2 gx-3">
              <div class="col-auto">
              @include('admin.bagi-tugas-lepas')
                 <a href="#" class="btn btn-primary btn-sm mb-0 mt-4 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#bagi-tugas-lepas{{$dataPesanan->id}}">+&nbsp; Pembagian Tugas Lepas</a>
              </div>
              <div class="col-auto">
              @include('admin.bagi-detail-pesanan')
                 <a href="#" class="text-dark btn btn-tema btn-sm mb-0 mt-4 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#bagi-pesanan{{$dataPesanan->id}}">+&nbsp; Tambah Detail Pesanan</a>
              </div>
            </div>
          <table class="table">
          
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Perpcs</th>
                        <th>Tugas Karyawan</th>
                        <!-- <th>Status</th> -->
                        <th>Aksi</th>               
                    </tr>
            </thead>
            @foreach($data as $key => $dataDetail)
            <tbody>
            <tr class="">
                       <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataDetail->nama_pcs }}</td>
                        <td>{{ $dataDetail->nama_kry }}</td>
                        <!-- <td id="statusCell{{$key}}" class="status-cell">{{$dataDetail->status}}</td> -->
                        <td>
                        <form action="{{route('delete-detail', $dataDetail->id)}}" method="post">@csrf
                       <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#detail-pcs{{$dataDetail->id}}">Detail pcs</a>
                       <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-pcs{{$dataDetail->id}}">Edit</a>
                    <button class="btn btn-danger px-3" onClick="return confirm('Yakin Hapus Tugas?')">Delete</button>
                    </form>
                        </td>
                           </tr>
                           @include('admin.edit-detail-pcs')
                          @include('admin.detail-pcs')
                          
                   @endforeach
            </tbody>
          </table>
        
        </div>
      </div>

    </div>
  </div>
</section>

<script>
    var statusCells = document.querySelectorAll('.status-cell');

    statusCells.forEach(function(cell) {
        var status = cell.innerText.trim();

        if (status === 'belum selesai') {
            cell.style.color = 'red';
        } else {
            cell.style.color = 'green';
        }
    });
</script>

@endsection