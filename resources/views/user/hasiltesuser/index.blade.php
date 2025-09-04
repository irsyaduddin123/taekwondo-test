@extends('user.main-user.index')

@section('page_title', 'Hasil Tes Saya')

@section('content')
<div class="container">
    <h3 class="mb-4">📊 Hasil Tes Saya</h3>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('user.hasiltes') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select name="bulan" id="bulan" class="form-select">
                <option value="">--semua bulan--</option>
                @for ($m =1; $m <= 12; $m++)
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
            <button type="submit" class="btn btn-primary me-2">FILTER</button>
            <a href="{{route('user.hasiltes')}}" class="btn btn-secondary me-2">RESET</a>
        </div>
    </form>

    @if($groupedResults->isEmpty())
        <div class="alert alert-info">
            Belum ada hasil tes yang tercatat.
        </div>
    @else
        @foreach($groupedResults as $type => $typeResults)
            <div class="mb-5">
                <h4 class="mb-3">{{ ucfirst($type) }}</h4>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Komponen Tes</th>
                            <th>Nilai</th>
                            <th>Tanggal Tes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($typeResults as $index => $result)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $result->component_name }}</td>
                                <td>{{ $result->score }}</td>
                                <td>{{ \Carbon\Carbon::parse($result->test_date)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
@endsection
