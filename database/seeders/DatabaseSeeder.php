<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default admin user
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Seed default departments if none exist
        if (Department::count() === 0) {
            Department::create(['nama_departemen' => 'IT']);
            Department::create(['nama_departemen' => 'HRD']);
            Department::create(['nama_departemen' => 'Keuangan']);
        }

        // Seed default positions if none exist
        if (Position::count() === 0) {
            Position::create(['nama_jabatan' => 'Staff IT', 'gaji_pokok' => 5000000]);
            Position::create(['nama_jabatan' => 'Staff HRD', 'gaji_pokok' => 4500000]);
            Position::create(['nama_jabatan' => 'Manager', 'gaji_pokok' => 8000000]);
        }
    }
}
