<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $employee = Employee::create([
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email,
            'nomor_telepon'  => $request->nomor_telepon,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'tanggal_masuk'  => $request->tanggal_masuk,
            'status'         => $request->status,
            'departemen_id'  => $request->departemen_id,
            'jabatan_id'     => $request->jabatan_id,
        ]);


        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan & akun login berhasil dibuat!');
    }

    // SHOW bisa diakses semua
    public function show($id)
    {
        $employee = Employee::with(['department', 'position', 'latestSalary'])->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $oldEmail = $employee->email;

        $employee->update([
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email,
            'nomor_telepon'  => $request->nomor_telepon,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'tanggal_masuk'  => $request->tanggal_masuk,
            'status'         => $request->status,
            'departemen_id'  => $request->departemen_id,
            'jabatan_id'     => $request->jabatan_id,
        ]);

        $user = User::where('karyawan_id', $employee->id)->orWhere('email', $oldEmail)->first();
        if ($user) {
            $user->update([
                'email' => $request->email,
                'username' => $request->email,
            ]);
        }

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan & akun login berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);

        $user = User::where('karyawan_id', $employee->id)->orWhere('email', $employee->email)->first();
        if ($user) $user->delete();

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Karyawan & akun login berhasil dihapus!');
    }
}
