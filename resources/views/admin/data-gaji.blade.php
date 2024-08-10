@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Gaji</h5>
          <div class="col-md-12">
            <form action="{{ route('data-gaji') }}" method="GET">
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
          @if ($data->isEmpty())
            <div class="alert alert-warning mt-3">
              <p>Minggu ini belum ada jahitan selesai untuk filter yang dipilih.</p>
            </div>
          @else
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Karyawan</th>
                  <th>Gaji minggu ini</th>
                  <th>Total Jahit minggu ini</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $key => $dataGaji)
                  <tr>
                    <td>{{ $data->firstItem() + $key }}</td>
                    <td>{{ $dataGaji->nama_kry }}</td>
                    <td style="color: green; font-weight: bold;">
                      {{ formatRupiah($dataGaji->total_gaji) }}
                    </td>
                    <td>{{ $dataGaji->total_jahit }}</td>
                    <td>
                      @if (isset($givenSalaries[$dataGaji->id_pengerja]) && 
                           $givenSalaries[$dataGaji->id_pengerja] == $dataGaji->minggu_ke)
                        <button class="btn btn-secondary px-4" disabled>Gaji Sudah Diberikan</button>
                      @else
                        <a href="#" class="text-dark btn btn-info px-4" type="button" data-bs-toggle="modal" data-bs-target="#beri-gaji{{ $dataGaji->id }}">Beri Gaji</a>
                      @endif
                    </td>
                  </tr>
                  @include('admin.pesan-gaji', ['dataGaji' => $dataGaji])
                @endforeach
              </tbody>
            </table>
            {{ $data->appends(request()->input())->links('pagination::bootstrap-4') }}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
