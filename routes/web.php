<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController as AdminGuru;
use App\Http\Controllers\Admin\KelasController as AdminKelas;
use App\Http\Controllers\Admin\MataPelajaranController as AdminMatPel;
use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
use App\Http\Controllers\Admin\RoomController as AdminRoom;
use App\Http\Controllers\Guru\AktivitasController as GuruAktivitas;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\MataPelajaranController as GuruMatPel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/',[AdminDashboard::class,'index'])->name('admin');
    Route::resource('students',AdminSiswa::class);
    Route::get('students/upload/form',[AdminSiswa::class, 'createImport'])->name('students.upload.form');
    Route::post('students/upload/form',[AdminSiswa::class, 'uploadAndSetting'])->name('students.upload.form');
    Route::post('students/import',[AdminSiswa::class, 'import'])->name('students.import');
    Route::resource('teachers',AdminGuru::class);
    Route::resource('subjects',AdminMatPel::class);
    Route::resource('classes',AdminKelas::class);
    Route::resource('rooms',AdminRoom::class);
});
Route::middleware(['auth', 'role:guru'])->prefix('teacher')->group(function () {
    Route::get('/',[GuruDashboard::class,'index'])->name('guru');
    // Menambahkan parameter id_room pada rute matapelajaran.index
    Route::get('matapelajaran/{id_room}', [GuruAktivitas::class, 'index'])->name('matapelajaran.index');

    // Menambahkan parameter id_room pada rute untuk membuat aktivitas baru
    Route::get('matapelajaran/{id_room}/create', [GuruAktivitas::class, 'create'])->name('matapelajaran.create');

    // Menambahkan parameter id_room pada resource routes, kecuali index dan create
    Route::resource('matapelajaran', GuruAktivitas::class)->except('index', 'create');
});
Route::middleware(['auth', 'role:siswa'])->prefix('student')->group(function () {
    Route::get('/', function(){
        return view('siswa.dashboard');
    })->name('siswa');
});
