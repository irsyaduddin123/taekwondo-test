<!-- resources/views/user/dashboard-user/index.blade.php -->
@extends('user.main-user.index')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card bg-gradient-warning text-black shadow">
            <div class="card-body">
                <h4 class="mb-1">Selamat datang, {{ Auth::user()->name }}!</h4>
                <p class="mb-0">Semoga harimu menyenangkan! Berikut perkembangan hasil tes kamu.</p>
            </div>
        </div>
    </div>
</div>

<!-- Presentase Fisik -->
<div class="card mb-4">
    <div class="card-header font-weight-bold">Presentase Fisik Keseluruhan</div>
    <div class="card-body text-center">
        <div class="d-flex justify-content-center flex-wrap gap-3 py-3">
            @foreach ($dataPersenFisikUser ?? [] as $index => $persen)
                @php
                    $warna = 'hsl(210, 80%, ' . (100 - $persen / 1.5) . '%)';
                @endphp
                <div class="text-center person-wrapper" title="Rata-rata skor: {{ $persen }}%">
                    <div class="person-container">
                        <div class="person-fill" style="height: {{ $persen }}%; background-color: {{ $warna }}"></div>
                        <div class="person-head"></div>
                    </div>
                    <strong>{{ $persen }}%</strong><br>
                    <small>{{ $userLabels[$index] ?? '' }}</small>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Grafik Tes Fisik -->
<div class="card mb-4">
    <div class="card-header font-weight-bold">Grafik Tes Fisik</div>
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard') }}" class="mb-3 d-flex gap-2 flex-wrap">
            <select name="komponen_fisik_id" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Komponen Fisik</option>
                @foreach ($komponenFisikUser as $komp)
                    <option value="{{ $komp->id }}" {{ request('komponen_fisik_id') == $komp->id ? 'selected' : '' }}>
                        {{ $komp->nama_komponen }}
                    </option>
                @endforeach
            </select>
        </form>
        <canvas id="chartFisikCombined" style="height: 300px;"></canvas>
    </div>
</div>

<!-- Grafik Tes Teknik -->
<div class="card mb-4">
    <div class="card-header font-weight-bold">Grafik Tes Teknik</div>
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard') }}" class="mb-3 d-flex gap-2 flex-wrap">
            <select name="komponen_teknik_id" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Komponen Teknik</option>
                @foreach ($komponenTeknikUser as $komp)
                    <option value="{{ $komp->id }}" {{ request('komponen_teknik_id') == $komp->id ? 'selected' : '' }}>
                        {{ $komp->nama_komponen }}
                    </option>
                @endforeach
            </select>
        </form>
        <canvas id="chartTeknikLine" style="height: 300px;"></canvas>
    </div>
</div>

<!-- Grafik Tes Mental -->
<div class="card mb-4">
    <div class="card-header font-weight-bold">Grafik Tes Mental</div>
    <div class="card-body">
        <canvas id="chartMentalLine" style="height: 300px;"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<style>
.person-wrapper { width: 60px; margin: 0 8px; position: relative; cursor: pointer; }
.person-container { position: relative; height: 100px; width: 40px; background-color: #e0e0e0; border: 2px solid #999; border-radius: 20px; overflow: hidden; margin: 0 auto 8px auto; }
.person-fill { position: absolute; bottom: 0; width: 100%; transition: height 0.4s ease, background-color 0.4s ease; }
.person-head { position: absolute; top: -22px; left: 50%; transform: translateX(-50%); width: 24px; height: 24px; background-color: #fff; border: 2px solid #999; border-radius: 50%; z-index: 2; }
.person-wrapper[title]:hover::after { content: attr(title); position: absolute; top: -32px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.75); color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 12px; white-space: nowrap; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labelsUser = @json($labelsUser);
const userDataFisik = @json($dataFisikUser);
const userDataTeknik = @json($dataTeknikUser);
const userDataMental = @json($dataMentalUser ?? []);
const dataPersenFisikUser = @json($dataPersenFisikUser);

// new Chart(document.getElementById('chartPersenFisik'), {
//     type: 'bar',
//     data: { labels, datasets: [{ label: 'Presentase Fisik (%)', data: dataPersenFisikUser, backgroundColor: 'rgba(30, 144, 255, 0.7)', borderRadius: 10, borderSkipped: false }] },
//     options: { plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => `${ctx.raw}%` } }, title: { display: true, text: 'Presentase Fisik per Bulan' } }, scales: { y: { beginAtZero: true, max: 100, ticks: { callback: value => value + '%' } } } }
// });


// Grafik Fisik Gabungan (Bar + Line)
new Chart(document.getElementById('chartFisikCombined'), {
    type: 'bar',
    data: {
        labels: labelsUser,
        datasets: [
            { type: 'bar', label: 'Tes Fisik - Batang', data: userDataFisik, backgroundColor: 'rgba(54, 162, 235, 0.5)', borderColor: 'rgba(54, 162, 235, 1)', borderWidth: 1 },
            { type: 'line', label: 'Tes Fisik - Garis', data: userDataFisik, borderColor: 'rgba(255, 99, 132, 1)', backgroundColor: 'rgba(255, 99, 132, 0.2)', fill: false, tension: 0.4 }
        ]
    },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Gabungan Tes Fisik (Line + Bar)' } }, scales: { y: { beginAtZero: true } } }
});

// Grafik Teknik
new Chart(document.getElementById('chartTeknikLine'), {
    type: 'line',
    data: { labels: labelsUser, datasets: [{ label: 'Tes Teknik', data: userDataTeknik, borderColor: 'rgba(75, 192, 192, 1)', backgroundColor: 'rgba(75, 192, 192, 0.2)', tension: 0.4, fill: false }] },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Garis Tes Teknik' } } }
});

// Grafik Mental
new Chart(document.getElementById('chartMentalLine'), {
    type: 'line',
    data: { labels: labelsUser, datasets: [{ label: 'Tes Mental', data: userDataMental, borderColor: 'rgba(153, 102, 255, 1)', backgroundColor: 'rgba(153, 102, 255, 0.2)', tension: 0.4, fill: false }] },
    options: { responsive: true, plugins: { title: { display: true, text: 'Diagram Garis Tes Mental' } } }
});
</script>
@endpush
