@extends('layouts.app')

@section('title')
  Detail Pengguna
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Detail Pengguna</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Detail Pengguna</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Pengguna</h3>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"
                  readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" value="{{ $user->role }}" class="form-control" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="no_hp">No. Hp/WhatsApp</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">+62</span>
                  </div>
                  <input type="tel" class="form-control" id="no_hp" name="no_hp" maxlength="15"
                    value="{{ $user->no_hp }}" readonly>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat }}"
                  readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="foto">Foto Profil</label>
                <div class="img__preview p-1 border">
                  <img src="{{ $user->foto_url }}" alt="{{ $user->name }}" class="img-fluid w-100">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection
