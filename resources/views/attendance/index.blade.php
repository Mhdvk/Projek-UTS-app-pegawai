@extends('master')

@section('title', 'Data Absensi')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Absensi</h1>
        <p style="color: var(--color-text-muted); font-size: 0.875rem; margin-top: 0.25rem;">
            Catatan kehadiran pegawai harian
        </p>
    </div>
    <div class="page-actions">
        @if(auth()->user()->role === 'employee')
            <form action="{{ route('attendance.absen-masuk') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Absen Masuk (Check-In)</button>
            </form>
            <form action="{{ route('attendance.absen-keluar') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary">Absen Keluar (Check-Out)</button>
            </form>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('attendance.create') }}" class="btn btn-primary">
                + Tambah Absensi
            </a>
        @endif
    </div>
</div>

<div class="app-card">
    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Karyawan</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    @if(auth()->user()->role === 'admin')
                        <th style="text-align: right; width: 140px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($attendance as $att)
                    <tr>
                        <td style="font-weight: 600;">
                            {{ $att->employee ? $att->employee->nama_lengkap : '-' }}
                        </td>
                        <td>{{ $att->tanggal }}</td>
                        <td style="font-variant-numeric: tabular-nums;">{{ $att->waktu_masuk ?? '-' }}</td>
                        <td style="font-variant-numeric: tabular-nums;">{{ $att->waktu_keluar ?? '-' }}</td>
                        <td>
                            @php
                                $status = strtolower($att->status_absensi ?? '');
                            @endphp
                            @if($status === 'hadir')
                                <span class="badge badge-success">Hadir</span>
                            @elseif($status === 'izin' || $status === 'sakit')
                                <span class="badge badge-warning">{{ ucfirst($status) }}</span>
                            @elseif($status === 'alpha')
                                <span class="badge badge-danger">Alpha</span>
                            @else
                                <span class="badge badge-neutral">{{ ucfirst($att->status_absensi ?? '-') }}</span>
                            @endif
                        </td>
                        @if(auth()->user()->role === 'admin')
                            <td>
                                <div class="table-actions" style="justify-content: flex-end;">
                                    <a href="{{ route('attendance.edit', $att->id) }}" class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('attendance.destroy', $att->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data absensi ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="table-empty">
                            Belum ada riwayat absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
