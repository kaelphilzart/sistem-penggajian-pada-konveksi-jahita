@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Data Busana</h5>
              
          <table class="table ">
          @include('admin.buat-jenisBusana')
          <div class="text-end mx-4">
                 <a href="#" class="text-dark btn btn-tema btn-sm mb-0 mt-4 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#buat-jenisBusana">+&nbsp; Jenis Busana</a>
                </div>
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Jenis Busana</th>
                        <th>Upah PerPCS</th>
                        <th>Aksi</th>               
                    </tr>
            </thead>
            @foreach($data as $key => $dataBusana)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataBusana->jenis_busana }}</td>
                        <td>{{ formatRupiah($dataBusana->upahPcs) }}</td>
                        <td>
                        <form action="{{route('delete-busana', $dataBusana->id)}}" method="post">@csrf
                       <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-busana{{$dataBusana->id}}">Edit</a>
                    <button class="btn btn-danger px-3" onClick="return confirm('Yakin Hapus Busana?')">Delete</button>
                    </form>
                        </td>
                           </tr>
                           @include('admin.edit-busana')
                   @endforeach
            </tbody>
          </table>
        
        </div>
      </div>

    </div>
  </div>
</section>
@endsection