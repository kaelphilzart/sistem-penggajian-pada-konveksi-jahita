@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rekap Gaji</h5>
          <div class="col-md-12 mb-3">
            <form action="{{ route('rekap-gaji') }}" method="GET">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="week">Pilih Minggu</label>
                    <select class="form-control" id="week" name="week">
                      <option value="">Pilih Minggu</option>
                      @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ request('week', $selectedWeek) == $i ? 'selected' : '' }}>
                          Minggu ke-{{ $i }}
                        </option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="month">Pilih Bulan</label>
                    <select class="form-control" id="month" name="month">
                      <option value="">Pilih Bulan</option>
                      @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('month', $selectedMonth) == $i ? 'selected' : '' }}>
                          {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="year">Pilih Tahun</label>
                    <select class="form-control" id="year" name="year">
                      @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                        <option value="{{ $i }}" {{ request('year', $selectedYear) == $i ? 'selected' : '' }}>
                          {{ $i }}
                        </option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary">
                    <span class="mx-4">Filter</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jumlah Gaji</th>
                <th>Jumlah Jahit</th>
                <th>Waktu Penggajian</th>
              </tr>
            </thead>
            <tbody>
              @if($data->isEmpty())
                <tr>
                  <td colspan="5" class="text-center">Tidak ada data gaji yang ditemukan.</td>
                </tr>
              @else
                @foreach($data as $key => $dataGaji)
                  <tr>
                    <td>{{ $data->firstItem() + $key }}</td>
                    <td>{{ $dataGaji->nama_karyawan }}</td>
                    <td style="color: green; font-weight: bold;">{{ formatRupiah($dataGaji->jumlah_upah) }}</td>
                    <td>{{ $dataGaji->jumlah_jahit }}</td>
                    <td>{{ \Carbon\Carbon::parse($dataGaji->created_at)->format('d-m-Y') }}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
          {{ $data->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
