<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <span class="brand-text font-weight-light ml-2">Laravel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    
<img 
    src="{{ Auth::check() && Auth::user()->profile_photo_url 
            ? asset('storage/' . Auth::user()->profile_photo_url) 
            : asset('adminlte/dist/img/user2-160x160.jpg') }}" 
    class="img-circle elevation-2" 
    alt="User Image" 
    style="width:40px;height:40px;object-fit:cover;">
  </div>
  <div class="info">
    <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->name ?? 'Guest' }}</a>
  </div>
</div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('athletes.index') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Athlete</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('test_components.index') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Komponen Test</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('test_results.index') }}" class="nav-link">
            <i class="nav-icon fas fa-poll"></i>
            <p>Hasil Tes Atlet</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('admin.pengguna') }}" class="nav-link">
            <i class="nav-icon fas fa-poll"></i>
            <p>Pengguna</p>
          </a>
        </li>

        <!-- Annual Plan Dropdown -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                  Annual Plan
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lihat Annual Plan</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kelola Annual Plan</p>
                  </a>
              </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
