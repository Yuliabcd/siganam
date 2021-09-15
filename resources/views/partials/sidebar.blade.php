@php
$user = auth()->user();
@endphp
<!-- Brand Logo -->
<a href="{{ route('home') }}" class="brand-link">
  <img src="{{ asset('assets/image/pkk.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
  <span class="brand-text font-weight-light">Siganam</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ $user->foto_url }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="{{ route('profile') }}" class="d-block">{{ $user->name }}</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">MENU UTAMA</li>
      @role('admin')
      <li class="nav-item">
        <a href="{{ route('users.index') }}"
          class="nav-link {{ request()->routeIs('users.index') || request()->is('users/*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users-cog"></i>
          <p>Pengguna</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('penguruses.index') }}"
          class="nav-link {{ request()->routeIs('penguruses.index') || request()->is('penguruses/*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Pengurus</p>
        </a>
      </li>
      @endrole
      <li class="nav-item">
        <a href="{{ route('kegiatan.index') }}"
          class="nav-link {{ request()->routeIs('kegiatan.index') || request()->is('kegiatan/*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>Kegiatan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('laporan.index') }}"
          class="nav-link {{ request()->routeIs('laporan.index') || request()->is('laporan/*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-book"></i>
          <p>Laporan</p>
        </a>
      </li>
      <li class="nav-header">AKUN</li>
      <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-alt"></i>
          <p>Profil</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('password') }}" class="nav-link {{ request()->routeIs('password') ? 'active' : '' }}">
          <i class="nav-icon fas fa-lock"></i>
          <p>Ubah Password</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link btn__logout">
          <i class="nav-icon far fa-circle text-danger"></i>
          <p class="text">Logout</p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
