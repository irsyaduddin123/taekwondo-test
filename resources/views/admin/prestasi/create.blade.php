@extends('layouts.main')

@section('page_title', isset($athlete) ? 'Tambah Prestasi - ' . $athlete->name : 'Tambah Prestasi')

@section('content')
<div class="container">
    <h2 class="mb-4">
        Tambah Prestasi 
        @if(isset($athlete))
            untuk {{ $athlete->name }}
        @endif
    </h2>

    <form action="{{ route('hasil-prestasi.store') }}" method="POST">
        @csrf

        {{-- Jika dari halaman athlete tertentu --}}
        @if(isset($athlete))
            <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">
        @else
            <div class="form-group mb-3">
                <label>Pilih Atlet</label>
                <select name="athlete_id" class="form-control" required>
                    <option value="">-- Pilih Atlet --</option>
                    @foreach($athletes as $ath)
                        <option value="{{ $ath->id }}">{{ $ath->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group mb-3">
            <label>Nama Kejuaraan</label>
            <input type="text" name="nama_kejuaraan" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Kelas Pertandingan</label>
            <input type="text" name="kelas_pertandingan" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Hasil Pertandingan</label>
            <input type="text" name="hasil_pertandingan" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Evaluasi Pelatih</label>
            <textarea name="evaluasi_pelatih" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('hasil-prestasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
