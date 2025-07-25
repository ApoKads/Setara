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
      <h2 class="fw-bold text-dark mb-3 fs-1">Pendaftar</h2>
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
            <h5 class="mb-0 fw-bold">{{ $company->name }}</h5>
            <p class="mb-0">
  <span class="fw-semibold">Status:</span>
  <span class="text-warning">
    @if($company->status === 'pending')
      Menunggu
    @elseif($company->status === 'accepted')
      Diterima
    @elseif($company->status === 'rejected')
      Ditolak
    @else
      {{ ucfirst($company->status) }}
    @endif
  </span>
</p>

            <small class="text-muted">Didaftarkan: {{ $company->created_at->format('d M Y H:i') }}</small>
          </div>
          <div class="d-flex gap-2">
            <form action="{{ route('admin.approveCompany', $company->id) }}" method="POST" class="approve-form">
              @csrf
              <button type="submit" class="btn btn-info btn-sm text-white">Terima</button>
            </form>

            <form action="{{ route('admin.rejectCompany', $company->id) }}" method="POST" class="reject-form">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
            </form>
          </div>
        </div>
      @empty
        <p class="text-muted">Tidak ada perusahaan yang mendaftar.</p>
      @endforelse
    </div>

    <!-- History -->
    <div class="col-md-6" style="max-height: 80vh; overflow-y: auto;">
      <h2 class="fw-bold text-dark mb-3 fs-1">Riwayat</h2>
      <hr class="mb-4">

      @forelse($historyCompanies as $company)
        <div class="bg-white rounded shadow-sm p-3 mb-3 hover-shadow">
          <h6 class="fw-bold mb-1">{{ $company->name }}</h6>
          <span class="badge 
          @if($company->status === 'accepted') bg-success 
          @elseif($company->status === 'rejected') bg-danger 
          @else bg-secondary 
          @endif">
  @if($company->status === 'accepted')
    Diterima
  @elseif($company->status === 'rejected')
    Ditolak
  @else
    {{ ucfirst($company->status) }}
  @endif
          </span>
          <br>
          <small class="text-muted">Terakhir diperbarui: {{ $company->updated_at->format('d M Y H:i') }}</small>
        </div>
      @empty
        <p class="text-muted">Belum ada riwayat aktivitas.</p>
      @endforelse
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const handleForm = async (event, form) => {
      event.preventDefault();

      const actionUrl = form.action;
      const csrfToken = form.querySelector('input[name="_token"]').value;

      try {
        const response = await fetch(actionUrl, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({})
        });

        const result = await response.json();

        if (response.ok) {
          alert(result.message || 'Berhasil diproses.');
          window.location.reload();
        } else {
          alert('Error: ' + (result.message || 'Terjadi kesalahan.'));
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan jaringan atau server.');
      }
    };

    document.querySelectorAll('.approve-form').forEach(form => {
      form.addEventListener('submit', (e) => handleForm(e, form));
    });

    document.querySelectorAll('.reject-form').forEach(form => {
      form.addEventListener('submit', (e) => handleForm(e, form));
    });
  });
</script>
@endsection
