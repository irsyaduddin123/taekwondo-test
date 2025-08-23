<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <!-- Tombol toggle sidebar -->
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('dashboard') }}" class="nav-link">Beranda</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Search -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-search"></i>
      </a>
    </li>

    <!-- Notifications -->
    {{-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">3 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 1 pesan baru
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 2 permintaan
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
      </div>
    </li> --}}

    <!-- User Profile -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i> {{ Auth::user()->name ?? 'Guest' }}
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('profile') }}" class="dropdown-item">
          <i class="fas fa-cog mr-2"></i> Pengaturan
        </a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </form>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
