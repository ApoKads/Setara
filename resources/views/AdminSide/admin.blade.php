@extends('layouts.admin')

@section('content')
<div class="container my-5">
  <h2 class="fw-bold mb-4">Perusahaan Terdaftar</h2>

  <!-- Sort dan Search -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="dropdown">
      <button class="btn btn-light border rounded-pill px-4 py-2 fw-semibold" type="button" data-bs-toggle="dropdown">
        Sort
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Terbaru</a></li>
        <li><a class="dropdown-item" href="#">Terlama</a></li>
      </ul>
    </div>
    <div class="w-50">
      <input type="text" class="form-control rounded-pill px-4" placeholder="Search" />
    </div>
  </div>

  <!-- Table -->
  <div class="table-responsive">
    <table class="table border-0 align-middle" style="border-collapse: separate; border-spacing: 0 15px;">
      <thead class="text-muted">
        <tr class="border-0">
          <th class="ps-4">Nama Perusahaan</th>
          <th>Tanggal Bergabung</th>
          <th>Lokasi</th>
          <th>Jenis Lowongan</th>
          <th>Kontrol</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($companies as $company)
        <tr class="bg-white shadow-sm rounded-4">
          <td class="ps-4 fw-medium">{{ $company->name }}</td>
          <td>{{ $company->created_at->format('d-m-Y') }}</td>
          <td>{{ $company->location }}</td>
          <td>{{ $company->job_types_count }}</td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <a href="{{ route('company.show', $company->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">See Profile</a>

              <a href="{{ route('company.edit', $company->id) }}" class="btn btn-outline-secondary btn-sm rounded-circle">
                <i class="bi bi-pencil-fill"></i>
              </a>

              <form action="{{ route('company.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus Company ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm rounded-circle mt-3">
                  <i class="bi bi-trash-fill"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

<style>
  /* Styling baris */
  table tr {
    border-radius: 20px;
    overflow: hidden;
  }

  table td, table th {
    vertical-align: middle;
    background-color: #fff;
    border-top: none !important;
    border-bottom: none !important;
  }

  /* Hapus garis tabel */
  .table thead th {
    border: none;
    font-weight: 600;
  }

  /* Hover effect */
  table tbody tr:hover {
    background-color: #f8f9fa;
  }

  .btn-outline-primary,
  .btn-outline-secondary,
  .btn-outline-danger {
    transition: 0.3s ease;
  }

  .btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
  }

  .btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
  }
</style>
