@extends('template.template_pemilik')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body ">
          <h5 class="card-title">Datatables</h5>
              
          <table class="table ">
       
            <thead>
            <tr class="">
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                                  
                    </tr>
            </thead>
            @foreach($data as $key => $dataKaryawan)
            <tbody>
            <tr class="">
                       <td>{{  $data->firstItem() + $key }}</td>
                        <td>{{ $dataKaryawan->nama_kry }}</td>
                        <td>{{ $dataKaryawan->alamat_kry }}</td>
                        <td>{{ $dataKaryawan->no_tlp }}</td>
               
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