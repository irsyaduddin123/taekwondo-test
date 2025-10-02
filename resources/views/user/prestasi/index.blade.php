@extends('user.main-user.index')

@section('page_title', 'Prestasi Saya')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Prestasi Saya</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kejuaraan</th>
                            <th>Kelas Pertandingan</th>
                            <th>Hasil Pertandingan</th>
                            <th>Evaluasi Pelatih</th>
                            <th>Evaluasi Pribadi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasis as $prestasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $prestasi->nama_kejuaraan }}</td>
                                <td>{{ $prestasi->kelas_pertandingan }}</td>
                                <td>{{ $prestasi->hasil_pertandingan }}</td>
                                <td>{{ $prestasi->evaluasi_pelatih ?? '-' }}</td>
                                <td>{{ $prestasi->evaluasi_pribadi ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $prestasi->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada prestasi yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal di luar card --}}
@foreach ($prestasis as $prestasi)
<div class="modal fade" id="editModal{{ $prestasi->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $prestasi->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('user.prestasi.update', $prestasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $prestasi->id }}">Edit Evaluasi Pribadi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Kejuaraan:</strong> {{ $prestasi->nama_kejuaraan }}</p>
                    <p><strong>Kelas:</strong> {{ $prestasi->kelas_pertandingan }}</p>
                    <p><strong>Hasil:</strong> {{ $prestasi->hasil_pertandingan }}</p>
                    <p><strong>Evaluasi Pelatih:</strong> {{ $prestasi->evaluasi_pelatih ?? '-' }}</p>
                    
                    <div class="form-group mt-3">
                        <label for="evaluasi_pribadi_{{ $prestasi->id }}">Evaluasi Pribadi</label>
                        <textarea name="evaluasi_pribadi" id="evaluasi_pribadi_{{ $prestasi->id }}" class="form-control" rows="4">{{ old('evaluasi_pribadi', $prestasi->evaluasi_pribadi) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
