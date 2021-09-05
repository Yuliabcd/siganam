@extends('layouts.auth')

@section('content')
  <p class="login-box-msg">Sign in to start your session</p>

  <form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
      <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username/Email"
        name="username" required autofocus autocomplete="username">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
        name="password" required autocomplete="current-password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="row">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember">
            Ingat saya
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <!-- /.social-auth-links -->

  <p class="mb-1">
    @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}"> forgot my password</a>
    @endif
  </p>
  <p class="mb-0">
    @if (Route::has('register'))
      <a href="{{ 'register' }}" class="text-center">Register a new membership</a>
    @endif
  </p>
@endsection
