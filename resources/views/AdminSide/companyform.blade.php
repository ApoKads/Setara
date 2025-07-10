@php
  $isEdit = isset($company);
  $selectedProvince = old('provinsi', $isEdit ? $company->provinsi : '');
  $selectedCity = old('kota', $isEdit ? $company->kota : '');
@endphp

@extends('layouts.admin')

@section('content')
<body class="form-page-bg">
<div class="container py-5 form-container">
    <h2 class="fw-bold mb-4">{{ $isEdit ? 'Edit Informasi Perusahaan' : 'Informasi Perusahaan' }}</h2>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! Ada kesalahan input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $isEdit ? route('company.update', $company->id) : route('company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <!-- Nama Perusahaan -->
        <div class="mb-3">
            <label class="form-label">Nama Perusahaan *</label>
            <input type="text" name="name" class="form-control" placeholder="Masukkan nama perusahaan" 
            value="{{ old('name', $isEdit ? $company->name : ($prefillName ?? '')) }}" required>
            @error('nama_perusahaan')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Kontak -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon *</label>
                <input type="text" name="telepon" class="form-control" placeholder="Masukkan nomor telepon" value="{{ old('telepon', $isEdit ? $company->telepon : '') }}" required>
                @error('telepon')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email', $isEdit ? $company->email : '') }}" required>
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Website -->
        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="text" name="website" class="form-control" placeholder="Masukkan link website (Opsional)" value="{{ old('website', $isEdit ? $company->website : '') }}">
            @error('website')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Alamat -->
        <h5 class="fw-bold mt-4">Alamat</h5>

        <div class="mb-3">
            <label class="form-label">Jalan *</label>
            <input type="text" name="jalan" class="form-control" placeholder="Masukkan jalan" value="{{ old('jalan', $isEdit ? $company->jalan : '') }}" required>
            @error('jalan')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Provinsi *</label>
                <select name="provinsi" id="provinsiDropdown" class="form-select" required>
                    <option value="">Pilih Provinsi</option>
                    @foreach ($locations->pluck('province')->unique() as $province)
                        <option value="{{ $province }}" {{ $selectedProvince == $province ? 'selected' : '' }}>{{ $province }}</option>
                    @endforeach
                </select>
                @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kota *</label>
                <select name="kota" id="kotaDropdown" class="form-select" required>
                    <option value="">Pilih Kota</option>
                    @foreach ($locations as $lokasi)
                        @if ($selectedProvince === $lokasi->province)
                            <option value="{{ $lokasi->city }}" {{ $selectedCity == $lokasi->city ? 'selected' : '' }}>{{ $lokasi->city }}</option>
                        @endif
                    @endforeach
                </select>
                @error('kota')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Kode Pos -->
        <div class="mb-3">
            <label class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" placeholder="Masukkan kode pos (5 digit)" value="{{ old('kode_pos', $isEdit ? $company->kode_pos : '') }}">
            @error('kode_pos')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Legalitas -->
        <h5 class="fw-bold mt-4">Legalitas Perusahaan</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Induk Berusaha *</label>
                <input type="text" name="nib" class="form-control" placeholder="Masukkan NIB (13 digit)" value="{{ old('nib', $isEdit ? $company->nib : '') }}" required>
                @error('nib')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Pokok Wajib Pajak *</label>
                <input type="text" name="npwp" class="form-control" placeholder="Masukkan NPWP (16 digit)" value="{{ old('npwp', $isEdit ? $company->npwp : '') }}" required>
                @error('npwp')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Akta Pendirian *</label>
                @if($isEdit && $company->akta)
                    <a href="{{ asset('storage/' . $company->akta) }}" target="_blank" class="d-block mb-2">Lihat file saat ini</a>
                @endif
                <input type="file" name="akta" class="form-control" {{ $isEdit ? '' : 'required' }}>
                @error('akta')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">TDP *</label>
                @if($isEdit && $company->tdp)
                    <a href="{{ asset('storage/' . $company->tdp) }}" target="_blank" class="d-block mb-2">Lihat file saat ini</a>
                @endif
                <input type="file" name="tdp" class="form-control" {{ $isEdit ? '' : 'required' }}>
                @error('tdp')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- HRD -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Nama HRD *</label>
                <input type="text" name="nama_hrd" class="form-control" placeholder="Masukkan nama HRD" value="{{ old('nama_hrd', $isEdit ? $company->nama_hrd : '') }}" required>
                @error('nama_hrd')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Telepon HRD *</label>
                <input type="text" name="telepon_hrd" class="form-control" placeholder="Masukkan nomor telepon" value="{{ old('telepon_hrd', $isEdit ? $company->telepon_hrd : '') }}" required>
                @error('telepon_hrd')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label">Deskripsi Perusahaan *</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi perusahaan" required>{{ old('deskripsi', $isEdit ? $company->description : '') }}</textarea>
            @error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Kategori -->
        <div class="mb-3">
            <label class="form-label">Kategori Perusahaan *</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" id="category{{ $category->id }}"
                            value="{{ $category->id }}"
                            {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) || ($isEdit && $company->categories->contains($category->id)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('categories')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <!-- Submit -->
        <div class="mb-3 mt-5">
            <button type="submit" class="btn btn-dark px-4 py-2 rounded-pill">{{ $isEdit ? 'Update' : 'Submit' }}</button>
        </div>

        <small class="text-muted">
            Catatan: Pastikan kembali data yang Anda input sudah sesuai.
        </small>
    </form>
</div>
</body>
@endsection

<script>
  const allLocations = @json($locations);
  const selectedCity = @json($selectedCity);

  function updateKotaDropdown(selectedProvince) {
    const kotaDropdown = document.getElementById('kotaDropdown');
    kotaDropdown.innerHTML = '<option value="">Pilih Kota</option>';

    const filtered = allLocations.filter(loc => loc.province === selectedProvince);
    filtered.forEach(loc => {
      const option = document.createElement('option');
      option.value = loc.city;
      option.textContent = loc.city;
      if (loc.city === selectedCity) {
        option.selected = true;
      }
      kotaDropdown.appendChild(option);
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    const provinsiDropdown = document.getElementById('provinsiDropdown');
    const selectedProvince = provinsiDropdown.value;
    if (selectedProvince) {
      updateKotaDropdown(selectedProvince);
    }

    provinsiDropdown.addEventListener('change', function () {
      updateKotaDropdown(this.value);
    });
  });
</script>
