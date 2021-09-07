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
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox"
                  data-title="sample 1 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox"
                  data-title="sample 2 - black" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox"
                  data-title="sample 3 - red" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2"
                    alt="red sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox"
                  data-title="sample 4 - red" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2"
                    alt="red sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox"
                  data-title="sample 5 - black" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox"
                  data-title="sample 6 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox"
                  data-title="sample 7 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox"
                  data-title="sample 8 - black" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox"
                  data-title="sample 9 - red" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2"
                    alt="red sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox"
                  data-title="sample 10 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox"
                  data-title="sample 11 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample" />
                </a>
              </div>
              <div class="col-sm-2">
                <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox"
                  data-title="sample 12 - black" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample" />
                </a>
              </div>
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
