@extends('master')

@section('title', 'Daftar Gaji')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Daftar Penggajian</h1>
        <p style="color: var(--color-text-muted); font-size: 0.875rem; margin-top: 0.25rem;">
            Catatan transaksi penggajian pegawai
        </p>
    </div>
    @if(auth()->user()?->role === 'admin')
        <div class="page-actions">
            <a href="{{ route('salaries.create') }}" class="btn btn-primary">
                + Tambah Gaji
            </a>
        </div>
    @endif
</div>

<div class="app-card">
    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Bulan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    @if(auth()->user()?->role === 'admin')
                        <th style="text-align: right; width: 140px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($salaries as $salary)
                    <tr>
                        <td style="color: var(--color-text-subtle);">#{{ $salary->id }}</td>
                        <td style="font-weight: 600;">{{ optional($salary->employee)->nama_lengkap ?? '-' }}</td>
                        <td>{{ optional($salary->employee?->position)->nama_jabatan ?? '-' }}</td>
                        <td>{{ $salary->bulan }}</td>
                        <td style="font-variant-numeric: tabular-nums;">
                            Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}
                        </td>
                        <td style="font-variant-numeric: tabular-nums;">
                            Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}
                        </td>
                        <td style="font-variant-numeric: tabular-nums; color: var(--color-danger);">
                            Rp {{ number_format($salary->potongan, 0, ',', '.') }}
                        </td>
                        <td style="font-weight: 700; font-variant-numeric: tabular-nums; color: var(--color-success);">
                            Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                        </td>
                        @if(auth()->user()?->role === 'admin')
                            <td>
                                <div class="table-actions" style="justify-content: flex-end;">
                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data gaji ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()?->role === 'admin' ? 9 : 8 }}" class="table-empty">
                            Belum ada catatan penggajian yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
