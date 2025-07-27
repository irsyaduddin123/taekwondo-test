@extends('layouts.main')

@section('page_title', 'Dashboard')

@section('header')
<div class="row mb-4">
  <div class="col">
    <h1 class="h3">Dashboard</h1>
  </div>
</div>
@endsection

@section('content')
<div class="row">
  <!-- Welcome Card -->
  <div class="col-12 mb-4">
    <div class="card bg-gradient-warning text-white shadow">
      <div class="card-body">
        <h4 class="mb-1">Selamat datang, {{ Auth::user()->name }}!</h4>
        <p class="mb-0">Semoga harimu menyenangkan! Kelola data atlet dan hasil tes mereka dengan mudah di sini.</p>
      </div>
    </div>
  </div>

  <!-- Info Cards -->
  <div class="col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Atlet</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahAtlet ?? '0' }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tes Fisik</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tesFisik ?? '0' }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dumbbell fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tes Teknik</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tesTeknik ?? '0' }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-running fa-2x text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
