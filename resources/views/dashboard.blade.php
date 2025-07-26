@extends('layouts.main')

@section('page_title', 'Dashboard')

@section('header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Dashboard</h1>
    </div>
  </div>
@endsection

@section('content')
  <div class="card">
    <div class="card-body">
      <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
  </div>
@endsection
