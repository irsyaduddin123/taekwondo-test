@extends('layouts.main')

@section('page_title', 'Komponen Tes & Jenis')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">📋 Manajemen Komponen & Jenis Tes</h1>
</div>
@endsection

@section('content')
{{-- Flash Message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    {{-- ======================= Tabel Komponen ======================= --}}
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list"></i> Daftar Komponen Tes</span>
                <a href="{{ route('test_components.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Komponen</th>
                                <th>Jenis</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($components as $index => $c)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $c->nama_komponen }}</td>
                                <td>{{ $c->type->nama_jenis ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('test_components.edit', $c->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $c->id }}"
                                        data-nama="{{ $c->nama_komponen }}"
                                        data-url="{{ route('test_components.destroy', $c->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada komponen.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================= Tabel Jenis ======================= --}}
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-tags"></i> Daftar Jenis Komponen</span>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createTypeModal">
                    <i class="fas fa-plus-circle"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Jenis</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($types as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t->nama_jenis }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn-edit-type"
                                        data-id="{{ $t->id }}"
                                        data-nama="{{ $t->nama_jenis }}"
                                        data-url="{{ route('component_types.update', $t->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete"
                                        data-id="{{ $t->id }}"
                                        data-nama="{{ $t->nama_jenis }}"
                                        data-url="{{ route('component_types.destroy', $t->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada jenis.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= Modal Tambah Jenis ================= --}}
<div class="modal fade" id="createTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('component_types.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- ================= Modal Edit Jenis ================= --}}
<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editTypeForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" id="editNamaJenis" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- ================= Modal Hapus ================= --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-trash-alt mr-1"></i> Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus <strong id="deleteNama"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    // Hapus
    $('.btn-delete').click(function() {
        $('#deleteForm').attr('action', $(this).data('url'));
        $('#deleteNama').text($(this).data('nama'));
        $('#deleteModal').modal('show');
    });

    // Edit Jenis
    $('.btn-edit-type').click(function() {
        $('#editTypeForm').attr('action', $(this).data('url'));
        $('#editNamaJenis').val($(this).data('nama'));
        $('#editTypeModal').modal('show');
    });
});
</script>
@endpush
