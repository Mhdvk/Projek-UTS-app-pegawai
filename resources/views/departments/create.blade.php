@extends('master')

@section('title', 'Tambah Departemen')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Departemen Baru</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_departemen" class="form-label form-label-required">Nama Departemen</label>
                <input type="text" name="nama_departemen" id="nama_departemen" class="form-control" value="{{ old('nama_departemen') }}" required autofocus>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Departemen</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
