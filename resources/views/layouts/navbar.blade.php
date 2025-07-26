<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Beranda</a>
    </li>
  </ul>

  <!-- Right navbar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-user"></i> {{ Auth::user()->name ?? 'Guest' }}
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
