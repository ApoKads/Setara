@extends('layouts.admin')

@section('content')
<div class="position-absolute w-100 h-100 top-0 start-0 overflow-hidden z-n1">
  <img src="{{ asset('images/CompanyDashboard/ParallaxAtas.png') }}" class="position-fixed" style="top: -200px; right: -200px;">
  <img src="{{ asset('images/CompanyDashboard/ParallaxBawah.png') }}" class="position-fixed" style="bottom: -100px; left: -200px;">
</div>

<div class="container my-5 position-relative z-1">
  <div class="row">
    <!-- Pendaftar -->
    <div class="col-md-6" style="max-height: 80vh; overflow-y: auto;">
      <h2 class="fw-bold text-dark mb-3">Pendaftar</h2>
      <hr class="mb-4">

      <div class="d-flex mb-3 gap-2">
        <form method="GET" action="{{ route('admin.activity') }}" class="d-flex justify-content-between align-items-center mb-4 w-100">
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
      </div>

      @forelse($pendaftarCompanies as $company)
        <div class="bg-white rounded shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center hover-shadow">
          <div class="flex-grow-1">
            <h5 class="mb-0 fw-bold">{{ $company->company_name }}</h5>
            <p class="mb-1 mt-2 small">Applying for long-term partnerships</p>
            <p class="mb-0">
              <span class="fw-semibold">Status:</span>
              <span class="text-warning">{{ ucfirst($company->status) }}</span>
            </p>
          </div>
          <div class="d-flex gap-2">
            <form action="{{ route('admin.approveCompany', $company->id) }}" method="POST" onclick="event.stopPropagation();">
            @csrf
                <button type="submit" class="btn btn-info btn-sm text-white">Approve</button>
            </form>

            <form action="{{ route('admin.rejectCompany', $company->id) }}" method="POST" onclick="event.stopPropagation();">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Decline</button>
            </form>
          </div>
        </div>
      @empty
        <p class="text-muted">Tidak ada perusahaan yang mendaftar.</p>
      @endforelse
    </div>

    <!-- History -->
    <div class="col-md-6" style="max-height: 80vh; overflow-y: auto;">
      <h2 class="fw-bold text-dark mb-3">History</h2>
      <hr class="mb-4">

      @forelse($historyCompanies as $company)
        <div class="bg-white rounded shadow-sm p-3 mb-3 hover-shadow">
          <p class="mb-1">
            You <span class="fw-bold text-capitalize">{{ $company->position }}</span>
            <span>{{ $company->company_name }}</span>
          </p>
          <small class="text-muted">{{ $company->updated_at->format('d-m-Y') }}</small>
        </div>
      @empty
        <p class="text-muted">Belum ada riwayat aktivitas.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection
