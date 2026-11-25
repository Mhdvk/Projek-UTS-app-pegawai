<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;

// ========================== ROOT REDIRECT ==========================
Route::get('/', function () {
    return auth()->check() ? redirect()->route('employees.index') : redirect()->route('login');
});

// ========================== AUTHENTICATION ==========================
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================== AUTHENTICATED ROUTES ==========================
Route::middleware('auth')->group(function () {

    // Dashboard / Employee list
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // ========================== ADMIN ROUTES ==========================
    Route::middleware('role:admin')->group(function () {

        // Employees CRUD
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        // Departments CRUD
        Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

        // Positions CRUD
        Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
        Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
        Route::put('/positions/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');

        // Salaries CRUD
        Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
        Route::post('/salaries', [SalaryController::class, 'store'])->name('salaries.store');
        Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
        Route::put('/salaries/{salary}', [SalaryController::class, 'update'])->name('salaries.update');
        Route::delete('/salaries/{salary}', [SalaryController::class, 'destroy'])->name('salaries.destroy');

        // Attendance CRUD (Admin)
        Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
        Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    });

    // ========================== ALL USERS ==========================
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::get('/positions/{position}', [PositionController::class, 'show'])->name('positions.show');
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::get('/salaries/{salary}', [SalaryController::class, 'show'])->name('salaries.show');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/{attendance}', [AttendanceController::class, 'show'])->name('attendance.show');

    // ========================== EMPLOYEE CHECK-IN / CHECK-OUT ==========================
    Route::post('/attendance/absen-masuk', [AttendanceController::class, 'absenMasuk'])->name('attendance.absen-masuk');
    Route::post('/attendance/absen-keluar', [AttendanceController::class, 'absenKeluar'])->name('attendance.absen-keluar');
});
