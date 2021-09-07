@extends('layouts.app')

@section('title')
  Tambah Laporan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Tambah Laporan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active">Tambah Laporan</li>
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
            <h3 class="card-title">Tambah Laporan</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('laporan.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="tanggal">Tanggal <code>*</code></label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">
              </div>

              <div class="form-group">
                <label for="tempat">Tempat <code>*</code></label>
                <input type="text" name="tempat" id="tempat" class="form-control" value="{{ old('tempat') }}">
              </div>
              <div class="form-group">
                <label for="informasi">Informasi Ketua PKK RW GANAM</label>
                <textarea class="summernote" name="informasi">{{ old('informasi') }}</textarea>
              </div>
              <div class="form-group">
                <label for="serap_info">Serap info dari RT dan Lain-lain</label>
                <textarea class="summernote" name="serap_info">{{ old('serap_info') }}</textarea>
              </div>
              <div class="form-group mt-3">
                <button type="submit" class="btn btn-block btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    $(function() {
      $('.summernote').summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['height', ['height']]
        ],
      })
    });
  </script>
@endpush
