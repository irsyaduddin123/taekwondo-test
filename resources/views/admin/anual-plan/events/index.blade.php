@extends('layouts.main')

@section('page_title', 'Event')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        {{-- <h3 class="card-title">Daftar Event</h3> --}}
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">
            <i class="fas fa-plus"></i> Tambah Event
        </button>
    </div>
    <div class="card-body">
        {{-- 🔔 Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- 🔔 Alert Error --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Plan</th>
                    <th>Nama Event</th>
                    <th>Lokasi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $i => $event)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{$event->plan->nama}}</td>
                    <td>{{ $event->nama }}</td>
                    <td>{{ $event->lokasi }}</td>
                    <td>{{ $event->tanggal_mulai }}</td>
                    <td>{{ $event->tanggal_selesai }}</td>
                    <td>{{ $event->keterangan }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editEventModal{{ $event->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- Tombol Delete -->
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteEventModal{{ $event->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('events.update', $event->id)}}" method="POST">
                          @csrf
                          @method('PUT') <!-- 🔑 supaya update jalan -->
                          <div class="form-group">
                            <label>Nama Plan</label>
                            <input type="text" class="form-control" name="nama" value="{{ $event->plan->nama }}" required readonly>
                          </div>
                          <div class="form-group">
                            <label>Nama Event</label>
                            <input type="text" class="form-control" name="nama" value="{{ $event->nama }}" required>
                          </div>
                          <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="{{ $event->lokasi }}">
                          </div>
                          <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" value="{{ $event->tanggal_mulai }}" required>
                          </div>
                          <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai" value="{{ $event->tanggal_selesai }}">
                          </div>
                          <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan">{{ $event->keterangan }}</textarea>
                          </div>
                          <button type="submit" class="btn btn-success">Update</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Modal Delete --}}
                <div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah Anda yakin ingin menghapus event <strong>{{ $event->nama }}</strong>?
                      </div>
                      <div class="modal-footer">
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                          @csrf
                          @method('DELETE') <!-- 🔑 supaya delete jalan -->
                          <button type="submit" class="btn btn-danger">Hapus</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada event</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Event Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('events.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Plan</label>
            <select name="plan_id" class="form-control" required>
                <option value="" disabled selected>Pilih Plan</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nama }} </option>
                @endforeach
            </select>
            </div>
          <div class="form-group">
            <label>Nama Event</label>
            <input type="text" class="form-control" name="nama" required>
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <input type="text" class="form-control" name="lokasi">
          </div>
          <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" required>
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
