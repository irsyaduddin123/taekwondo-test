<!-- resources/views/user/main-user/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-light p-3">
                <div class="text-center">
                    <img id="profile-photo" 
                             class="profile-user-img img-fluid rounded-circle mb-3" width="120"
                             src="{{ Auth::check() && Auth::user()->profile_photo_url 
                                    ? asset('storage/' . Auth::user()->profile_photo_url) 
                                    : asset('adminlte/dist/img/user2-160x160.jpg') }}"
                             alt="User profile picture"
                             style="width:150px;height:150px;object-fit:cover;">
                    {{-- <img src="https://i.ibb.co/vsQvKH7/avatar.png" class="img-fluid rounded-circle mb-3" width="120"> --}}
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{route('dashboarduser')}}" class="btn btn-primary w-100">Grafik Perkembangan</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="btn btn-outline-primary w-100">Hasil Tes</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="btn btn-outline-primary w-100">Edit Profile</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </form>

                </ul>
            </div>

            <!-- Konten -->
            <div class="col-md-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')  
</body>
</html>
