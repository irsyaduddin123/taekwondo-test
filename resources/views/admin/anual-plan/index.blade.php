@extends('layouts.main')

@section('page_title', 'Annual Plan')

@section('content')
<div class="container">
    <h2>Annual Plan - {{ $plan->tahun }}</h2>

    {{-- Bagian Event --}}
    <h4>Events</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plan->events as $event)
                <tr>
                    <td>{{ $event->nama }}</td>
                    <td>{{ $event->lokasi }}</td>
                    <td>{{ $event->tanggal_mulai }} - {{ $event->tanggal_selesai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Bagian Periodization --}}
    <h4>Periodization</h4>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Minggu</th>
                <th>Fase</th>
                <th>Tahap</th>
                <th>Load</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plan->microcycles as $mc)
                <tr>
                    <td>{{ $mc->minggu }}</td>
                    <td>{{ $mc->fase }}</td>
                    <td>{{ $mc->tahap }}</td>
                    <td>{{ $mc->load }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Grafik --}}
    <h4>Grafik</h4>
    <canvas id="planChart"></canvas>

    {{-- Bagian Biomotor --}}
    <h4 class="mt-4">Komponen Biomotor</h4>
    <table class="table table-striped">
        <thead>
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
                    <td colspan="4" class="text-center">Belum ada data biomotor</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Bagian Keterampilan Fisik --}}
    <h4 class="mt-4">Komponen Keterampilan Fisik</h4>
    <table class="table table-striped">
        <thead>
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
                    <td colspan="4" class="text-center">Belum ada data keterampilan fisik</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('planChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Phys Prep',
                data: @json($physPrep),
                borderColor: 'blue',
                borderWidth: 2,
                fill: false
            },
            {
                label: 'Tech Prep',
                data: @json($techPrep),
                borderColor: 'red',
                borderDash: [5,5],
                borderWidth: 2,
                fill: false
            },
            {
                label: 'Volume',
                data: @json($volume),
                borderColor: 'black',
                borderWidth: 2,
                borderDash: [10,5],
                fill: false
            },
            {
                label: 'Intensity',
                data: @json($intensity),
                borderColor: 'green',
                borderWidth: 2,
                fill: false
            }
        ]
    }
});
</script>
@endsection
