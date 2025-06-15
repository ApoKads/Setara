@extends('layouts.admin')

@section('content')
<body class="form-page-bg">
<div class="container py-5 form-container">
    <h2 class="fw-bold mb-4">Informasi Perusahaan</h2>
    <hr>

    <!-- Kontak -->
    <h5 class="fw-bold mt-4">Kontak</h5>
    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Perusahaan *</label>
            <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan Nama" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon *</label>
                <input type="text" name="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="url" name="website" class="form-control" placeholder="Masukkan Link Website (Opsional)">
        </div>

        <!-- Alamat -->
        <h5 class="fw-bold mt-4">Alamat</h5>

        <div class="mb-3">
            <label class="form-label">Jalan *</label>
            <input type="text" name="jalan" class="form-control" placeholder="Masukkan Jalan" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Provinsi *</label>
                <select name="provinsi" class="form-select" required>
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kota *</label>
                <select name="kota" class="form-select" required>
                    <option value="">Pilih Kota</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos">
        </div>

        <!-- Legalitas Perusahaan -->
        <h5 class="fw-bold mt-4">Legalitas Perusahaan</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Induk Berusaha (NIB) *</label>
                <input type="text" name="nib" class="form-control" placeholder="Masukkan NIB" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">NPWP Perusahaan *</label>
                <input type="text" name="npwp" class="form-control" placeholder="Masukkan NPWP" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Akta Pendirian Perusahaan *</label>
                <input type="file" name="akta" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanda Daftar Perusahaan *</label>
                <input type="file" name="tdp" class="form-control" required>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap HRD *</label>
                <input type="text" name="nama_hrd" class="form-control" placeholder="Masukkan Nama" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon HRD *</label>
                <input type="text" name="telepon_hrd" class="form-control" placeholder="Masukkan Nomor Telepon" required>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-dark px-4 py-2 rounded-pill">Submit</button>
        </div>

        <small class="text-muted">
            Catatan: Pastikan kembali data yang Anda input sudah sesuai.<br>
            Anda dapat mengedit informasi perusahaan sebagai Admin di dashboard.
        </small>
    </form>
</div>
</body>
@endsection
