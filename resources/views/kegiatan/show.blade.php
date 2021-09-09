@extends('layouts.app')

@section('title')
  Detail Kegiatan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Detail Kegiatan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
        <li class="breadcrumb-item active">Detail Kegiatan</li>
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
            <h3 class="card-title">Detail Kegiatan</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-sm">
              <tr>
                <td colspan="2">
                  <img src="{{ Storage::url($kegiatan->foto) }}" alt="{{ $kegiatan->nama }}" class="img-fluid w-100">
                </td>
              </tr>
              <tr>
                <th>Nama Kegiatan</th>
                <td>{{ $kegiatan->nama }}</td>
              </tr>
              <tr>
                <th>Tanggal</th>
                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->isoFormat('dddd, DD MMMM YYYY') }}</td>
              </tr>
              <tr>
                <th>Jam</th>
                <td>{{ $kegiatan->jam }}</td>
              </tr>
              <tr>
                <th>Tempat</th>
                <td>{{ $kegiatan->tempat }}</td>
              </tr>
              <tr>
                <th>Keterangan</th>
                <td>{{ $kegiatan->Keterangan }}</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Galeri Foto</h3>
          </div>
          <div class="card-body">
            <div class="row">
              @foreach ($kegiatan->fotoKegiatan as $item)
                <div class="col-sm-2">
                  <a href="{{ $item->foto_url }}" data-toggle="lightbox" data-title="{{ $item->filename }}"
                    data-gallery="gallery">
                    <img src="{{ $item->foto_url }}" class="img-fluid w-100 mb-2" alt="{{ $item->filename }}" />
                  </a>
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@push('scripts')
  <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
  <script>
    $(function() {
      $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });

        $('.filter-container').filterizr({
          gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
          $('.btn[data-filter]').removeClass('active');
          $(this).addClass('active');
        });
      })
    });
  </script>
@endpush
