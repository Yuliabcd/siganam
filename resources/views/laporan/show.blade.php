@extends('layouts.app')

@section('title')
  Detail Laporan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Detail Laporan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active">Detail Laporan</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  @php
  function rupiah($angka)
  {
      $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
      return $hasil_rupiah;
  }
  @endphp
  <div class="container-fluid">
    @include('partials.alerts')

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Laporan</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th colspan="2">Hari / Tanggal</th>
                  <td colspan="6">{{ \Carbon\Carbon::parse($laporan->tanggal)->isoFormat('dddd, DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                  <th colspan="2">Tempat / Rumah</th>
                  <td colspan="6">{{ $laporan->tempat }}</td>
                </tr>
                <tr>
                  <td colspan="8">Laporan Bendahara (Seksi dan Laporan DATA WARGA masing-masing RT se Ganam)</td>
                </tr>
                <tr>
                  <th>Pengurus</th>
                  <th>Posisi</th>
                  <th>Saldo Awal</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                  <th>Saldo Akhir</th>
                  <th colspan="3"></th>
                </tr>
                @php
                  $laporan_pengurus = $laporan->laporanPengurus;
                  $simpan_pinjam = $laporan->laporanSimpanPinjam;
                @endphp
                @foreach ($laporan_pengurus as $item)
                  <tr>
                    <td>{{ $item->pengurus->nama }}</td>
                    <td>{{ $item->pengurus->posisi->nama }}</td>
                    <td>{{ rupiah($item->saldo_awal) }}</td>
                    <td>{{ rupiah($item->masuk) }}</td>
                    <td>{{ rupiah($item->keluar) }}</td>
                    <td>{{ rupiah($item->saldo_akhir) }}</td>
                    <td colspan="3"></td>
                  </tr>
                @endforeach
                <tr>
                  <th></th>
                  <th>Saldo Awal</th>
                  <th>Tabungan</th>
                  <th>Jasa</th>
                  <th>Angsuran</th>
                  <th>Denda</th>
                  <th>Piutang</th>
                  <th>Saldo Akhir</th>
                </tr>
                <tr>
                  <td>Simpan Pinjam</td>
                  <td>{{ rupiah($simpan_pinjam->saldo_awal) }}</td>
                  <td>{{ rupiah($simpan_pinjam->tabungan) }}</td>
                  <td>{{ rupiah($simpan_pinjam->jasa) }}</td>
                  <td>{{ rupiah($simpan_pinjam->angsuran) }}</td>
                  <td>{{ rupiah($simpan_pinjam->denda) }}</td>
                  <td>{{ rupiah($simpan_pinjam->piutang) }}</td>
                  <td>{{ rupiah($simpan_pinjam->saldo_akhir) }}</td>
                </tr>
                <tr>
                  <th colspan="4">Informasi Ketua PKK RW GANAM</th>
                  <th colspan="4">Serap Info dari RT dan Lain-lain</th>
                </tr>
                <tr>
                  <td colspan="4">{!! $laporan->informasi !!}</td>
                  <td colspan="4">{!! $laporan->serap_info !!}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection
