<div class="modal fade" id="bagi-tugas-lepas{{$dataPesanan->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bagi Tugas Lepas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bagi-tugas-lepas') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id_pesanan" name="id_pesanan" value="{{ $dataPesanan->id }}">
                    <div class="mb-3">
                        <label for="id_detail" class="form-label">Tugas Yang Telah Dilepas</label>
                        <select class="form-select" id="id_detail" name="id_detail">
                            <option value="">pilh tugas yang akan dibagikan</option>
                            @foreach($data2 as $item)
                            <option value="{{ $item->id }}">nama pcs: {{ $item->nama_pcs }} | karyawan pengerja: {{ $item->nama_kry }}</option>
                            @endforeach
                        </select>
                        @error('id_detail')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_busana" class="form-label">Tugas Karyawan Baru</label>
                        <select class="form-select" id="id_karyawan" name="id_karyawan">
                            <option value="">pilh karyawan yang mengerjakan</option>
                            @foreach($data3 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kry }}</option>
                            @endforeach
                        </select>
                        @error('id_karyawan')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
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
