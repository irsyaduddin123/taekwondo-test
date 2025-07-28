@extends('layouts.main')

@section('page_title', 'Komponen Tes')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">📋 Komponen Tes</h1>
    <a href="{{ route('test_components.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Tambah Komponen
    </a>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow-sm">
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
                    @foreach ($components as $index => $c)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $c->nama_komponen }}</td>
                        <td>{{ $c->jenis}}
                            {{-- <span class="badge bg-{{ $c->jenis == 'fisik' ? 'primary' : 'warning' }}">
                                {{ ucfirst($c->jenis) }}
                            </span> --}}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('test_components.edit', $c->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button 
                                class="btn btn-sm btn-danger btn-delete"
                                data-id="{{ $c->id }}"
                                data-nama="{{ $c->nama_komponen }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>

                        </td>
                    </tr>
                    @endforeach
                    @if($components->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data komponen.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Hapus tetap digunakan -->
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
                <p>Yakin ingin menghapus komponen <strong id="deleteNama"></strong>?</p>
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
$(document).ready(function() {
    $('.btn-delete').click(function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        $('#deleteForm').attr('action', '/admin/test-components/' + id);
        $('#deleteNama').text(nama);
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
