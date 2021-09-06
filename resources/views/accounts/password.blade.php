@extends('layouts.app')

@section('title')
  Ubah Password
@endsection

@section('page-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Ubah Password</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
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
            <h3 class="card-title">Ubah Password</h3>
          </div>
          <form action="{{ route('update_password') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group row">
                <label for="current_password" class="col-sm-2 col-form-label">Password Sekarang <code>*</code></label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password Baru <code>*</code></label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password">
                </div>
              </div>
              <div class="form-group row">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password Baru
                  <code>*</code></label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
              </div>
              <div class="form-group mt-3">
                <button type="submit" class="btn btn-block btn-primary">Ubah Password</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
@endsection
