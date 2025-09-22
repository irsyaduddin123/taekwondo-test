@extends('layouts.main')
@section('content')
<div class="container">
    <h3>Tambah Microcycle</h3>
    <form action="{{ route('microcycles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Plan</label>
            <select name="plan_id" class="form-control">
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nama_plan }} ({{ $plan->tahun }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Minggu ke-</label>
            <input type="number" name="week" class="form-control" required>
        </div>
        <div class="mb-3"><label>Load</label><input type="number" name="load" class="form-control"></div>
        <div class="mb-3"><label>Volume</label><input type="number" name="volume" class="form-control"></div>
        <div class="mb-3"><label>Intensity</label><input type="number" name="intensity" class="form-control"></div>
        <div class="mb-3"><label>Peaking</label><input type="number" name="peaking" class="form-control"></div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
