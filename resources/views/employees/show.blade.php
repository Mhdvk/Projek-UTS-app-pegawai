<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f7fb;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 70%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007bff;
            color: white;
            text-align: left;
            padding: 12px;
            width: 30%;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:last-child td {
            border-bottom: none;
        }

        a {
            display: inline-block;
            margin: 20px 5px 0 0;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #0056b3;
        }

        .total-gaji {
            font-weight: bold;
            background-color: #f0f8ff;
        }

        .action-buttons {
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>

<body>
    <h1>Detail Pegawai</h1>
    <table>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $employee->nama_lengkap }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $employee->email }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $employee->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $employee->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $employee->alamat }}</td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td>{{ $employee->tanggal_masuk }}</td>
        </tr>
        <tr>
            <th>Departemen</th>
            <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jabatan/Posisi</th>
            <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $employee->status }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok (Berdasarkan Jabatan)</th>
            <td>Rp {{ number_format($employee->position->gaji_pokok ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Bulan Transaksi Gaji Terakhir</th>
            <td>{{ $employee->latestSalary->bulan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tunjangan</th>
            <td>Rp {{ number_format($employee->latestSalary->tunjangan ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Potongan</th>
            <td>Rp {{ number_format($employee->latestSalary->potongan ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr class="total-gaji">
            <th>Total Gaji Diterima</th>
            <td>Rp {{ number_format($employee->total_gaji ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="action-buttons">
        {{-- Semua bisa kembali ke list --}}
        <a href="{{ route('employees.index') }}">← Kembali ke Daftar Pegawai</a>

        {{-- Tombol CRUD hanya muncul untuk admin --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('employees.edit', $employee->id) }}">Edit</a>

            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding:8px 12px; background:#dc3545; color:white; border:none; border-radius:4px; cursor:pointer;">Hapus</button>
            </form>
        @endif
    </div>
</body>

</html>
