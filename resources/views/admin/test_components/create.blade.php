@extends('layouts.main')

@section('page_title', 'Tambah Komponen Tes')

@section('header')
    <h1 class="h4">➕ Tambah Komponen Tes</h1>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('test_components.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="nama_komponen">Nama Komponen</label>
                <input type="text" name="nama_komponen" id="nama_komponen" class="form-control" required>
            </div>

           <div class="form-group mb-3">
                <label for="jenis">Jenis Komponen</label>
                <select class="form-control" id="jenisSelect" name="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach ($jenisList as $jenis)
                        <option value="{{ $jenis }}">{{ ucfirst($jenis) }}</option>
                    @endforeach
                    <option value="lainnya">-- Tambah Jenis Baru --</option>
                </select>

                <input type="text" id="jenisBaru" name="jenis_baru" class="form-control mt-2 d-none" placeholder="Masukkan jenis baru">
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('test_components.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const jenisSelect = document.getElementById("jenisSelect");
    const jenisBaruInput = document.getElementById("jenisBaru");

    jenisSelect.addEventListener("change", function () {
        if (this.value === "lainnya") {
            jenisBaruInput.classList.remove("d-none");
            jenisBaruInput.required = true;
        } else {
            jenisBaruInput.classList.add("d-none");
            jenisBaruInput.required = false;
        }
    });
});
</script>
@endpush

