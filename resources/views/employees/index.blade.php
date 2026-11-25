@extends('master')

@section('title', 'Daftar Pegawai')

@section('content')
<div class="page-header">
    <h1 class="page-title">Daftar Pegawai</h1>
    @if(auth()->user()?->role === 'admin')
        <div class="page-actions">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                + Tambah Pegawai
            </a>
        </div>
    @endif
</div>

<div class="app-card">
    <div class="table-responsive">
        <table class="app-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td style="font-weight: 600;">{{ $employee->nama_lengkap }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->nomor_telepon }}</td>
                        <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                        <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                        <td>{{ $employee->tanggal_masuk }}</td>
                        <td>
                            @if(strtolower($employee->status) === 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions" style="justify-content: flex-end;">
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-secondary">
                                    Detail
                                </a>

                                @if(auth()->user()?->role === 'admin')
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="table-empty">Belum ada data pegawai yang tersimpan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
