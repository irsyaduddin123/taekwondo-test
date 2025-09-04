@extends('user.main-user.index')

@section('page_title', 'Hasil Tes Saya')

@section('content')
<div class="container">
    <h3 class="mb-4">📊 Hasil Tes Saya</h3>

    @if($results->isEmpty())
        <div class="alert alert-info">
            Belum ada hasil tes yang tercatat.
        </div>
    @else
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
                @foreach($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->component_name }}</td>
                        <td>{{ $result->score }}</td>
                        <td>{{ \Carbon\Carbon::parse($result->test_date)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
