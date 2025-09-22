@extends('layouts.main')
@section('content')
<div class="container">
    <h3>{{ $plan->nama_plan }} ({{ $plan->tahun }})</h3>
    <a href="{{ route('microcycles.create') }}" class="btn btn-primary mb-3">Tambah Microcycle</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Minggu</th>
                <th>Load</th>
                <th>Volume</th>
                <th>Intensity</th>
                <th>Peaking</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plan->microcycles as $m)
            <tr>
                <td>{{ $m->week }}</td>
                <td>{{ $m->load }}</td>
                <td>{{ $m->volume }}</td>
                <td>{{ $m->intensity }}</td>
                <td>{{ $m->peaking }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <canvas id="periodizationChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('periodizationChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($plan->microcycles->pluck('week')),
        datasets: [
            { label: 'Volume', data: @json($plan->microcycles->pluck('volume')), borderColor: 'red', fill: false },
            { label: 'Intensity', data: @json($plan->microcycles->pluck('intensity')), borderColor: 'blue', fill: false },
            { label: 'Peaking', data: @json($plan->microcycles->pluck('peaking')), borderColor: 'black', borderDash: [5,5], fill: false },
        ]
    }
});
</script>
@endsection
