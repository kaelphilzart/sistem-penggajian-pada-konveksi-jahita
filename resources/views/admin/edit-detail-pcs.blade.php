<div class="modal fade" id="edit-pcs{{$dataDetail->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit per pcs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-detail', ['id' => $dataDetail->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_pcs" class="form-label">Nama pcs</label>
                                <input type="text" class="form-control" id="nama_pcs" name="nama_pcs" value="{{$dataDetail->nama_pcs}}">
                                @error('nama_pcs')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="panjang_lengan" class="form-label">Panjang Lengan</label>
                                <input type="number" class="form-control" id="panjang_lengan" name="panjang_lengan"
                                    placeholder="Panjang Lengan" step="any" value="{{$dataDetail->panjang_lengan}}">
                                @error('panjang_lengan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lingkar_dada" class="form-label">Lingkar Dada</label>
                                <input type="number" class="form-control" id="lingkar_dada" name="lingkar_dada"
                                    placeholder="Lingkar Dada" step="any" value="{{$dataDetail->lingkar_dada}}">
                                @error('lingkar_dada')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lingkar_pinggang" class="form-label">Lingkar Pinggang</label>
                                <input type="number" class="form-control" id="lingkar_pinggang" name="lingkar_pinggang"
                                    placeholder="lingkar Pinggang" step="any" value="{{$dataDetail->lingkar_pinggang}}">
                                @error('lingkar_pinggang')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="panjang_baju" class="form-label">Panjang Baju</label>
                                <input type="number" class="form-control" id="panjang_baju" name="panjang_baju"
                                    placeholder="Panjang Baju" step="any" value="{{$dataDetail->panjang_baju}}">
                                @error('panjang_baju')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lingkar_lengan" class="form-label">Lingkar Lengan</label>
                                <input type="number" class="form-control" id="lingkar_lengan" name="lingkar_lengan"
                                    placeholder="Lingkar Lengan" step="any" value="{{$dataDetail->lingkar_lengan}}">
                                @error('lingkar_lengan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_karyawan" class="form-label">Karyawan yang mengerjakan</label>
                                <select class="form-select" id="id_karyawan" name="id_karyawan" value="{{$dataDetail->id_karyawan}}">
                                    @foreach($data1 as $data1)
                                    <option value="{{ $data1->id }}">{{ $data1->nama_kry }}</option>
                                    @endforeach
                                </select>
                                @error('id_karyawan')
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
