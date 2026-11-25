<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        // 1. Cari employee berdasarkan email
        $employee = Employee::where('email', $request->email)->first();

        if (!$employee) {
            return back()
                ->withErrors(['email' => 'Email ini belum didaftarkan oleh admin.'])
                ->withInput();
        }

        // 2. Cek apakah sudah punya akun di users
        if (User::where('karyawan_id', $employee->id)->exists()) {
            return back()
                ->withErrors(['email' => 'Akun sudah pernah dibuat.'])
                ->withInput();
        }

        // 3. Buat user baru terkait employee
        User::create([
            'username' => $employee->email, // atau bisa ganti sesuai kebutuhan
            'email' => $employee->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'karyawan_id' => $employee->id,
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
