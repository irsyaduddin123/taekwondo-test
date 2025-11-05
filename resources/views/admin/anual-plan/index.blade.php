@extends('layouts.main')

@section('page_title', 'Annual Plan')

@section('content')
<div class="container py-4">

    {{-- ================= HEADER FILTER ================= --}}
    <div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
        <div class="card-header text-white fw-semibold py-3"
             style="background: linear-gradient(90deg, #0d6efd, #4e9eff);">
            <i class="fas fa-calendar-alt me-2"></i> Pilih Annual Plan
        </div>

        <div class="card-body bg-light">
            <form method="GET" action="{{ route('annual-plan.index') }}" id="planForm">
                <div class="d-flex flex-wrap align-items-center gap-3">

                    {{-- Dropdown Tahun --}}
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <label for="plan_id" class="fw-semibold text-secondary mb-0 d-flex align-items-center">
                            <i class="fas fa-filter text-primary me-2"></i> Tahun Plan
                        </label>

                        <select name="plan_id" id="plan_id"
                            class="form-select border-0 shadow-sm rounded-pill px-4 py-2 bg-white text-secondary"
                            style="min-width: 140px; max-width: 180px; transition: all 0.3s;">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach($allPlans as $p)
                                <option value="{{ $p->id }}" {{ $selectedPlanId == $p->id ? 'selected' : '' }}>
                                    {{ $p->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <button type="submit"
                        class="btn btn-primary rounded-pill shadow-sm d-flex align-items-center gap-2 px-4 py-2"
                        style="transition: all 0.3s;">
                        <i class="fas fa-search"></i>
                        <span>Lihat</span>
                    </button> --}}
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    @if($plan)
    <div class="fade-in">

        {{-- Judul --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark">📅 Annual Plan - {{ $plan->tahun }}</h2>
            <hr class="mx-auto" style="width: 80px; height: 3px; background-color: #0d6efd; border: none;">
        </div>

        {{-- ================= DAFTAR EVENT ================= --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="fas fa-bullhorn me-2"></i> Daftar Events
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plan->events as $event)
                                <tr>
                                    <td>{{ $event->nama }}</td>
                                    <td>{{ $event->lokasi }}</td>
                                    <td>{{ $event->tanggal_mulai }} - {{ $event->tanggal_selesai }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada data event</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= PERIODIZATION ================= --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white fw-bold">
                <i class="fas fa-dumbbell me-2"></i> Periodization
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Minggu</th>
                                <th>Fase</th>
                                <th>Tahap</th>
                                <th>Load</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plan->microcycles as $mc)
                                <tr>
                                    <td>{{ $mc->minggu }}</td>
                                    <td>{{ $mc->fase }}</td>
                                    <td>{{ $mc->tahap }}</td>
                                    <td>{{ $mc->load }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data periodisasi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= GRAFIK PERIODISASI ================= --}}
        <div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
            <!-- HEADER -->
            <div class="card-header text-white fw-semibold py-3 px-4 d-flex flex-wrap justify-content-between align-items-center"
                style="background: linear-gradient(90deg, #0dcaf0, #17a2b8);">

                <div class="d-flex align-items-center mb-2 mb-sm-0">
                    <i class="fas fa-chart-line me-2 fs-5"></i>
                    <span class="fs-6 fw-bold">Grafik Periodisasi</span>
                </div>

                <!-- FILTER -->
<!-- FILTER AREA -->
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-3"> 
                    <div class="filter-item d-flex align-items-center bg-white rounded-pill px-3 py-1 shadow-sm me-2">
                        <label for="durationFilter" class="fw-semibold text-dark me-2 mb-0">
                            <i class="fas fa-hourglass-half text-info me-1"></i> Durasi:
                        </label>
                        <select id="durationFilter" class="form-select form-select-sm border-0 shadow-0 bg-transparent fw-semibold" style="width: auto;">
                            <option value="2">2 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="8">8 Bulan</option>
                            <option value="10">10 Bulan</option>
                            <option value="12" selected>12 Bulan</option>
                        </select>
                    </div>

                    <div class="filter-item d-flex align-items-center bg-white rounded-pill px-3 py-1 shadow-sm">
                        <label for="startMonth" class="fw-semibold text-dark me-2 mb-0">
                            <i class="fas fa-calendar-alt text-info me-1"></i> Mulai Bulan:
                        </label>
                        <select id="startMonth" class="form-select form-select-sm border-0 shadow-0 bg-transparent fw-semibold" style="width: auto;">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i-1 }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body p-4 bg-light">
                <canvas id="planChart" height="120"></canvas>
            </div>
        </div>


        {{-- ================= KOMPONEN BIOMOTOR ================= --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-warning fw-bold">
                <i class="fas fa-running me-2"></i> Komponen Biomotor
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Komponen</th>
                                <th>Fase</th>
                                <th>Minggu</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plan->biomotors as $bm)
                                <tr>
                                    <td>{{ $bm->komponen }}</td>
                                    <td>{{ $bm->fase }}</td>
                                    <td>{{ $bm->minggu }}</td>
                                    <td>{{ $bm->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data biomotor</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ================= KETERAMPILAN TEKNIK ================= --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-danger text-white fw-bold">
                <i class="fas fa-hand-sparkles me-2"></i> Komponen Keterampilan Teknik
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Komponen</th>
                                <th>Fase</th>
                                <th>Minggu</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plan->skills as $skill)
                                <tr>
                                    <td>{{ $skill->komponen }}</td>
                                    <td>{{ $skill->fase }}</td>
                                    <td>{{ $skill->minggu }}</td>
                                    <td>{{ $skill->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data keterampilan teknik</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @else
        <div class="alert alert-info text-center shadow-sm">
            <i class="fas fa-info-circle me-2"></i> Silakan pilih tahun plan terlebih dahulu.
        </div>
    @endif
</div>

<script>
document.getElementById('plan_id').addEventListener('change', function() {
    if (this.value) document.getElementById('planForm').submit();
});
</script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($plan)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('planChart').getContext('2d');

    // Data dari controller (per minggu)
    const labelsAll = @json($labels); // contoh: ['Minggu ke-1', 'Minggu ke-2', ...]
    const physPrepAll = @json($physPrep);
    const techPrepAll = @json($techPrep);
    const volumeAll = @json($volume);
    const intensityAll = @json($intensity);

    // Inisialisasi Chart
    const planChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelsAll,
            datasets: [
                { label: 'Phys Prep', data: physPrepAll, borderColor: '#0d6efd', borderWidth: 2, fill: false, tension: 0.3 },
                { label: 'Tech Prep', data: techPrepAll, borderColor: '#dc3545', borderDash: [5,5], borderWidth: 2, fill: false, tension: 0.3 },
                { label: 'Volume', data: volumeAll, borderColor: '#212529', borderDash: [10,5], borderWidth: 2, fill: false, tension: 0.3 },
                { label: 'Intensity', data: intensityAll, borderColor: '#198754', borderWidth: 2, fill: false, tension: 0.3 }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });

    // Event filter
    document.getElementById('durationFilter').addEventListener('change', updateChart);
    document.getElementById('startMonth').addEventListener('change', updateChart);

    function updateChart() {
        const durationMonths = parseInt(document.getElementById('durationFilter').value);
        const startMonth = parseInt(document.getElementById('startMonth').value);

        // Konversi bulan → minggu (1 bulan ≈ 4 minggu)
        const durationWeeks = durationMonths * 4;
        const startWeekIndex = startMonth * 4;
        const endWeekIndex = startWeekIndex + durationWeeks;

        // Ambil subset data sesuai range minggu
        const rangeLabels = labelsAll.slice(startWeekIndex, endWeekIndex);
        const physData = physPrepAll.slice(startWeekIndex, endWeekIndex);
        const techData = techPrepAll.slice(startWeekIndex, endWeekIndex);
        const volData = volumeAll.slice(startWeekIndex, endWeekIndex);
        const intData = intensityAll.slice(startWeekIndex, endWeekIndex);

        planChart.data.labels = rangeLabels;
        planChart.data.datasets[0].data = physData;
        planChart.data.datasets[1].data = techData;
        planChart.data.datasets[2].data = volData;
        planChart.data.datasets[3].data = intData;

        planChart.update();
    }

    // Set default awal
    updateChart();
});
</script>
@endif

<style>
.fade-in {
    animation: fadeIn 0.6s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
    border-color: #0d6efd;
    outline: none;
}
.btn-primary:hover {
    background-color: #0b5ed7 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(13,110,253,0.3);
}
.card {
    transition: box-shadow 0.3s ease-in-out;
}
.card:hover {
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}
.filter-item select:focus {
    box-shadow: none !important;
    background-color: #f8f9fa;
    border-radius: 20px;
}

.filter-item:hover {
    transform: translateY(-1px);
    transition: 0.2s ease;
}
@media(max-width: 768px){
    .filter-item{
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
