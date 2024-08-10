<div class="modal fade" id="buat-pesanan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-pesanan')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan">
                                @error('nama_pemesan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_busana" class="form-label">Jenis Busana</label>
                                <select class="form-select" id="id_busana" name="id_busana">
                                    @foreach($data1 as $data1)
                                    <option value="{{ $data1->id }}">{{ $data1->jenis_busana }}</option>
                                    @endforeach
                                </select>
                                @error('id_busana')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah"
                                    step="any">
                                @error('jumlah')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="tgl_pengambilan" class="form-label">Pengambilan</label>
                            <input type="date" class="form-control" id="tgl_pengambilan" name="tgl_pengambilan" step="any">
                            @error('tgl_pengambilan')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl_pengambilan').setAttribute('min', today);
    });
</script>
