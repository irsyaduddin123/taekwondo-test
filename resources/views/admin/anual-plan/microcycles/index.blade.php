@extends('layouts.main')

@section('page_title', 'Plans & Microcycles')
@section('content')
<div class="container">
    <h2>Daftar Plan & Microcycles</h2>

    {{-- Tambah Plan --}}
    <form action="{{ route('plans.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-row">
            <div class="col">
                <input type="text" name="nama" class="form-control" placeholder="Nama Plan" required>
            </div>
            <div class="col">
                <input type="number" name="tahun" class="form-control" placeholder="Tahun" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Tambah Plan</button>
            </div>
        </div>
    </form>

    <div class="accordion" id="plansAccordion">
        @forelse($plans as $plan)
            <div class="card mb-2">
                <div class="card-header" id="heading{{ $plan->id }}">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <button class="btn btn-link" type="button" data-toggle="collapse" 
                                data-target="#collapse{{ $plan->id }}" aria-expanded="false" 
                                aria-controls="collapse{{ $plan->id }}">
                            {{ $plan->tahun }} - {{ $plan->nama }}
                        </button>
                        <div>
                            <!-- Tombol Edit Plan -->
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPlan{{ $plan->id }}">Edit</button>

                            <!-- Tombol Hapus Plan -->
                            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus plan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </h5>
                </div>

                <div id="collapse{{ $plan->id }}" class="collapse" 
                     aria-labelledby="heading{{ $plan->id }}" data-parent="#plansAccordion">
                    <div class="card-body">
                        {{-- Tambah Microcycle --}}
                        <form action="{{ route('microcycles.store', $plan->id) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="form-row">
                                <div class="col"><input type="number" name="minggu" class="form-control" placeholder="Minggu" required></div>
                                <div class="col"><input type="text" name="fase" class="form-control" placeholder="Fase" required></div>
                                <div class="col"><input type="text" name="tahap" class="form-control" placeholder="Tahap" required></div>
                                <div class="col"><input type="number" name="load" class="form-control" placeholder="Load" required></div>
                                <div class="col"><input type="number" name="phys_prep" class="form-control" placeholder="Phys Prep" required></div>
                                <div class="col"><input type="number" name="tech_prep" class="form-control" placeholder="Tech Prep" required></div>
                                <div class="col"><input type="number" name="volume" class="form-control" placeholder="Volume" required></div>
                                <div class="col"><input type="number" name="intensity" class="form-control" placeholder="Intensity" required></div>
                                <div class="col"><button type="submit" class="btn btn-success">Tambah</button></div>
                            </div>
                        </form>

                        {{-- Tabel Microcycles --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Minggu</th>
                                    <th>Fase</th>
                                    <th>Tahap</th>
                                    <th>Load</th>
                                    <th>Phys Prep</th>
                                    <th>Tech Prep</th>
                                    <th>Volume</th>
                                    <th>Intensity</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plan->microcycles as $mc)
                                    <tr>
                                        <td>{{ $mc->minggu }}</td>
                                        <td>{{ $mc->fase }}</td>
                                        <td>{{ $mc->tahap }}</td>
                                        <td>{{ $mc->load }}</td>
                                        <td>{{ $mc->phys_prep }}</td>
                                        <td>{{ $mc->tech_prep }}</td>
                                        <td>{{ $mc->volume }}</td>
                                        <td>{{ $mc->intensity }}</td>
                                        <td>
                                            <!-- Tombol Edit Microcycle -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMicrocycle{{ $mc->id }}">Edit</button>

                                            <!-- Tombol Hapus Microcycle -->
                                            <form action="{{ route('microcycles.destroy', $mc->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus microcycle ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Microcycle -->
                                    <div class="modal fade" id="editMicrocycle{{ $mc->id }}" tabindex="-1" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <form action="{{ route('microcycles.update', $mc->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                              <h5 class="modal-title">Edit Microcycle</h5>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="form-group"><label>Minggu</label><input type="number" name="minggu" class="form-control" value="{{ $mc->minggu }}" required></div>
                                              <div class="form-group"><label>Fase</label><input type="text" name="fase" class="form-control" value="{{ $mc->fase }}" required></div>
                                              <div class="form-group"><label>Tahap</label><input type="text" name="tahap" class="form-control" value="{{ $mc->tahap }}" required></div>
                                              <div class="form-group"><label>Load</label><input type="number" name="load" class="form-control" value="{{ $mc->load }}" required></div>
                                              <div class="form-group"><label>Phys Prep</label><input type="number" name="phys_prep" class="form-control" value="{{ $mc->phys_prep }}" required></div>
                                              <div class="form-group"><label>Tech Prep</label><input type="number" name="tech_prep" class="form-control" value="{{ $mc->tech_prep }}" required></div>
                                              <div class="form-group"><label>Volume</label><input type="number" name="volume" class="form-control" value="{{ $mc->volume }}" required></div>
                                              <div class="form-group"><label>Intensity</label><input type="number" name="intensity" class="form-control" value="{{ $mc->intensity }}" required></div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada microcycle</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Plan -->
            <div class="modal fade" id="editPlan{{ $plan->id }}" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Plan</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group"><label>Nama Plan</label><input type="text" name="nama" class="form-control" value="{{ $plan->nama }}" required></div>
                      <div class="form-group"><label>Tahun</label><input type="number" name="tahun" class="form-control" value="{{ $plan->tahun }}" required></div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        @empty
            <p class="text-center">Belum ada plan</p>
        @endforelse
    </div>
</div>
@endsection
