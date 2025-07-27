<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Tes Atlet</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Hasil Tes Atlet</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Atlet</th>
                <th>Komponen Tes</th>
                <th>Jenis</th>
                <th>Nilai</th>
                <th>Tanggal Tes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->athlete->name }}</td>
                <td>{{ $r->testComponent->nama_komponen }}</td>
                <td>{{ ucfirst($r->testComponent->jenis) }}</td>
                <td>{{ $r->score }}</td>
                <td>{{ \Carbon\Carbon::parse($r->test_date)->translatedFormat('d F Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
