@extends('layouts.app')

@section('title')
  Detail Pengurus
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Detail Pengurus</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('penguruses.index') }}">Pengurus</a></li>
        <li class="breadcrumb-item active">Detail Pengurus</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  <div class="container-fluid">
    @include('partials.alerts')

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Pengurus</h3>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengurus->nama }}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="nama_panggilan">Nama Panggilan</label>
                <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"
                  value="{{ $pengurus->nama_panggilan }}" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="posisi_id">Posisi</label>
                <input type="text" class="form-control" id="posisi_id" name="posisi_id"
                  value="{{ $pengurus->posisi->nama }}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                  value="{{ $pengurus->jenis_kelamin_text }}" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pengurus->alamat }}"
                  readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="no_hp">No. Hp/WhatsApp</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                  value="{{ $pengurus->no_hp }}" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="foto">Foto Profil</label>
                <div class="img__preview p-1 border">
                  <img src="{{ $pengurus->foto_url }}" alt="{{ $pengurus->nama }}" class="img-fluid w-100">
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $pengurus->email }}"
                  readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection
