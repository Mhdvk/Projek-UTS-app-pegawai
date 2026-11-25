@extends('master')

@section('title', 'Edit Departemen')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Departemen</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_departemen" class="form-label form-label-required">Nama Departemen</label>
                <input type="text" name="nama_departemen" id="nama_departemen" class="form-control"
                       value="{{ old('nama_departemen', $department->nama_departemen) }}" required autofocus>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
