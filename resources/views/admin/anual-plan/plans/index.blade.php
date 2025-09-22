@extends('layouts.main')
@section('content')
<div class="container">
    <h3>Daftar Plan</h3>
    <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Tambah Plan</a>
    <ul>
        @foreach($plans as $plan)
            <li><a href="{{ route('plans.show', $plan) }}">{{ $plan->nama_plan }} ({{ $plan->tahun }})</a></li>
        @endforeach
    </ul>
</div>
@endsection
