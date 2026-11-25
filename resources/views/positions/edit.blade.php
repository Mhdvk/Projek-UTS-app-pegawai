@extends('master')

@section('title', 'Edit Jabatan')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Jabatan</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_jabatan" class="form-label form-label-required">Nama Jabatan</label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control"
                       value="{{ old('nama_jabatan', $position->nama_jabatan) }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="gaji_pokok" class="form-label form-label-required">Gaji Pokok (Rp)</label>
                <input type="number" step="1000" id="gaji_pokok" name="gaji_pokok" class="form-control"
                       value="{{ old('gaji_pokok', $position->gaji_pokok) }}" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
