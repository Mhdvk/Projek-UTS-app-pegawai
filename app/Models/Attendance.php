<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
    public static function checkStatus($waktuMasuk) {
    $jamMasuk = \Carbon\Carbon::createFromTime(7, 0, 0); // jam 07:00
    $waktuMasuk = \Carbon\Carbon::parse($waktuMasuk);

    return $waktuMasuk->gt($jamMasuk->addMinutes(15)) ? 'Alpha' : 'Hadir';
}

}
