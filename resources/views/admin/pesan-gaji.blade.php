<div class="modal fade" id="beri-gaji{{ $dataGaji->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pemberian Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('send-whatsapp') }}" method="POST">
                    @csrf
                    <input type="text" id="target" name="target" value="{{ $dataGaji->no_tlp }}" hidden>
                    <input type="hidden" id="id_karyawan_gaji" name="id_karyawan_gaji" value="{{ $dataGaji->id_pengerja }}">
                    <input type="hidden" id="jumlah_upah" name="jumlah_upah" value="{{ $dataGaji->total_gaji }}">
                    <input type="hidden" id="jumlah_jahit" name="jumlah_jahit" value="{{ $dataGaji->total_jahit }}">
                    <input type="hidden" id="tahun_gaji" name="tahun_gaji" value="{{ $selectedYear }}">
                    <input type="hidden" id="bulan_gaji" name="bulan_gaji" value="{{ $selectedMonth }}">
                    <input type="hidden" id="minggu_gaji" name="minggu_gaji" value="{{ $selectedWeek }}">
                    <div id="pesan" name="pesan">
                        <h4>Dari Dwi Tailor</h4>
                        <div class="message-container">
                            <p>Kepada <strong>{{ $dataGaji->nama_kry }}</strong></p>
                            <p>Gaji Minggu ini sebesar <strong>{{ formatRupiah($dataGaji->total_gaji) }}</strong> dengan jahitan yang diperoleh, <strong>{{ $dataGaji->total_jahit }} pcs</strong></p>
                            <p>Gaji Anda telah ditransfer. Terima kasih atas kerja keras Anda dan jangan lupa jaga kesehatan.</p>
                        </div>
                    </div>
                    <input type="hidden" id="pesan" name="pesan" value="
                        Kepada {{ $dataGaji->nama_kry }},
                        Gaji Minggu ini sebesar {{ formatRupiah($dataGaji->total_gaji) }},
                        dengan jahitan yang diperoleh, {{ $dataGaji->total_jahit }} pcs.
                        Gaji Anda telah ditransfer. Terima kasih atas kerja keras Anda dan jangan lupa jaga kesehatan.
                    ">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
