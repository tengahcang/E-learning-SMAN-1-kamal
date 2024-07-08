<?php

use App\Http\Controllers\Admin\GuruController as AdminGuru;
use App\Http\Controllers\Admin\KelasController as AdminKelas;
use App\Http\Controllers\Admin\MataPelajaranController as AdminMatPel;
use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
use App\Http\Controllers\Admin\RoomController as AdminRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('admin');
    Route::resource('students',AdminSiswa::class);
    Route::resource('teachers',AdminGuru::class);
    Route::resource('subjects',AdminMatPel::class);
    Route::resource('classes',AdminKelas::class);
    Route::resource('rooms',AdminRoom::class);
});
Route::middleware(['auth', 'role:guru'])->prefix('teacher')->group(function () {
    Route::get('/', function(){
        return view('guru.dashboard');
    })->name('guru');
});
Route::middleware(['auth', 'role:siswa'])->prefix('student')->group(function () {
    Route::get('/', function(){
        return view('siswa.dashboard');
    })->name('siswa');
});
