@extends('layouts.app')

@section('title')
  Tambah Pengurus
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Tambah Pengurus</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('penguruses.index') }}">Pengurus</a></li>
        <li class="breadcrumb-item active">Tambah Pengurus</li>
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
            <h3 class="card-title">Tambah Pengurus</h3>
          </div>
          <form action="{{ route('penguruses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nama">Nama <code>*</code></label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="nama_panggilan">Nama Panggilan <code>*</code></label>
                  <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan"
                    value="{{ old('nama_panggilan') }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="posisi_id">Posisi <code>*</code></label>
                  <select name="posisi_id" id="posisi_id" class="form-control">
                    <option selected disabled hidden>--Pilih Posisi--</option>
                    @foreach ($posisi as $id => $nama)
                      <option {{ old('posisi_id') == $id ? 'selected' : '' }} value="{{ $id }}">
                        {{ $nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="jenis_kelamin">Jenis Kelamin <code>*</code></label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option selected hidden disabled>--Pilih Jenis Kelamin--</option>
                    <option {{ old('jenis_kelamin') === 'l' ? 'selected' : '' }} value="l">Laki-Laki</option>
                    <option {{ old('jenis_kelamin') === 'p' ? 'selected' : '' }} value="p">Perempuan</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="no_hp">No. Hp/WhatsApp</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+62</span>
                    </div>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                      value="{{ old('no_hp') }}">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="foto">Foto Profil</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg, .jpeg, .png">
                    <label class="custom-file-label" for="foto">Choose file</label>
                  </div>
                  <small class="form-text text-muted">Ukuran maksimal 1MB, format: JPG,JPEG atau PNG</small>
                  <div class="img__preview p-1 border mt-3 d-none">
                    <img class="img-fluid w-100">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
              </div>

              <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection

@push('scripts')
  <script>
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
    });
  </script>
@endpush
