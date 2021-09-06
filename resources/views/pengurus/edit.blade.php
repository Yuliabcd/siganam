@extends('layouts.app')

@section('title')
  Edit Pengguna
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Edit Pengguna</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Edit Pengguna</li>
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
            <h3 class="card-title">Edit Pengguna</h3>
          </div>
          <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Nama <code>*</code></label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="username">Username <code>*</code></label>
                  <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="role">Role <code>*</code></label>
                  <select name="role_id" id="role" class="form-control">
                    <option selected disabled hidden>--Pilih Role--</option>
                    @foreach ($roles as $id => $role)
                      <option {{ $user->hasAnyRole($id) ? 'selected' : '' }} value="{{ $id }}">
                        {{ $role }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email <code>*</code></label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="password">Password <code>*</code></label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group col-md-6">
                  <label for="no_hp">No. Hp/WhatsApp</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+62</span>
                    </div>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                      value="{{ $user->no_hp }}">
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
                  <div class="img__preview p-1 border mt-3">
                    <img src="{{ $user->foto_url }}" alt="{{ $user->name }}" class="img-fluid w-100">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat }}">
                </div>
              </div>

              <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
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
