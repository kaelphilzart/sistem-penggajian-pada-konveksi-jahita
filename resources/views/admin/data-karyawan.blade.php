@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Datatables</h5>
              
          <table class="table ">
          @include('admin.buat-karyawan')
          
          <div class="text-end mx-4">
                 <a href="#" class="text-dark btn btn-tema btn-sm mb-0 mt-4 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#buat-karyawan">+&nbsp; Karyawan</a>
                </div>
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Aksi</th>               
                    </tr>
            </thead>
            @foreach($data as $key => $dataKaryawan)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataKaryawan->nama_kry }}</td>
                        <td>{{ $dataKaryawan->alamat_kry }}</td>
                        <td>{{ $dataKaryawan->no_tlp }}</td>
                        <td>
                        <form action="{{route('delete-karyawan', $dataKaryawan->id)}}" method="post">@csrf
                       <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-karyawan{{$dataKaryawan->id}}">Edit</a>
                    <button class="btn btn-danger px-3" onClick="return confirm('Yakin Hapus Karyawan?')">Delete</button>
                    </form>
                        </td>
                           </tr>
                            @include('admin.edit-karyawan')
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