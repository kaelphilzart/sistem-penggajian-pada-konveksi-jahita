@extends('template.template_karyawan')

@section('content')
<div class="container">
      <section class=" d-flex flex-column align-items-center justify-content-center  ">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4   pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Your Profile </h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('isi-profile') }}">
                   @csrf
                    <div class="col-12">
                      <label for="nama_kry" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama_kry" class="form-control" id="nama_kry" name="nama_kry" required>
                      @error('nama_kry')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="alamat_kry" class="form-label">Alamat</label>
                      <input type="text" name="alamat_kry" class="form-control" id="alamat_kry" name="alamat_kry" required>
                      @error('alamat_kry')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                    <label for="no_tlp" class="form-label">Contact</label>
                    <div class="input-group">
                      <span class="input-group-text">+62</span>
                      <input type="number" name="no_tlp" class="form-control" id="no_tlp" required>
                    </div>
                    @error('no_tlp')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-md-8">Simpan</button>
                    </div>
                  </form>

                </div>
              </div>

            

            </div>
          </div>
        </div>

      </section>

    </div>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const noTlpInput = document.getElementById('no_tlp');

    // Set default value to start with +62
    noTlpInput.value = '62';

    noTlpInput.addEventListener('input', function() {
      if (!noTlpInput.value.startsWith('62')) {
        noTlpInput.value = '62' + noTlpInput.value.replace(/^62*/, '');
      }
    });
  });
</script>
@endsection