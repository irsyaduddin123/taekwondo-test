@extends('layouts.main')

@section('page_title', 'Hasil Prestasi Semua Athlete')

@section('content')
<div class="container">
    <h2 class="mb-4">Hasil Prestasi Semua Athlete</h2>

    <div id="accordion">
        @forelse($athletes as $athlete)
            <div class="card shadow mb-3">
                <div class="card-header bg-primary text-white" id="heading{{ $athlete->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse{{ $athlete->id }}" aria-expanded="false" aria-controls="collapse{{ $athlete->id }}">
                            {{ $athlete->name }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $athlete->id }}" class="collapse" aria-labelledby="heading{{ $athlete->id }}" data-parent="#accordion">
                    <div class="card-body">
                        <!-- Tombol Tambah Prestasi -->
                        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahPrestasi{{ $athlete->id }}">
                            + Tambah Prestasi
                        </button>

                        <!-- Tabel Prestasi -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kejuaraan</th>
                                    <th>Kelas</th>
                                    <th>Hasil</th>
                                    <th>Evaluasi Pelatih</th>
                                    <th>Evaluasi Pribadi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($athlete->hasilPrestasis as $prestasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $prestasi->nama_kejuaraan }}</td>
                                        <td>{{ $prestasi->kelas_pertandingan }}</td>
                                        <td>{{ $prestasi->hasil_pertandingan }}</td>
                                        <td>{{ $prestasi->evaluasi_pelatih }}</td>
                                        <td>{{ $prestasi->evaluasi_pribadi ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPrestasi{{ $prestasi->id }}">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusPrestasi{{ $prestasi->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center">Belum ada prestasi</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================== MODALS ================== -->

            <!-- Modal Tambah Prestasi -->
            <div class="modal fade" id="tambahPrestasi{{ $athlete->id }}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="{{ route('hasil-prestasi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">

                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Prestasi {{ $athlete->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Kejuaraan</label>
                        <input type="text" name="nama_kejuaraan" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Kelas Pertandingan</label>
                        <input type="text" name="kelas_pertandingan" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Hasil Pertandingan</label>
                        <input type="text" name="hasil_pertandingan" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Evaluasi Pelatih</label>
                        <textarea name="evaluasi_pelatih" class="form-control"></textarea>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal Edit & Hapus untuk tiap prestasi -->
            @foreach($athlete->hasilPrestasis as $prestasi)
                <!-- Modal Edit -->
                <div class="modal fade" id="editPrestasi{{ $prestasi->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form action="{{ route('hasil-prestasi.update', $prestasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Prestasi</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Nama Kejuaraan</label>
                            <input type="text" name="nama_kejuaraan" class="form-control" value="{{ $prestasi->nama_kejuaraan }}" required>
                          </div>
                          <div class="form-group">
                            <label>Kelas Pertandingan</label>
                            <input type="text" name="kelas_pertandingan" class="form-control" value="{{ $prestasi->kelas_pertandingan }}" required>
                          </div>
                          <div class="form-group">
                            <label>Hasil Pertandingan</label>
                            <input type="text" name="hasil_pertandingan" class="form-control" value="{{ $prestasi->hasil_pertandingan }}" required>
                          </div>
                          <div class="form-group">
                            <label>Evaluasi Pelatih</label>
                            <textarea name="evaluasi_pelatih" class="form-control">{{ $prestasi->evaluasi_pelatih }}</textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapusPrestasi{{ $prestasi->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="{{ route('hasil-prestasi.destroy', $prestasi->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                          <h5 class="modal-title">Konfirmasi Hapus</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Yakin ingin menghapus <strong>{{ $prestasi->nama_kejuaraan }}</strong>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            @endforeach

        @empty
            <div class="alert alert-info">Belum ada data athlete.</div>
        @endforelse
    </div>
</div>
@endsection
