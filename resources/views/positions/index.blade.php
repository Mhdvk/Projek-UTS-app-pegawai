@extends('master')

@section('title', 'Daftar Jabatan')

@section('content')
<div class="page-header">
    <h1 class="page-title">Daftar Jabatan</h1>
    @if(auth()->user()?->role === 'admin')
        <div class="page-actions">
            <a href="{{ route('positions.create') }}" class="btn btn-primary">
                + Tambah Jabatan
            </a>
        </div>
    @endif
</div>

<div class="app-card">
    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    @if(auth()->user()?->role === 'admin')
                        <th style="text-align: right; width: 140px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($positions as $pos)
                    <tr>
                        <td style="color: var(--color-text-subtle);">#{{ $pos->id }}</td>
                        <td style="font-weight: 600;">{{ $pos->nama_jabatan }}</td>
                        <td style="font-variant-numeric: tabular-nums;">
                            Rp {{ number_format($pos->gaji_pokok, 0, ',', '.') }}
                        </td>
                        @if(auth()->user()?->role === 'admin')
                            <td>
                                <div class="table-actions" style="justify-content: flex-end;">
                                    <a href="{{ route('positions.edit', $pos->id) }}" class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('positions.destroy', $pos->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jabatan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="table-empty">Belum ada jabatan yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
