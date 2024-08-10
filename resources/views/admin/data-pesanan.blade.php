@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Pesanan</h5>
              
          <table class="table">
          @include('admin.buat-pesanan')
          
          <div class="text-end mx-4">
            <a href="#" class="text-dark btn btn-tema btn-sm mb-0 mt-4 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#buat-pesanan">+&nbsp; Pesanan</a>
          </div>
          <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 10%;">Tanggal Pemesanan</th>
                  <th style="width: 10%;">Nama Pemesan</th>
                  <th style="width: 10%;">Jenis Busana</th>
                  <th style="width: 5%;">Jumlah</th>
                  <th style="width: 15%;">Upah</th>
                  <th style="width: 35%;">Aksi</th>
                  <th style="width: 5%;">Status</th>
                  <th style="width: 5%;">Customer</th>
                </tr>
              </thead>

              @foreach($data as $key => $dataPesanan)
              <tbody>
                <tr>
                  <td style="width: 5%;">{{  $data->firstItem() + $key }}</td>
                  <td style="width: 10%;">{{ \Carbon\Carbon::parse($dataPesanan->created_at)->format('d-m-Y') }}</td>
                  <td style="width: 10%;">{{ $dataPesanan->nama_pemesan }}</td>
                  <td style="width: 10%;">{{ $dataPesanan->jenis_busana }}</td>
                  <td style="width: 5%;">{{ $dataPesanan->jumlah }}</td>
                  <td style="width: 15%;">{{ formatRupiah($dataPesanan->upahPcs) }}</td>
                  <td style="width: 35%;">
                    <form action="{{route('delete-pesanan', $dataPesanan->id)}}" method="post">
                      @csrf
                      <a href="{{ route('detail-pesanan', $dataPesanan->id) }}" class="text-dark btn btn-warning">Detail</a>
                      <a href="#" class="text-dark btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#edit-pesanan{{$dataPesanan->id}}">Edit</a>
                      <button class="btn btn-danger" onClick="return confirm('Yakin Hapus Pesanan?')">Delete</button>
                    </form>
                  </td>
                  <td style="width: 5%;">{{ $dataPesanan->status }}</td>
                  <td style="width: 5%;">
                    <form action="{{ route('serah-pesanan', ['id' => $dataPesanan->id]) }}" method="post" id="serahForm">
                      @csrf
                      <input type="hidden" name="tgl_pengambilan" value="{{ $dataPesanan->tgl_pengambilan }}">
                      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal" {{ $dataPesanan->status != 'proses' ? 'disabled' : '' }}>Penyerahan</button>
                    </form>
                  </td>
                </tr>
                @include('admin.edit-pesanan')
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
@include('admin.validasi-modal-serah')
@endsection
