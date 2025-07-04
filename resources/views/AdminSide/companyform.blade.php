@php
  $isEdit = request()->has('id');
@endphp

@extends('layouts.admin')

@section('content')
<body class="form-page-bg">
<div class="container py-5 form-container">
    <h2 class="fw-bold mb-4">{{ $isEdit ? 'Edit Informasi Perusahaan' : 'Informasi Perusahaan' }}</h2>
    <hr>

    <!-- Kontak -->
    <h5 class="fw-bold mt-4">Kontak</h5>
    <form action="{{ $isEdit ? route('company.update', $company->id) : route('company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Nama Perusahaan *</label>
            <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan Nama"
              value="{{ old('nama_perusahaan', $isEdit ? $company->name : '') }}" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon *</label>
                <input type="text" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon"
                  value="{{ old('telepon', $isEdit ? $company->telepon : '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email"
                  value="{{ old('email', $isEdit ? $company->email : '') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="url" name="website" class="form-control" placeholder="Masukkan Link Website (Opsional)"
              value="{{ old('website', $isEdit ? $company->website : '') }}">
        </div>

        <!-- Alamat -->
        <h5 class="fw-bold mt-4">Alamat</h5>

        <div class="mb-3">
            <label class="form-label">Jalan *</label>
            <input type="text" name="jalan" class="form-control" placeholder="Masukkan Jalan"
              value="{{ old('jalan', $isEdit ? $company->jalan : '') }}" required>
        </div>

        <div class="row mb-3">
  <div class="col-md-6">
    <label class="form-label">Provinsi *</label>
    <select name="provinsi" id="provinsiDropdown" class="form-select" required>
      <option value="">Pilih Provinsi</option>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Kota *</label>
    <select name="kota" id="kotaDropdown" class="form-select" required>
      <option value="">Pilih Kota</option>
    </select>
  </div>
</div>

        <div class="mb-3">
            <label class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos"
              value="{{ old('kode_pos', $isEdit ? $company->kode_pos : '') }}">
        </div>

        <!-- Legalitas Perusahaan -->
        <h5 class="fw-bold mt-4">Legalitas Perusahaan</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Induk Berusaha (NIB) *</label>
                <input type="text" name="nib" class="form-control" placeholder="Masukkan NIB"
                  value="{{ old('nib', $isEdit ? $company->nib : '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NPWP Perusahaan *</label>
                <input type="text" name="npwp" class="form-control" placeholder="Masukkan NPWP"
                  value="{{ old('npwp', $isEdit ? $company->npwp : '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Akta Pendirian Perusahaan *</label>
                @if($isEdit && $company->akta)
                    <a href="{{ asset('storage/' . $company->akta) }}" target="_blank" class="d-block mb-2 text-primary">Lihat file saat ini</a>
                @endif
                <input type="file" name="akta" class="form-control" {{ $isEdit ? '' : 'required' }}>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanda Daftar Perusahaan *</label>
                @if($isEdit && $company->tdp)
                    <a href="{{ asset('storage/' . $company->tdp) }}" target="_blank" class="d-block mb-2 text-primary">Lihat file saat ini</a>
                @endif
                <input type="file" name="tdp" class="form-control" {{ $isEdit ? '' : 'required' }}>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap HRD *</label>
                <input type="text" name="nama_hrd" class="form-control" placeholder="Masukkan Nama"
                  value="{{ old('nama_hrd', $isEdit ? $company->nama_hrd : '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon HRD *</label>
                <input type="text" name="telepon_hrd" class="form-control" placeholder="Masukkan Nomor Telepon"
                  value="{{ old('telepon_hrd', $isEdit ? $company->telepon_hrd : '') }}" required>
            </div>
        </div>

        <!-- Deskripsi dan Kategori -->
        <h5 class="fw-bold mt-4">Profil Perusahaan</h5>

        <div class="mb-3">
            <label class="form-label">Deskripsi Perusahaan *</label>
            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi perusahaan" required>{{ old('deskripsi', $isEdit ? $company->deskripsi : '') }}</textarea>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-dark px-4 py-2 rounded-pill">{{ $isEdit ? 'Update' : 'Submit' }}</button>
        </div>

        <small class="text-muted">
            Catatan: Pastikan kembali data yang Anda input sudah sesuai.<br>
            Anda dapat mengedit informasi perusahaan sebagai Admin di dashboard.
        </small>
    </form>
</div>
</body>
@endsection
