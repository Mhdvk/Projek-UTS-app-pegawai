@extends('master')

@section('title', 'Edit Data Absensi')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Data Absensi</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="karyawan_id" class="form-label form-label-required">Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" {{ $attendance->karyawan_id == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal" class="form-label form-label-required">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $attendance->tanggal) }}" required>
                </div>

                <div class="form-group">
                    <label for="status_absensi" class="form-label form-label-required">Status Kehadiran</label>
                    <select id="status_absensi" name="status_absensi" class="form-control" required>
                        @foreach (['hadir', 'izin', 'sakit', 'alpha'] as $status)
                            <option value="{{ $status }}" {{ old('status_absensi', $attendance->status_absensi) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                    <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}">
                </div>

                <div class="form-group">
                    <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                    <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
