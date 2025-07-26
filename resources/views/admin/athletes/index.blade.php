@extends('layouts.main')

@section('page_title', 'Data Atlet')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">📋 Data Atlet</h1>
    <a href="{{ route('athletes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Tambah Atlet
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
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Tinggi</th>
                        <th>Berat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($athletes as $athlete)
                    <tr>
                        <td>{{ $athlete->name }}</td>
                        <td>{{ ucfirst($athlete->gender) }}</td>
                        <td>{{ $athlete->age }}</td>
                        <td>{{ $athlete->height }} cm</td>
                        <td>{{ $athlete->weight }} kg</td>
                        <td class="text-center">
                            <button 
                                class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $athlete->id }}"
                                data-name="{{ $athlete->name }}"
                                data-gender="{{ $athlete->gender }}"
                                data-age="{{ $athlete->age }}"
                                data-height="{{ $athlete->height }}"
                                data-weight="{{ $athlete->weight }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button 
                                class="btn btn-danger btn-sm btn-delete"
                                data-id="{{ $athlete->id }}"
                                data-name="{{ $athlete->name }}">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="editForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Atlet</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" id="editGender" class="form-control" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="age" id="editAge" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tinggi</label>
                    <input type="number" name="height" id="editHeight" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Berat</label>
                    <input type="number" name="weight" id="editWeight" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Atlet</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus atlet <strong id="deleteName"></strong>?</p>
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
    // Buka modal Edit dan isi data
    $('.btn-edit').click(function() {
        const id = $(this).data('id');
        $('#editForm').attr('action', '/athletes/' + id);
        $('#editName').val($(this).data('name'));
        $('#editGender').val($(this).data('gender'));
        $('#editAge').val($(this).data('age'));
        $('#editHeight').val($(this).data('height'));
        $('#editWeight').val($(this).data('weight'));
        $('#editModal').modal('show');
    });

    // Buka modal Hapus dan set data
    $('.btn-delete').click(function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        $('#deleteForm').attr('action', '/athletes/' + id);
        $('#deleteName').text(name);
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
