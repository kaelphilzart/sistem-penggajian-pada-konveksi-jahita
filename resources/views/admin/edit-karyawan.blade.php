<div class="modal fade" id="edit-karyawan{{$dataKaryawan->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-karyawan', ['id' => $dataKaryawan->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kry" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_kry" name="nama_kry" value="{{ $dataKaryawan->nama_kry }}">
                        @error('nama_kry')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_kry" class="form-label">Alamat Karyawan</label>
                        <input type="text" class="form-control" id="alamat_kry" name="alamat_kry" value="{{ $dataKaryawan->alamat_kry }}">
                        @error('alamat_kry')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No Telepon</label>
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" value="{{ $dataKaryawan->no_tlp }}">
                        @error('no_tlp')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <!-- tambahkan input lainnya sesuai kebutuhan -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
