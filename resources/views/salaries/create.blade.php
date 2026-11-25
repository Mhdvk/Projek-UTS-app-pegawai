@extends('master')

@section('title', 'Tambah Data Gaji')

@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Data Gaji Pegawai</h1>
</div>

<div class="app-card form-container">
    <div class="app-card-body">
        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="karyawan_id" class="form-label form-label-required">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->nama_lengkap }} ({{ $emp->position->nama_jabatan ?? 'Tanpa Jabatan' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="bulan" class="form-label form-label-required">Periode Bulan</label>
                    <input type="text" id="bulan" name="bulan" class="form-control" placeholder="Contoh: November 2026" value="{{ old('bulan') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="gaji_pokok" class="form-label form-label-required">Gaji Pokok (Rp)</label>
                    <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" placeholder="Terisi otomatis" readonly required>
                </div>

                <div class="form-group">
                    <label for="tunjangan" class="form-label form-label-required">Tunjangan (Rp)</label>
                    <input type="number" step="1000" id="tunjangan" name="tunjangan" class="form-control" placeholder="0" value="{{ old('tunjangan', 0) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="potongan" class="form-label">Potongan (Rp)</label>
                <input type="number" step="1000" id="potongan" name="potongan" class="form-control" placeholder="0" value="{{ old('potongan', 0) }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data Gaji</button>
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    const employees = @json($employees);
    const gajiInput = document.getElementById('gaji_pokok');
    const selectKaryawan = document.getElementById('karyawan_id');

    selectKaryawan.addEventListener('change', function() {
        const empId = parseInt(this.value);
        const emp = employees.find(e => e.id === empId);
        if (emp && emp.position) {
            gajiInput.value = emp.position.gaji_pokok;
        } else {
            gajiInput.value = '';
        }
    });

    if (selectKaryawan.value) {
        selectKaryawan.dispatchEvent(new Event('change'));
    }
</script>
@endsection
