@extends('layouts.main')

@section('page_title', 'Hasil Prestasi Semua Athlete')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center text-primary fw-bold">Hasil Prestasi Semua Athlete</h2>

    <div id="accordion">
        @forelse($athletes as $athlete)
            <div class="card mb-4 shadow-sm rounded">
                <!-- Header Accordion -->
                <div class="card-header d-flex justify-content-between align-items-center" id="heading{{ $athlete->id }}" style="background: linear-gradient(90deg, #00c6ff, #0072ff); color:white; cursor:pointer;" onclick="toggleCollapse('{{ $athlete->id }}')">
                    <h5 class="mb-0">
                        <span class="fw-bold">{{ $athlete->name }}</span>
                    </h5>
                    <div>
                        <a href="{{ route('hasil-prestasi.showAthlete', $athlete->id) }}" class="btn btn-light btn-sm me-2" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fas fa-eye me-1"></i> Lihat Prestasi
                        </a>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahPrestasi{{ $athlete->id }}" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fas fa-plus me-1"></i> Tambah Prestasi
                        </button>
                    </div>
                </div>

                <!-- Body Accordion -->
                <div id="collapse{{ $athlete->id }}" class="collapse">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle" style="border-radius:10px; overflow:hidden;">
                                <thead style="background-color:#e0f7fa;">
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
                                        <tr style="background-color: {{ $loop->even ? '#f1f8e9' : '#ffffff' }}; transition: background 0.3s;" onmouseover="this.style.background='#dcedc8'" onmouseout="this.style.background='{{ $loop->even ? '#f1f8e9' : '#ffffff' }}'">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $prestasi->nama_kejuaraan }}</td>
                                            <td>{{ $prestasi->kelas_pertandingan }}</td>
                                            <td>
                                                <span class="badge rounded-pill px-2 py-1 shadow-sm 
                                                    @if(strtolower($prestasi->hasil_pertandingan) == 'menang') bg-success
                                                    @elseif(strtolower($prestasi->hasil_pertandingan) == 'seri') bg-warning text-dark
                                                    @else bg-danger @endif">
                                                    {{ $prestasi->hasil_pertandingan }}
                                                </span>
                                            </td>
                                            <td>{{ $prestasi->evaluasi_pelatih }}</td>
                                            <td>{{ $prestasi->evaluasi_pribadi ?? '-' }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning mb-1" data-toggle="modal" data-target="#editPrestasi{{ $prestasi->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#hapusPrestasi{{ $prestasi->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted">Belum ada prestasi</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
<script>
function toggleCollapse(id) {
    let element = document.getElementById('collapse'+id);
    if(element.classList.contains('show')){
        $(element).collapse('hide');
    } else {
        $(element).collapse('show');
    }
}
</script>
@endsection
