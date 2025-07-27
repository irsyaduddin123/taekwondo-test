@extends('layouts.main')

@section('page_title', 'Tambah Hasil Tes')

@section('header')
<h1 class="h3 mb-3">📝 Tambah Hasil Tes Atlet</h1>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('test_results.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="athlete_id">Atlet</label>
                <select name="athlete_id" id="athlete_id" class="form-control @error('athlete_id') is-invalid @enderror">
                    <option value="">-- Pilih Atlet --</option>
                    @foreach ($athletes as $a)
                        <option value="{{ $a->id }}" {{ old('athlete_id') == $a->id ? 'selected' : '' }}>
                            {{ $a->name }}
                        </option>
                    @endforeach
                </select>
                @error('athlete_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="test_component_id">Komponen Tes</label>
                <select name="test_component_id" id="test_component_id" class="form-control @error('test_component_id') is-invalid @enderror">
                    <option value="">-- Pilih Komponen --</option>
                    @foreach ($components as $c)
                        <option value="{{ $c->id }}" {{ old('test_component_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->nama_komponen }} ({{ ucfirst($c->jenis) }})
                        </option>
                    @endforeach
                </select>
                @error('test_component_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="nilai">Nilai / Skor</label>
                <input type="number" name="nilai" id="nilai" class="form-control" required min="0" value="{{ old('nilai', $result->score ?? '') }}">
            </div>

            <div class="form-group">
                <label for="test_date">Tanggal Tes</label>
                <input type="date" name="test_date" id="test_date" class="form-control" required value="{{ old('test_date', date('Y-m-d')) }}">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('test_results.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
