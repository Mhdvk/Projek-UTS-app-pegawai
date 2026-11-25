@extends('master')

@section('title', 'Edit Data Gaji')

@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Data Gaji Pegawai</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="karyawan_id" class="form-label form-label-required">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ $salary->karyawan_id == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }} ({{ $emp->position->nama_jabatan ?? 'Tanpa Jabatan' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="bulan" class="form-label form-label-required">Periode Bulan</label>
                    <input type="text" id="bulan" name="bulan" class="form-control" value="{{ old('bulan', $salary->bulan) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="gaji_pokok" class="form-label form-label-required">Gaji Pokok (Rp)</label>
                    <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" required>
                </div>

                <div class="form-group">
                    <label for="tunjangan" class="form-label form-label-required">Tunjangan (Rp)</label>
                    <input type="number" step="1000" id="tunjangan" name="tunjangan" class="form-control" value="{{ old('tunjangan', $salary->tunjangan) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="potongan" class="form-label">Potongan (Rp)</label>
                <input type="number" step="1000" id="potongan" name="potongan" class="form-control" value="{{ old('potongan', $salary->potongan) }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
