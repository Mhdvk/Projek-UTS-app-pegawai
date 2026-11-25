@extends('master')

@section('title', 'Data Absensi')

@section('content')
    @vite('resources/css/attendance-index.css')

    <div class="container">
        <h1>Data Absensi</h1>

        @if(auth()->user()->role === 'employee')
            <div class="btn-group">
                {{-- Check-In --}}
                <form action="{{ route('attendance.absen-masuk') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-absen">Absen Masuk</button>
                </form>

                {{-- Check-Out --}}
                <form action="{{ route('attendance.absen-keluar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-absen">Absen Keluar</button>
                </form>
            </div>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('attendance.create') }}" class="btn btn-add">+ Tambah Absensi</a>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Karyawan</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendance as $att)
                    <tr>
                        <td>{{ $att->employee ? $att->employee->nama_lengkap : '-' }}</td>
                        <td>{{ $att->tanggal }}</td>
                        <td>{{ $att->waktu_masuk ?? '-' }}</td>
                        <td>{{ $att->waktu_keluar ?? '-' }}</td>
                        <td>{{ ucfirst($att->status_absensi ?? '-') }}</td>
                        <td class="td-actions">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('attendance.edit', $att->id) }}" class="btn-action btn-edit">Edit</a>
                                <form action="{{ route('attendance.destroy', $att->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:15px; color:#666;">Tidak ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
