@extends('layouts.main')

@section('page_title', 'Edit Komponen Tes')

@section('header')
    <h1 class="h4">✏️ Edit Komponen Tes</h1>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('test_components.update', $testComponent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nama_komponen">Nama Komponen</label>
                <input type="text" name="nama_komponen" id="nama_komponen" class="form-control" value="{{ $testComponent->nama_komponen }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenisSelect" class="form-control" required>
                    @foreach ($jenisList as $jenis)
                        <option value="{{ $jenis }}" {{ $testComponent->jenis == $jenis ? 'selected' : '' }}>
                            {{ ucfirst($jenis) }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="d-flex justify-content-between">
                <a href="{{ route('test_components.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-sync-alt"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
