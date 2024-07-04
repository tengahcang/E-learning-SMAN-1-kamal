<?php

use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
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
