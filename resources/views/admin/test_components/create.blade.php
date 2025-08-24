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
                <select class="form-control" id="jenisSelect" name="jenis_id" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach ($jenisList as $id => $nama)
                        <option value="{{ $id }}">{{ ucfirst($nama) }}</option>
                    @endforeach
                </select>
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
