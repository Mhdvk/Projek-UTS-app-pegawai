<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employee;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user langsung berdasarkan email atau username
        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)
            ->first();

        // Jika tidak ditemukan di tabel users, cari via tabel employees
        if (!$user) {
            $employee = Employee::where('email', $request->email)->first();
            if ($employee) {
                $user = User::where('karyawan_id', $employee->id)->first();
            }
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Password salah atau user tidak ada
            return back()->withInput()->with('error', 'Email atau password salah.');
        }

        // Login user
        Auth::login($user);

        // Redirect ke halaman dashboard / employees dengan notifikasi sukses
        return redirect()->route('employees.index')->with('success', 'Login berhasil!');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}
