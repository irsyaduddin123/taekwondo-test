<div class="col-md-3 sidebar-custom p-3">
    <div class="text-center">

        <!-- Tombol kembali -->
        <div class="text-start mb-3">
            <a href="{{ url('/') }}" class="btn btn-outline-light w-100">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Home
            </a>
        </div>

        <!-- Foto profil -->
        <div class="position-relative d-inline-block">
            <img id="profile-photo" 
                class="profile-user-img img-fluid rounded-circle mb-3"
                src="{{ Auth::check() && Auth::user()->profile_photo_url 
                        ? asset('storage/' . Auth::user()->profile_photo_url) 
                        : asset('adminlte/dist/img/user2-160x160.jpg') }}"
                alt="User profile picture"
                style="width:150px;height:150px;object-fit:cover;">

            <!-- Tombol edit foto -->
            <button type="button" 
                    class="btn btn-sm btn-primary position-absolute"
                    style="bottom: 10px; right: 10px; border-radius: 50%; padding: 6px 8px;"
                    data-bs-toggle="modal" data-bs-target="#editPhotoModal">
                <i class="fas fa-pencil-alt"></i>
            </button>
        </div>

        <!-- Nama & email -->
        <h4 class="mt-2 text-white">{{ Auth::user()->name }}</h4>
        <p class="text-light">{{ Auth::user()->email }}</p>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav flex-column mt-3">
        <li class="nav-item mb-2">
            <a href="{{ route('dashboarduser') }}" 
               class="btn w-100 {{ Route::is('dashboarduser') ? 'btn-light text-primary' : 'btn-outline-light' }}">
                Grafik Perkembangan
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('user.hasiltes') }}" 
               class="btn w-100 {{ Route::is('user.hasiltes') ? 'btn-light text-primary' : 'btn-outline-light' }}">
                Hasil Tes
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('user.prestasi.index')}}" 
               class="btn w-100 {{ Route::is('user.prestasi.index') ? 'btn-light text-primary' : 'btn-outline-light' }}">
                Prestasi Saya
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- Modal Edit Foto -->
<div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editPhotoModalLabel">Update Foto Profil</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form id="updatePhotoForm" method="POST" action="{{ route('user.updatePhoto') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-body text-center">

                    <!-- Preview foto -->
                    <img id="preview-photo"
                         src="{{ Auth::check() && Auth::user()->profile_photo_url 
                                ? asset('storage/' . Auth::user()->profile_photo_url) 
                                : asset('adminlte/dist/img/user2-160x160.jpg') }}"
                         class="rounded-circle mb-3"
                         style="width:150px; height:150px; object-fit:cover;">

                    <!-- Input file -->
                    <input type="file" 
                           class="form-control mt-2" 
                           id="profile-photo" 
                           name="profile_photo" 
                           accept="image/*">

                    <!-- Error ukuran file -->
                    <small id="fileSizeError" class="text-danger d-none">
                        Maksimal ukuran file 2MB.
                    </small>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>



<script>
document.getElementById('profile-photo').addEventListener('change', function(event) {
    const fileInput = event.target;
    const previewImg = document.getElementById('preview-photo');
    const errorMsg = document.getElementById('fileSizeError');
    const file = fileInput.files[0];
    const maxSize = 2 * 1024 * 1024; // 2 MB

    if (file) {
        if (file.size > maxSize) {
            errorMsg.classList.remove('d-none');
            fileInput.value = ""; // reset input
            previewImg.src = "{{ asset('adminlte/dist/img/user2-160x160.jpg') }}"; // fallback gambar default
        } else {
            errorMsg.classList.add('d-none');
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
});

document.getElementById('updatePhotoForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('profilePhoto');
    const errorMsg = document.getElementById('fileSizeError');
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (file.size > 2 * 1024 * 1024) {
            e.preventDefault();
            errorMsg.classList.remove('d-none');
            fileInput.value = "";
        }
    }
});
</script>