@extends('layouts.main')

@section('page_title', 'Hasil Prestasi Athlete')

@section('content')
<div class="container py-4">
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">Hasil Prestasi - {{ $athlete->name }}</h2>
        <p class="text-muted">Semua prestasi {{ $athlete->name }} beserta evaluasi pelatih dan evaluasi pribadi nya.</p>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" style="border-radius: 8px; overflow: hidden;">
                    <thead style="background: linear-gradient(90deg, #4e73df, #224abe); color: white;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kejuaraan</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Hasil</th>
                            <th scope="col">Evaluasi Pelatih</th>
                            <th scope="col">Evaluasi Pribadi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($athlete->hasilPrestasis as $prestasi)
                        <tr style="background-color: #f8f9fa;">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $prestasi->nama_kejuaraan }}</td>
                            <td>{{ $prestasi->kelas_pertandingan }}</td>
                            <td>
                                <span class="badge px-3 py-2"
                                      style="background-color: 
                                        @if(strtolower($prestasi->hasil_pertandingan) == 'menang') #28a745
                                        @elseif(strtolower($prestasi->hasil_pertandingan) == 'seri') #fd7e14
                                        @else #dc3545 @endif;
                                        color: white;
                                        font-weight: 500;">
                                    {{ $prestasi->hasil_pertandingan }}
                                </span>
                            </td>
                            <td>{{ $prestasi->evaluasi_pelatih }}</td>
                            <td>{{ $prestasi->evaluasi_pribadi ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary">Belum ada prestasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 text-end">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
