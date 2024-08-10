<div class="modal fade" id="buat-jenisBusana" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Jenis Busana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-busana')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_busana" class="form-label">Jenis Busana</label>
                        <input type="text" class="form-control" id="jenis_busana" name="jenis_busana">
                        @error('jenis_busana')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="upahPcs" class="form-label">Upah PerPCS</label>
                        <input type="text" class="form-control" id="upahPcs" name="upahPcs">
                        @error('upahPcs')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"onClick="return confirm('Yakin Tambah Jenis Busana?')">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
