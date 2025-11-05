@extends('layouts.main')

@section('page_title', 'Kelola Pengguna & Atlet')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Kelola Pengguna & Atlet</h1>

    {{-- Tabel User --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Daftar User
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <select name="role" class="form-control me-2">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="coach" {{ $user->role == 'coach' ? 'selected' : '' }}>Coach</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Athlete --}}
    <div class="card">
        <div class="card-header bg-success text-white">
            Daftar Athlete
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Atlet</th>
                        <th>Email Terkait</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($athletes as $athlete)
                    <tr>
                        <td>{{ $athlete->id }}</td>
                        <td>{{ $athlete->name }}</td>
                        {{-- <td>{{ $athlete->user ? $athlete->user->name . ' (' . $athlete->user->email . ')' : '-' }}</td> --}}
                        <td>{{ $athlete->user ? $athlete->user->email : '-' }}</td>
                        <td>
                            <form action="{{ route('admin.athletes.updateUser', $athlete->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <select name="user_id" class="form-control me-2">
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $athlete->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
