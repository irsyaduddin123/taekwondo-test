@extends('layouts.main')

@section('page_title', 'Dashboard')

@section('header')
<div class="row mb-4">
    <div class="col">
        <h1 class="h3">Dashboard</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card bg-gradient-warning text-white shadow">
            <div class="card-body">
                <h4 class="mb-1">Selamat datang, {{ Auth::user()->name }}!</h4>
                <p class="mb-0">Semoga harimu menyenangkan! Kelola data atlet dan hasil tes mereka dengan mudah di sini.</p>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    @php
        $infoCards = [
            ['title' => 'Jumlah Atlet', 'value' => $jumlahAtlet ?? 0, 'icon' => 'users', 'color' => 'primary'],
            ['title' => 'Tes Fisik', 'value' => $tesFisik ?? 0, 'icon' => 'dumbbell', 'color' => 'success'],
            ['title' => 'Tes Teknik', 'value' => $tesTeknik ?? 0, 'icon' => 'running', 'color' => 'info'],
            ['title' => 'Tes Mental', 'value' => $tesMental ?? 0, 'icon' => 'brain', 'color' => 'info']
        ];
    @endphp

    @foreach($infoCards as $card)
    <div class="col-md-4 mb-4">
        <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">{{ $card['title'] }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $card['value'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-{{ $card['icon'] }} fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Presentase Fisik -->
<div class="card mb-4">
    <div class="card-header font-weight-bold">Presentase Fisik Keseluruhan</div>
    <div class="card-body text-center {{ request('athlete_id') ? '' : 'text-muted py-5' }}">
        @if (request('athlete_id'))
            <div class="d-flex justify-content-center flex-wrap gap-3 py-3">
                @foreach ($dataPersenFisik as $index => $persen)
                    @php
                        $warna = 'hsl(210, 80%, ' . (100 - $persen / 1.5) . '%)';
                    @endphp
                    <div class="text-center person-wrapper" title="Rata-rata skor: {{ $persen }}%">
                        <div class="person-container">
                            <div class="person-fill" style="height: {{ $persen }}%; background-color: {{ $warna }}"></div>
                            <div class="person-head"></div>
                        </div>
                        <strong>{{ $persen }}%</strong><br>
                        <small>{{ $labels[$index] }}</small>
                    </div>
                @endforeach
            </div>
        @else
            <i class="fas fa-info-circle fa-2x mb-2"></i><br>
            <strong>Silakan pilih nama atlet untuk menampilkan grafik presentase fisik keseluruhan.</strong>
        @endif
    </div>
</div>

<!-- Filter Form -->
<form method="GET" action="{{ route('dashboard') }}" class="row mb-4">
    <!-- Filter Atlet -->
    <div class="col-md-6">
        <label for="athlete">Pilih Atlet:</label>
        <select name="athlete_id" id="athlete" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Atlet</option>
            @foreach ($semuaAtlet as $atlet)
                <option value="{{ $atlet->id }}" {{ request('athlete_id') == $atlet->id ? 'selected' : '' }}>
                    {{ $atlet->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Filter Komponen Fisik -->
    <div class="col-md-6">
        <label for="komponen_fisik_id"><strong>Komponen Fisik:</strong></label>
        <select name="komponen_fisik_id" id="komponen_fisik_id" class="form-control" onchange="this.form.submit()">
            <option value="">Semua Komponen Fisik</option>
            @foreach ($komponenFisik as $komp)
                <option value="{{ $komp->id }}" {{ request('komponen_fisik_id') == $komp->id ? 'selected' : '' }}>
                    {{ $komp->nama_komponen }}
                </option>
            @endforeach
        </select>
    </div>
</form>

<!-- Grafik Tes -->
@php
    $charts = [
        ['id' => 'chartFisikCombined', 'title' => 'Grafik Tes Fisik'],
        ['id' => 'chartTeknikLine', 'title' => 'Grafik Tes Teknik'],
        ['id' => 'chartMentalLine', 'title' => 'Grafik Tes Mental'],
    ];
@endphp

@foreach($charts as $chart)
<div class="card mb-4">
    <div class="card-header font-weight-bold">{{ $chart['title'] }}</div>
    <div class="card-body">
        <canvas id="{{ $chart['id'] }}" style="height: 300px;"></canvas>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<style>
.person-wrapper {
    width: 60px;
    margin: 0 8px;
    position: relative;
    cursor: pointer;
}
.person-container {
    position: relative;
    height: 100px;
    width: 40px;
    background-color: #e0e0e0;
    border: 2px solid #999;
    border-radius: 20px;
    overflow: hidden;
    margin: 0 auto 8px auto;
}
.person-fill {
    position: absolute;
    bottom: 0;
    width: 100%;
    transition: height 0.4s ease, background-color 0.4s ease;
}
.person-head {
    position: absolute;
    top: -22px;
    left: 50%;
    transform: translateX(-50%);
    width: 24px;
    height: 24px;
    background-color: #fff;
    border: 2px solid #999;
    border-radius: 50%;
    z-index: 2;
}
.person-wrapper[title]:hover::after {
    content: attr(title);
    position: absolute;
    top: -32px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.75);
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($labels);
const dataFisik = @json($dataFisik);
const dataTeknik = @json($dataTeknik);
const dataMental = @json($dataMental ?? []);
const dataPersenFisik = @json($dataPersenFisik);

// Grafik Presentase Fisik
new Chart(document.getElementById('chartPersenFisik'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Presentase Fisik (%)', data: dataPersenFisik, backgroundColor: 'rgba(30, 144, 255, 0.7)', borderRadius: 10, borderSkipped: false }] },
    options: {
        plugins: {
            legend: { display: false },
            tooltip: { callbacks: { label: ctx => `${ctx.raw}%` } },
            title: { display: true, text: 'Presentase Fisik per Bulan' }
        },
        scales: { y: { beginAtZero: true, max: 100, ticks: { callback: value => value + '%' } } }
    }
});

// Grafik Fisik Gabungan (Bar + Line)
new Chart(document.getElementById('chartFisikCombined'), {
    type: 'bar',
    data: {
        labels,
        datasets: [
            { type: 'bar', label: 'Tes Fisik - Batang', data: dataFisik, backgroundColor: 'rgba(54, 162, 235, 0.5)', borderColor: 'rgba(54, 162, 235, 1)', borderWidth: 1 },
            { type: 'line', label: 'Tes Fisik - Garis', data: dataFisik, borderColor: 'rgba(255, 99, 132, 1)', backgroundColor: 'rgba(255, 99, 132, 0.2)', fill: false, tension: 0.4 }
        ]
    },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Gabungan Tes Fisik (Line + Bar)' } }, scales: { y: { beginAtZero: true } } }
});

// Grafik Teknik
new Chart(document.getElementById('chartTeknikLine'), {
    type: 'line',
    data: { labels, datasets: [{ label: 'Tes Teknik - Garis', data: dataTeknik, borderColor: 'rgba(75, 192, 192, 1)', backgroundColor: 'rgba(75, 192, 192, 0.2)', tension: 0.4, fill: false }] },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Garis Tes Teknik' } } }
});

// Grafik Mental
new Chart(document.getElementById('chartMentalLine'), {
    type: 'line',
    data: { labels, datasets: [{ label: 'Tes Mental - Garis', data: dataMental, borderColor: 'rgba(75, 192, 192, 1)', backgroundColor: 'rgba(75, 192, 192, 0.2)', tension: 0.4, fill: false }] },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Garis Tes Mental' } } }
});
</script>
@endpush
