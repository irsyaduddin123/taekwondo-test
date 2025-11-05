<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: #fff;">
  <!-- Brand Logo -->
  <a href="/" class="brand-link d-flex align-items-center p-3">
    <span class="brand-text font-weight-bold ml-2" style="font-size:1.2rem; color:#fff;">Aplikasi Taekwondo</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center p-2 rounded shadow-sm" style="background: rgba(255,255,255,0.1);">
      <div class="image">
        <img 
          src="{{ Auth::check() && Auth::user()->profile_photo_url 
                  ? asset('storage/' . Auth::user()->profile_photo_url) 
                  : asset('adminlte/dist/img/user2-160x160.jpg') }}" 
          class="img-circle elevation-2" 
          alt="User Image" 
          style="width:45px;height:45px;object-fit:cover; border:2px solid #fff;">
      </div>
      <div class="info ml-2">
        <a href="{{ route('profile') }}" class="d-block font-weight-medium" style="color:#fff;">
          {{ Auth::user()->name ?? 'Guest' }}
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link" style="transition:0.3s;">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Athlete Menu -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link" style="transition:0.3s;">
            <i class="nav-icon fas fa-medal"></i>
            <p>
              Athlete
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="background: rgba(255,255,255,0.05); border-radius:0.5rem; padding-left:0.5rem;">
            <li class="nav-item">
              <a href="{{ route('athletes.index') }}" class="nav-link">
                <i class="fas fa-running nav-icon"></i>
                <p>Daftar Athlete</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('hasil-prestasi.index') }}" class="nav-link">
                <i class="fas fa-trophy nav-icon"></i>
                <p>Prestasi Athlete</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Komponen Test -->
        <li class="nav-item">
          <a href="{{ route('test_components.index') }}" class="nav-link" style="transition:0.3s;">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Komponen Test</p>
          </a>
        </li>

        <!-- Hasil Tes Atlet -->
        <li class="nav-item">
          <a href="{{ route('test_results.index') }}" class="nav-link" style="transition:0.3s;">
            <i class="nav-icon fas fa-poll"></i>
            <p>Hasil Tes Atlet</p>
          </a>
        </li>



        <!-- Annual Plan -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link" style="transition:0.3s;">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Annual Plan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="background: rgba(255,255,255,0.05); border-radius:0.5rem; padding-left:0.5rem;">
            <li class="nav-item">
              <a href="{{ route('annual-plan.index') }}" class="nav-link">
                <i class="fas fa-calendar-week nav-icon"></i>
                <p>Lihat Annual Plan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('events.index') }}" class="nav-link">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Kelola Event</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('microcycles.index') }}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>Kelola Grafik</p>
              </a>
            </li>
          </ul>
        </li>
        @if(Auth::user()->isAdmin())
            <!-- menu admin -->
                    <!-- Pengguna -->
          <li class="nav-item">
            <a href="{{ route('admin.pengguna') }}" class="nav-link" style="transition:0.3s;">
              <i class="nav-icon fas fa-users"></i>
              <p>Pengguna</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.pengguna') }}" class="nav-link" style="transition:0.3s;">
              <i class="nav-icon fas fa-users"></i>
              <p>Pengguna</p>
            </a>
          </li>
        @endif

      </ul>
    </nav>
  </div>
</aside>

<!-- CSS tambahan untuk hover & active -->
<style>
  .nav-sidebar .nav-link {
    color: #fff; /* teks putih agar terlihat */
  }
  .nav-sidebar .nav-link:hover {
    background: rgba(255,255,255,0.2);
    border-radius: 0.5rem;
    transition: background 0.3s;
    color: #fff;
  }
  .nav-sidebar .nav-link.active {
    background: rgba(255,165,0,0.3); /* orange lembut */
    border-radius: 0.5rem;
    color: #fff !important;
  }
  .nav-sidebar .nav-icon {
    color: #ffd700; /* gold icon */
    transition: transform 0.3s;
  }
  .nav-sidebar .nav-link:hover .nav-icon {
    transform: rotate(15deg) scale(1.1);
  }
</style>
