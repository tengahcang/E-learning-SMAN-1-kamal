<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController as AdminGuru;
use App\Http\Controllers\Admin\KelasController as AdminKelas;
use App\Http\Controllers\Admin\MataPelajaranController as AdminMatPel;
use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
use App\Http\Controllers\Admin\RoomController as AdminRoom;
use App\Http\Controllers\Guru\AktivitasController as GuruAktivitas;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\TugasController as GuruTugas;
use App\Http\Controllers\Siswa\AktivitasController as SiswaAktivitas;
use App\Http\Controllers\Siswa\TugasController as SiswaTugas;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\SubmisionController as SiswaSubmision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/',[AdminDashboard::class,'index'])->name('admin');
    Route::get('/profile',[AdminDashboard::class,'index'])->name('profile');
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
    Route::get('/profile',[GuruDashboard::class,'index'])->name('teacher.profile');
    Route::get('matapelajaran/{id_room}', [GuruAktivitas::class, 'index'])->name('teacher.matapelajaran.index');
    Route::get('matapelajaran/{id_room}/create', [GuruAktivitas::class, 'create'])->name('teacher.matapelajaran.create');
    Route::resource('matapelajaran', GuruAktivitas::class)->except('index', 'create')->names(['index' => 'teacher.matapelajaran.index', 'create' => 'teacher.matapelajaran.create', 'store' => 'teacher.matapelajaran.store', 'show' => 'teacher.matapelajaran.show', 'edit' => 'teacher.matapelajaran.edit', 'update' => 'teacher.matapelajaran.update', 'destroy' => 'teacher.matapelajaran.destroy', ]);
    Route::get('tugas/create/{id_activity}/{id_room}',[GuruTugas::class,'create'])->name('teacher.tugas.create');
    Route::resource('tugas', GuruTugas::class)->except('create')->names([ 'index' => 'teacher.tugas.index', 'create' => 'teacher.tugas.create', 'store' => 'teacher.tugas.store', 'show' => 'teacher.tugas.show', 'edit' => 'teacher.tugas.edit', 'update' => 'teacher.tugas.update', 'destroy' => 'teacher.tugas.destroy', ]);

});
Route::middleware(['auth', 'role:siswa'])->prefix('student')->group(function () {
    Route::get('/', [SiswaDashboard::class,'index'])->name('siswa');
    Route::get('/profile',[SiswaDashboard::class,'profile'])->name('student.profile');
    Route::get('matapelajaran/{id_room}', [SiswaAktivitas::class, 'index'])->name('student.matapelajaran.index');
    Route::resource('tugas', SiswaTugas::class)->except('index', 'create')->names([ 'index' => 'student.tugas.index', 'create' => 'student.tugas.create', 'store' => 'student.tugas.store', 'show' => 'student.tugas.show', 'edit' => 'student.tugas.edit', 'update' => 'student.tugas.update', 'destroy' => 'student.tugas.destroy',]);
    Route::get('pengumpulan/{id_tugas}/create', [SiswaSubmision::class, 'create'])->name('student.pengumpulan.create');
    Route::resource('pengumpulan', SiswaSubmision::class)->except('create')->names([ 'index' => 'student.pengumpulan.index', 'create' => 'student.pengumpulan.create', 'store' => 'student.pengumpulan.store', 'show' => 'student.pengumpulan.show', 'edit' => 'student.pengumpulan.edit', 'update' => 'student.pengumpulan.update', 'destroy' => 'student.pengumpulan.destroy', ]);
    Route::put('/edit-file', [SiswaSubmision::class, 'updateFile'])->name('student.pengumpulan.updateFile');
    // Route::delete('/pengumpulan/delete-file/{id}', [SiswaSubmision::class, 'deleteFile'])->name('pengumpulan.deleteFile');
    Route::delete('/delete-file', [SiswaSubmision::class, 'destroyFile'])->name('student.pengumpulan.deleteFile');
    // web.php
    // Route::get('student/pengumpulan/clear-collection/{collectionName}', [SiswaSubmision::class, 'clearMediaCollection'])->name('student.pengumpulan.clearCollection');


});
