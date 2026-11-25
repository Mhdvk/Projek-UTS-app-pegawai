@extends('master')

@section('title', 'Input Absensi')

@section('content')
<div class="page-header">
    <h1 class="page-title">Absensi Pegawai</h1>
</div>

@if(auth()->user()->role === 'employee')
    <div class="app-card form-container">
        <div class="app-card-body" style="text-align: center; padding: 2.5rem 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                Halo, {{ auth()->user()->employee->nama_lengkap ?? auth()->user()->name }}
            </h2>
            <p style="color: var(--color-text-muted); font-size: 0.9375rem; margin-bottom: 1.5rem;">
                Silakan lakukan pencatatan kehadiran kerja Anda untuk hari ini.
            </p>

            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <form action="{{ route('attendance.absen-masuk') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">
                        Absen Masuk (Check-In)
                    </button>
                </form>

                <form action="{{ route('attendance.absen-keluar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary" style="padding: 0.75rem 1.5rem;">
                        Absen Keluar (Check-Out)
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->role === 'admin')
    <div class="app-card form-container">
        <div class="app-card-body">
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="karyawan_id" class="form-label form-label-required">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }} ({{ $emp->department->nama_departemen ?? 'Tanpa Departemen' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tanggal" class="form-label form-label-required">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status_absensi" class="form-label form-label-required">Status Kehadiran</label>
                        <select id="status_absensi" name="status_absensi" class="form-control" required>
                            <option value="hadir" {{ old('status_absensi') === 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ old('status_absensi') === 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ old('status_absensi') === 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpha" {{ old('status_absensi') === 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                        <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk') }}">
                    </div>

                    <div class="form-group">
                        <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                        <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar') }}">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                    <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endif
@endsection
