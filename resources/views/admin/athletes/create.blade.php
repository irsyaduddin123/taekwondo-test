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
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="birthdate" class="form-control" required>
            </div>
            {{-- <div class="form-group">
                <label>Umur</label>
                <input type="number" name="age" class="form-control" required>
            </div> --}}
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
