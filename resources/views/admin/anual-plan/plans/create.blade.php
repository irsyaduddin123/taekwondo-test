@extends('layouts.main')
@section('content')
<div class="container">
    <h3>Buat Plan Baru</h3>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Plan</label>
            <input type="text" name="nama_plan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
