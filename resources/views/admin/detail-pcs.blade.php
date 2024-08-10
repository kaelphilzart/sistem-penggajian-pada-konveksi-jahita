<div class="modal fade" id="detail-pcs{{$dataDetail->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-tema">
                <h5 class="modal-title">Detail Pcs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 style="font-weight: bold;">{{ strtoupper($dataDetail->nama_pcs) }}</h4>
                        </div>
                        <div class="col-md-8">
                            <p class="text-end">Karyawan : {{ $dataDetail->nama_kry }}</p>
                        </div>
                    </div>
                    <p class="text-center">Keterangan Pakaian</p>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <p>Panjang Lengan</p>
                            <p>Lingkar Dada</p>
                            <p>Lingkar Pinggang</p>
                            <p>Panjang Baju</p>
                            <p>Lingkar Lengan</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <p>{{ $dataDetail->panjang_lengan }} cm</p>
                            <p>{{ $dataDetail->lingkar_dada }} cm</p>
                            <p>{{ $dataDetail->lingkar_pinggang }} cm</p>
                            <p>{{ $dataDetail->panjang_baju }} cm</p>
                            <p>{{ $dataDetail->lingkar_lengan }} cm</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('cetak-detail', $dataDetail->id) }}" class="btn btn-primary">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</div>
