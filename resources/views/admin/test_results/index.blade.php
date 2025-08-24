@extends('layouts.main')

@section('page_title', 'Hasil Tes Atlet')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">📊 Hasil Tes Atlet</h1>
    <a href="{{ route('test_results.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Tambah Hasil Tes
    </a>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

{{-- FILTER --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row gy-2 gx-3 align-items-center">
            <div class="col-md-3">
                <input type="text" name="athlete" class="form-control" placeholder="Cari nama atlet..." value="{{ request('athlete') }}">
            </div>
            <div class="col-md-3">
                <select name="component_id" class="form-control">
                    <option value="">- Pilih Komponen -</option>
                    @foreach ($components as $c)
                        <option value="{{ $c->id }}" {{ request('component_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->nama_komponen }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="month" class="form-control">
                    <option value="">- Pilih Bulan -</option>
                    @foreach ($months as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('test_results.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- HASIL TES PER ATLET --}}
<div id="accordion">
    @forelse ($results->groupBy('athlete_id') as $athleteId => $groupedResults)
    <div class="card shadow-sm mb-3">
        <div class="card-header d-flex justify-content-between align-items-center" id="heading{{ $athleteId }}">
            <h5 class="mb-0">
                <button class="btn btn-link text-dark fw-bold collapsed" data-toggle="collapse" data-target="#collapse{{ $athleteId }}" aria-expanded="false" aria-controls="collapse{{ $athleteId }}">
                    🏅 {{ $groupedResults->first()->athlete->name }}
                </button>
            </h5>
        </div>

        <div id="collapse{{ $athleteId }}" class="collapse" aria-labelledby="heading{{ $athleteId }}" data-parent="#accordion">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Komponen Tes</th>
                                <th>Jenis</th>
                                <th>Nilai</th>
                                <th>Bulan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedResults as $index => $r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $r->testComponent->nama_komponen }}</td>
                                <td>
                                    {{-- <td>{{ $c->type->nama_jenis ?? '-' }}</td> --}}
                                    <span class="badge bg-{{ $r->testComponent->type->nama_jenis == 'fisik' ? 'primary' : 'warning' }}">
                                        {{ ucfirst($r->testComponent->type->nama_jenis) }}
                                    </span>
                                </td>
                                <td>{{ $r->score }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->test_date)->translatedFormat('F') }}</td>
                                <td>
                                    <form action="{{ route('test_results.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus hasil ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info">Belum ada hasil tes atlet.</div>
    @endforelse
</div>
@endsection
