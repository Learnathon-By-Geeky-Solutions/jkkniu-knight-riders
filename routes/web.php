<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->middleware(['auth', 'verified', 'superadmin'])->name('superadmin.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
})->middleware(['auth', 'verified', 'doctor'])->name('doctor.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'patient'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/manage-users/doctors', 'manageDoctors')->name('admin.manage-users.doctors');
    Route::get('/manage-users/patients', 'managePatients')->name('admin.manage-users.patients');
    Route::get('/manage-users/{user}/edit', 'editUser')->name('admin.manage-users.edit');
    Route::put('/manage-users/{user}/update', 'updateUser')->name('admin.manage-users.update');
    Route::delete('/manage-users/{user}/delete', 'deleteUser')->name('admin.manage-users.delete');
})->middleware(['auth', 'verified', 'admin']);

Route::controller(SuperAdminController::class)->prefix('superadmin')->group(function () {
    Route::get('/manage-users/admins', 'manageAdmins')->name('superadmin.manage-users.admins');
    Route::get('/manage-users/doctors', 'manageDoctors')->name('superadmin.manage-users.doctors');
    Route::get('/manage-users/patients', 'managePatients')->name('superadmin.manage-users.patients');
    Route::get('/manage-users/{user}/edit', 'editUser')->name('superadmin.manage-users.edit');
    Route::put('/manage-users/{user}/update', 'updateUser')->name('superadmin.manage-users.update');
    Route::delete('/manage-users/{user}/delete', 'deleteUser')->name('superadmin.manage-users.delete');
})->middleware(['auth', 'verified', 'superadmin']);

require __DIR__.'/auth.php';
