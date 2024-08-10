<div class="modal fade" id="edit-busana{{$dataBusana->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Busana</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-busana', ['id' => $dataBusana->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_busana" class="form-label">Nama Jenis Busana</label>
                        <input type="text" class="form-control" id="jenis_busana" name="jenis_busana" value="{{ $dataBusana->jenis_busana }}">
                        @error('jenis_busana')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="upahPcs" class="form-label">Upah perPCS</label>
                        <input type="text" class="form-control" id="upahPcs" name="upahPcs" value="{{ $dataBusana->upahPcs }}">
                        @error('upahPcs')
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
