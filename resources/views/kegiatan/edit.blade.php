@extends('layouts.app')

@section('title')
  Edit Kegiatan
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit Kegiatan</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
        <li class="breadcrumb-item active">Edit Kegiatan</li>
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
            <h3 class="card-title">Edit Kegiatan</h3>
          </div>
          <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nama">Nama <code>*</code></label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ $kegiatan->nama }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="tanggal">Tanggal <code>*</code></label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal"
                    value="{{ $kegiatan->tanggal }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="jam">Jam</label>
                  <input type="time" class="form-control" id="jam" name="jam" value="{{ $kegiatan->jam }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="tempat">Tempat <code>*</code></label>
                  <input type="text" class="form-control" id="tempat" name="tempat" value="{{ $kegiatan->tempat }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="foto">Foto</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg, .jpeg, .png">
                    <label class="custom-file-label" for="foto">Choose file</label>
                  </div>
                  <small class="form-text text-muted">Ukuran maksimal 1MB, format: JPG,JPEG atau PNG</small>
                  <div class="img__preview p-1 border mt-3">
                    <img src="{{ Storage::url($kegiatan->foto) }}" alt="{{ $kegiatan->nama }}"
                      class="img-fluid w-100">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="keterangan">Keterangan</label>
                  <textarea name="keterangan" id="keterangan"
                    class="form-control">{{ $kegiatan->keterangan }}</textarea>
                </div>
              </div>

              <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
              </div>
            </div>
          </form>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Galeri Foto</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('upload_foto_kegiatan', $kegiatan->id) }}" method="POST" class="dropzone"
              id="formFotoKegiatan">
              @csrf
              <div class="fallback">
                <input name="file" type="file" multiple />
              </div>
            </form>
          </div>
          <div class="card-footer">
            <button class="btn btn-block btn-primary btn-save">Simpan</button>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">
@endpush

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"></script>
  <script>
    Dropzone.autoDiscover = false;
    $(function() {
      $('#foto').on('change', function() {
        const file = $(this).get(0).files[0];
        if (file) {
          const reader = new FileReader();
          console.log(file);

          reader.onload = function() {
            $('.img__preview .img-fluid').attr('src', reader.result);
          }

          reader.readAsDataURL(file);

          $('.img__preview').removeClass('d-none');
        }
      });

      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });


      let dropzone = new Dropzone('.dropzone', {
        url: "{{ route('upload_foto_kegiatan', $kegiatan->id) }}",
        autoProcessQueue: false,
        addRemoveLinks: true,
        maxFileSize: 3,
        paramName: 'image',
        acceptedFiles: 'image/*',
        removedfile: function(file) {
          let _ref;

          if (!file.id) {
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
              null;
          }

          $.ajax({
            type: 'DELETE',
            url: '{{ route('delete_foto_kegiatan', $kegiatan->id) }}',
            data: {
              foto_id: file.id,
              "_token": "{{ csrf_token() }}"
            }
          }).then(function() {
            Toast.fire({
              title: 'Image deleted',
              icon: 'success'
            })
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
              null;
          }).fail(function(jqXHR, textStatus, errorThrown) {
            Toast.fire({
              title: errorThrown,
              icon: 'error'
            })
          });
        },
        init: function() {
          let submitButton = $('button.btn-save')
          let myDropzone = this;

          let files = [
            @foreach ($kegiatan->fotoKegiatan as $image)
              { name: "{{ $image->filename }}", size: {{ $image->size }}, url: '{{ url($image->foto_url) }}', id:
              {{ $image->id }} } @if (!$loop->last) , @endif
            @endforeach
          ];

          $.each(files, function(index, file) {
            myDropzone.emit('addedfile', file)
            myDropzone.emit('thumbnail', file, file.url)
          })

          submitButton.on('click', function() {
            myDropzone.processQueue();
          });
          myDropzone.on('addedfile', function(file) {
            if (!file.type.match(/image.*/)) {
              myDropzone.removeFile(file)
              Toast.fire({
                title: 'Invalid image',
                icon: 'error'
              })
            }
          });
          myDropzone.on('complete', function(file) {
            Toast.fire({
              title: 'Image uploaded successfully',
              icon: 'success'
            })
            window.location.reload();
          });
        }
      });
    });
  </script>
@endpush
