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

                    {{-- Tombol Lihat --}}
                    <button type="submit"
                        class="btn btn-primary rounded-pill shadow-sm d-flex align-items-center gap-2 px-4 py-2"
                        style="transition: all 0.3s;">
                        <i class="fas fa-search"></i>
                        <span>Lihat</span>
                    </button>
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
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-info text-white fw-bold">
                <i class="fas fa-chart-line me-2"></i> Grafik Periodisasi
            </div>
            <div class="card-body">
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

{{-- ================= SCRIPT ================= --}}
<script>
document.getElementById('plan_id').addEventListener('change', function() {
    if (this.value) document.getElementById('planForm').submit();
});
</script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($plan)
<script>
const ctx = document.getElementById('planChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            { label: 'Phys Prep', data: @json($physPrep), borderColor: '#0d6efd', borderWidth: 2, fill: false, tension: 0.3 },
            { label: 'Tech Prep', data: @json($techPrep), borderColor: '#dc3545', borderDash: [5,5], borderWidth: 2, fill: false, tension: 0.3 },
            { label: 'Volume', data: @json($volume), borderColor: '#212529', borderDash: [10,5], borderWidth: 2, fill: false, tension: 0.3 },
            { label: 'Intensity', data: @json($intensity), borderColor: '#198754', borderWidth: 2, fill: false, tension: 0.3 }
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
</script>
@endif

{{-- ================= STYLE ================= --}}
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
</style>
@endsection
