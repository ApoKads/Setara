@extends('layouts.admin')

@section('content')
<!-- Background Parallax -->
<div class="position-absolute w-100 h-100 top-0 start-0 overflow-hidden z-n1">
  <img src="{{ asset('images/CompanyDashboard/ParallaxAtas.png') }}" alt="Parallax Atas" class="position-fixed" style="top: -200px; right: -200px;">
  <img src="{{ asset('images/CompanyDashboard/ParallaxBawah.png') }}" alt="Parallax Bawah" class="position-fixed" style="bottom: -100px; left: -200px;">
</div>

<div class="container my-5 position-relative">
  <h2 class="fw-bold mb-4">Perusahaan Terdaftar</h2>

  <!-- Sort dan Search -->
  <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex justify-content-between align-items-center mb-4">
    <div class="dropdown">
      <button class="btn btn-light border rounded-pill px-4 py-2 fw-semibold dropdown-toggle" type="button" data-bs-toggle="dropdown">
        {{ request('sort') === 'oldest' ? 'Terlama' : 'Terbaru' }}
      </button>
      <ul class="dropdown-menu">
        <li><button class="dropdown-item bg-white text-dark" name="sort" value="latest" type="submit">Terbaru</button></li>
        <li><button class="dropdown-item bg-white text-dark" name="sort" value="oldest" type="submit">Terlama</button></li>
      </ul>
    </div>

    <div class="w-50 d-flex gap-2">
      <input type="text" name="search" class="form-control rounded-pill px-4" placeholder="Search perusahaan..." value="{{ request('search') }}">
      <button type="submit" class="btn btn-dark rounded-pill px-4">Cari</button>
    </div>
  </form>

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
              <td>
  <div class="d-flex align-items-center gap-2">

    <td>
  <div class="d-flex align-items-center gap-2">
    
    <!-- See Profile -->
    <a href="{{ route('company.show', $company->id) }}" 
       class="btn rounded-pill px-3 py-1 fw-medium see-profile-btn" 
       style="background-color: #ffffff; color: #3551A4; border: 1.5px solid #d5e3ff; box-shadow: 0 2px 4px rgba(0, 76, 255, 0.1);">
      See Profile
    </a>

    <!-- Edit Icon -->
    <a href="{{ route('company.edit', $company->id) }}"
       class="d-flex justify-content-center align-items-center rounded-circle"
       style="width: 38px; height: 38px; background-color: #f0f4ff; color: #3551A4;">
      <i class="bi bi-pencil-fill"></i>
    </a>

    <!-- Delete Icon -->
    <form action="{{ route('company.destroy', $company->id) }}" method="POST" 
          onsubmit="return confirm('Yakin ingin menghapus Company ini?')"
          class="m-0 p-0">
      @csrf
      @method('DELETE')
      <button type="submit"
        class="d-flex justify-content-center align-items-center rounded-circle border-0"
        style="width: 38px; height: 38px; background-color: #ffecec; color: #F04438;">
        <i class="bi bi-trash-fill"></i>
      </button>
    </form>

  </div>
</td>

    </form>

  </div>
</td>

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
  table tr {
    border-radius: 20px;
    overflow: hidden;
  }

  table td,
  table th {
    vertical-align: middle;
    background-color: #fff;
    border-top: none !important;
    border-bottom: none !important;
  }

  .table thead th {
    border: none;
    font-weight: 600;
  }

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

a.rounded-circle:hover {
  filter: brightness(95%);
  transform: scale(1.05);
  transition: 0.2s;
}

form .rounded-circle:hover {
  filter: brightness(95%);
  transform: scale(1.05);
  transition: 0.2s;
}

.see-profile-btn {
  transition: all 0.25s ease-in-out;
}

.see-profile-btn:hover {
  background-color: #f5f9ff;
  color: #3551A4;
  border-color: #b3d0ff;
  box-shadow: 0 4px 8px rgba(0, 76, 255, 0.15);
  transform: scale(1.03);
  transition: 0.2s;
}

</style>
