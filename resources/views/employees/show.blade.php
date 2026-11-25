@extends('master')

@section('title', 'Detail Pegawai - ' . $employee->nama_lengkap)

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">{{ $employee->nama_lengkap }}</h1>
        <p style="color: var(--color-text-muted); font-size: 0.875rem; margin-top: 0.25rem;">
            {{ $employee->position->nama_jabatan ?? 'Tanpa Jabatan' }} &bull; {{ $employee->department->nama_departemen ?? 'Tanpa Departemen' }}
        </p>
    </div>
    <div class="page-actions">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            &larr; Kembali
        </a>
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                Edit Pegawai
            </a>
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                    Hapus
                </button>
            </form>
        @endif
    </div>
</div>

<div class="app-card form-container">
    <div class="app-card-header">
        <h2 class="app-card-title">Informasi Lengkap Pegawai</h2>
        @if(strtolower($employee->status) === 'aktif')
            <span class="badge badge-success">Aktif</span>
        @else
            <span class="badge badge-danger">Nonaktif</span>
        @endif
    </div>
    <div class="app-card-body" style="padding: 0;">
        <table class="detail-table">
            <tbody>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $employee->nomor_telepon ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $employee->tanggal_lahir ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $employee->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ $employee->tanggal_masuk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Departemen</th>
                    <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Gaji Pokok Jabatan</th>
                    <td style="font-variant-numeric: tabular-nums;">
                        Rp {{ number_format($employee->position->gaji_pokok ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Bulan Transaksi Terakhir</th>
                    <td>{{ $employee->latestSalary->bulan ?? 'Belum ada data' }}</td>
                </tr>
                <tr>
                    <th>Tunjangan Terakhir</th>
                    <td style="font-variant-numeric: tabular-nums;">
                        Rp {{ number_format($employee->latestSalary->tunjangan ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Potongan Terakhir</th>
                    <td style="font-variant-numeric: tabular-nums;">
                        Rp {{ number_format($employee->latestSalary->potongan ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="highlight-row">
                    <th>Total Gaji Diterima</th>
                    <td style="font-variant-numeric: tabular-nums;">
                        Rp {{ number_format($employee->total_gaji ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
