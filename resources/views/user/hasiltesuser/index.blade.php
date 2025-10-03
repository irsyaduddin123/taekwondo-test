@extends('user.main-user.index')

@section('page_title', 'Hasil Tes Saya')

@section('content')
<div class="container">
    <h3 class="mb-4">📊 Hasil Tes Saya</h3>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('user.hasiltes') }}" class="row g-3 align-items-end mb-4 bg-light p-3 rounded shadow-sm">
        <div class="col-md-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select name="bulan" id="bulan" class="form-select">
                <option value="">-- Semua Bulan --</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" id="tahun" class="form-select">
                <option value="">-- Semua Tahun --</option>
                @foreach($availableYears as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-flex">
            <button type="submit" class="btn btn-primary me-2">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            <a href="{{ route('user.hasiltes') }}" class="btn btn-secondary">
                <i class="fas fa-undo me-1"></i> Reset
            </a>
        </div>
    </form>

    @if($groupedResults->isEmpty())
        <div class="alert alert-info">
            Belum ada hasil tes yang tercatat.
        </div>
    @else
        @foreach($groupedResults as $type => $typeResults)
            <div class="mb-5">
                <h4 class="mb-3">
                    @if(strtolower($type) == 'fisik')
                        🏃‍♂️
                    @elseif(strtolower($type) == 'teknik')
                        🥋
                    @else
                        📌
                    @endif
                    {{ strtoupper($type) }}
                </h4>
                <div class="table-responsive shadow-sm rounded">
                    <table class="table align-middle text-center">
                        <thead style="background: linear-gradient(90deg, #4f46e5, #3b82f6); color: white;">
                            <tr>
                                <th>#</th>
                                <th>Komponen Tes</th>
                                <th>Nilai</th>
                                <th>Tanggal Tes</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($typeResults as $index => $result)
                                <tr class="hover-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">{{ $result->component_name }}</td>
                                    <td>
                                        @php
                                            $score = $result->score;
                                            $badgeClass = $score >= 80 ? 'success' : ($score >= 60 ? 'warning' : 'danger');
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }} px-3 py-2">{{ $score }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($result->test_date)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>

{{-- Custom Style --}}
<style>
    /* Efek hover pada row */
    .hover-row:hover {
        background-color: #f3f4f6 !important; /* abu-abu lembut */
        transition: 0.2s;
    }
    /* Supaya tabel lebih clean */
    table {
        border-radius: 10px;
        overflow: hidden;
    }
</style>
@endsection
