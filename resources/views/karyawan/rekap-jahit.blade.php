@extends('template.template_karyawan')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rekap Jahit dan Upah</h5>
          <div class="row mt-4">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                  <form action="{{ route('rekap-jahit') }}" method="GET">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="week">Pilih Minggu</label>
                          <select class="form-control" id="week" name="week">
                            <option value="">Pilih Minggu</option>
                            @for ($i = 1; $i <= 4; $i++) 
                              <option value="{{ $i }}" {{ request('week', $selectedWeek)==$i ? 'selected' : '' }}>
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
                              <option value="{{ $i }}" {{ request('month', $selectedMonth)==$i ? 'selected' : '' }}>
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
                              <option value="{{ $i }}" {{ request('year', $selectedYear)==$i ? 'selected' : '' }}>
                                {{ $i }}
                              </option>
                            @endfor
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary"><span class="mx-4">Filter</span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <h5 class="text-end">Total jahit: {{ $data1 }}</h5>
              <h5 class="text-end" style="color: green; font-weight: bold; text-align: right;">Total upah : {{formatRupiah ($data2)}}</h5>
            </div>
          </div>
          <table class="table my-4">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pcs</th>
                <th>Jenis Busana</th>
                <th>Tugas Karyawan</th>
                <th>Pengerja Jahit</th>
                <th>Upah</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key => $dataKaryawan)
              <tr>
                <td>{{ $data->firstItem() + $key }}</td>
                <td>{{ $dataKaryawan->nama_pcs }}</td>
                <td>{{ $dataKaryawan->jenis_busana }}</td>
                <td>{{ $dataKaryawan->nama_tugas }}</td>
                <td>{{ $dataKaryawan->nama_pengerja }}</td>
                <td style="color: green; font-weight: bold; text-align: right;">
                  <span>+ </span>{{ formatRupiah($dataKaryawan->upah) }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination py-2 px-2">
            <div class="d-flex justify-content-center align-items-center">
              {{ $data->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
