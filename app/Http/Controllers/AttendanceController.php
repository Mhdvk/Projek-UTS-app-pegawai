<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // ====================== Semua user ======================
    public function index() {
        if (Auth::user()->role === 'employee') {
            $employeeId = Auth::user()->employee->id;
            $attendance = Attendance::where('karyawan_id', $employeeId)
                            ->orderBy('tanggal', 'desc')
                            ->get();
        } else {
            $attendance = Attendance::with('employee')->orderBy('tanggal', 'desc')->get();
        }

        return view('attendance.index', compact('attendance'));
    }

    public function show(Attendance $attendance) {
        return view('attendance.show', compact('attendance'));
    }

    // ====================== Employee ======================
    public function absenMasuk() {
        $employeeId = Auth::user()->employee->id;
        $tanggalHariIni = Carbon::today()->toDateString();
        $waktuSekarang = Carbon::now()->toTimeString();

        $absenHariIni = Attendance::firstOrNew([
            'karyawan_id' => $employeeId,
            'tanggal' => $tanggalHariIni
        ]);

        if ($absenHariIni->waktu_masuk) {
            return redirect()->back()->with('error', 'Kamu sudah absen masuk hari ini!');
        }

        $absenHariIni->waktu_masuk = $waktuSekarang;
        $absenHariIni->status_absensi = $this->determineStatus($waktuSekarang);
        $absenHariIni->save();

        return redirect()->back()->with('success', "Check-In berhasil dicatat! Status: $absenHariIni->status_absensi");
    }

    public function absenKeluar() {
        $employeeId = Auth::user()->employee->id;
        $tanggalHariIni = Carbon::today()->toDateString();
        $absenHariIni = Attendance::where('karyawan_id', $employeeId)
            ->where('tanggal', $tanggalHariIni)
            ->first();

        if (!$absenHariIni || !$absenHariIni->waktu_masuk) {
            return redirect()->back()->with('error', 'Kamu belum absen masuk hari ini!');
        }

        if ($absenHariIni->waktu_keluar) {
            return redirect()->back()->with('error', 'Kamu sudah absen keluar hari ini!');
        }

        $absenHariIni->waktu_keluar = Carbon::now()->toTimeString();
        $absenHariIni->save();

        return redirect()->back()->with('success', 'Check-Out berhasil dicatat!');
    }

    private function determineStatus($waktuMasuk) {
        $jamMasuk = Carbon::createFromTime(7, 0, 0); // 07:00
        $waktuMasuk = Carbon::parse($waktuMasuk);

        return $waktuMasuk->gt($jamMasuk->addMinutes(15)) ? 'Alpha' : 'Hadir';
    }

    // ====================== Admin ======================
    public function create() {
        $employees = Employee::all();
        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request) {
        Attendance::create($request->all());
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil ditambahkan!');
    }

    public function edit(Attendance $attendance) {
        $employees = Employee::all();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance) {
        $attendance->update($request->only([
            'karyawan_id', 
            'tanggal', 
            'waktu_masuk', 
            'waktu_keluar', 
            'status_absensi'
        ]));
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil diperbarui!');
    }

    public function destroy(Attendance $attendance) {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil dihapus!');
    }
}
