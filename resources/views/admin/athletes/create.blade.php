@extends('layouts.main')

@section('page_title', 'Tambah Atlet')

@section('header')
<h1>Tambah Atlet</h1>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('athletes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <!-- INPUT TANGGAL (SUDAH FLATPICKR) -->
            <div class="form-group">
                <label for="birthdate">Tanggal Lahir</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text"
                           name="birthdate"
                           id="birthdate"
                           class="form-control"
                           placeholder="Pilih tanggal..."
                           required>
                </div>
            </div>

            <div class="form-group">
                <label>Tinggi (cm)</label>
                <input type="number" name="height" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Berat (kg)</label>
                <input type="number" name="weight" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('athletes.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
flatpickr("#birthdate", {
    dateFormat: "Y-m-d",         // Format untuk disimpan ke database
    altInput: true,
    altFormat: "d F Y",          // Tampilan cantik (contoh: 11 Desember 2025)
    allowInput: true,
    maxDate: "today"             // Tidak boleh lebih dari hari ini
});
</script>
@endpush
