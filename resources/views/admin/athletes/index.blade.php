@extends('layouts.main')

@section('page_title', 'Data Atlet')

@section('header')
<h1>Data Atlet</h1>
<a href="{{ route('athletes.create') }}" class="btn btn-primary">+ Tambah Atlet</a>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th><th>Gender</th><th>Umur</th><th>Tinggi</th><th>Berat</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($athletes as $athlete)
        <tr>
            <td>{{ $athlete->name }}</td>
            <td>{{ $athlete->gender }}</td>
            <td>{{ $athlete->age }}</td>
            <td>{{ $athlete->height }} cm</td>
            <td>{{ $athlete->weight }} kg</td>
            <td>
                <a href="{{ route('athletes.edit', $athlete->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('athletes.destroy', $athlete->id) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
