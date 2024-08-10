@extends('template.template_karyawan')

@section('content')
<div class="card">
    <div class="card-header bg-ijo text-white">
        <h5 class="card-title text-dark">PROFILE KARYAWAN</h5>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <div class="col-md-4 text-center">
                <img src="##" class="img-fluid rounded-circle" alt="Foto Profil">
              
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                    <p><strong>Nama Karyawan:</strong></p>
                        <p><strong>Alamat:</strong></p>
                        <p><strong>No Telepon:</strong></p>
                    </div>
                    <div class="col-md-6">
                    <p>{{ $data->nama_kry }}</p>
                        <p>{{ $data->alamat_kry }}</p>
                        <p>{{ $data->no_tlp }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
