@extends('layouts.main')

@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profil Card -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">
                    <div class="mb-3 position-relative d-inline-block">
                        <img id="profile-photo" 
                             class="profile-user-img img-fluid img-circle"
                             src="{{ Auth::check() && Auth::user()->profile_photo_url 
                                    ? asset('storage/' . Auth::user()->profile_photo_url) 
                                    : asset('adminlte/dist/img/user2-160x160.jpg') }}"
                             alt="User profile picture"
                             style="width:150px;height:150px;object-fit:cover;">

                        <!-- Tombol Pensil -->
                        <button type="button" class="btn btn-sm btn-primary position-absolute"
                                style="bottom: 0; right: 0; border-radius: 50%;"
                                data-toggle="modal" data-target="#editPhotoModal">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                    <h3 class="profile-username">{{ Auth::user()->name }}</h3>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profil</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', Auth::user()->email) }}"
                                   required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah.</small>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Foto -->
<div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="editPhotoModalLabel">Ubah Foto Profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <!-- Preview Foto -->
            <div class="mb-3">
                <img id="preview-photo" 
                    src="{{ Auth::check() && Auth::user()->profile_photo_url 
                            ? asset('storage/' . Auth::user()->profile_photo_url) 
                            : asset('adminlte/dist/img/user2-160x160.jpg') }}" 
                    alt="Preview Foto" 
                    class="img-fluid img-circle" 
                    style="width:150px;height:150px;object-fit:cover;">
            </div>

            <div class="form-group">
                <input type="file" name="photo" id="photoInput" class="form-control-file" accept="image/*" required>
                <small class="text-muted">Pilih foto JPG/PNG, maksimal 2MB.</small>
                <div id="photoError" class="text-danger mt-1" style="display:none;"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
const photoInput = document.getElementById('photoInput');
const previewPhoto = document.getElementById('preview-photo');
const profilePhoto = document.getElementById('profile-photo');
const originalSrc = previewPhoto.src;
const photoError = document.getElementById('photoError');

// Preview foto baru saat dipilih & validasi ukuran
photoInput.addEventListener('change', function(event) {
    photoError.style.display = 'none';
    if (event.target.files && event.target.files[0]) {
        const file = event.target.files[0];

        // Validasi ukuran file max 2MB
        if (file.size > 2 * 1024 * 1024) {
            photoError.textContent = 'Ukuran file tidak boleh lebih dari 2 MB.';
            photoError.style.display = 'block';
            photoInput.value = ""; // reset input
            previewPhoto.src = originalSrc; // reset preview
            return;
        }

        // Preview file
        let reader = new FileReader();
        reader.onload = function(e) {
            previewPhoto.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Reset preview saat modal ditutup
$('#editPhotoModal').on('hidden.bs.modal', function () {
    previewPhoto.src = originalSrc;
    photoInput.value = ""; // reset input file
    photoError.style.display = 'none';
});

// Setelah submit sukses, update foto utama
@if(session('success'))
    profilePhoto.src = previewPhoto.src;
@endif
</script>
@endpush
@endsection
