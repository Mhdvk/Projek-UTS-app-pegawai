@extends('master')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Jabatan Baru</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_jabatan" class="form-label form-label-required">Nama Jabatan</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" value="{{ old('nama_jabatan') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="gaji_pokok" class="form-label form-label-required">Gaji Pokok (Rp)</label>
                <input type="number" step="1000" id="gaji_pokok" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}" placeholder="Contoh: 5000000" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Jabatan</button>
                <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
