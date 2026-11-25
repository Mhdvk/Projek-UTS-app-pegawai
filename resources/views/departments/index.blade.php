@extends('master')

@section('title', 'Daftar Departemen')

@section('content')
<div class="page-header">
    <h1 class="page-title">Daftar Departemen</h1>
    @if(auth()->user()?->role === 'admin')
        <div class="page-actions">
            <a href="{{ route('departments.create') }}" class="btn btn-primary">
                + Tambah Departemen
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
                    <th>Nama Departemen</th>
                    @if(auth()->user()?->role === 'admin')
                        <th style="text-align: right; width: 140px;">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $dept)
                    <tr>
                        <td style="color: var(--color-text-subtle);">#{{ $dept->id }}</td>
                        <td style="font-weight: 600;">{{ $dept->nama_departemen }}</td>
                        @if(auth()->user()?->role === 'admin')
                            <td>
                                <div class="table-actions" style="justify-content: flex-end;">
                                    <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus departemen ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="table-empty">Belum ada departemen yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
