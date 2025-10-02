<div class="col-md-3 sidebar-custom p-3">
    <div class="text-center">
        <div class="position-relative d-inline-block">
            <img id="profile-photo" 
                class="profile-user-img img-fluid rounded-circle mb-3" width="150" height="150"
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
            <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark text-white">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="editPhotoModalLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img id="preview-photo" 
                                src="{{ Auth::check() && Auth::user()->profile_photo_url 
                                        ? asset('storage/' . Auth::user()->profile_photo_url) 
                                        : asset('adminlte/dist/img/user2-160x160.jpg') }}" 
                                alt="Preview Foto" 
                                class="img-fluid img-circle mb-3" 
                                style="width:150px;height:150px;object-fit:cover;">
                        </div>

                        <form id="updatePhotoForm" action="{{ route('user.updatePhoto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="profilePhoto" class="form-label">Pilih Foto Baru</label>
                                <input class="form-control" type="file" id="profilePhoto" name="photo" accept="image/*" required>
                                <small class="text-warning d-none" id="fileSizeError">⚠️ Ukuran file maksimal 2 MB!</small>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-2 text-white">{{ Auth::user()->name }}</h4>
        <p class="text-light">{{ Auth::user()->email }}</p>
    </div>

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
            <a href="{{ route('user.prestasi.index')}}" class="btn w-100 btn-outline-light">
                Prestasi Saya
            </a>
        </li>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </ul>
</div>

<script>
document.getElementById('profilePhoto').addEventListener('change', function(event) {
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