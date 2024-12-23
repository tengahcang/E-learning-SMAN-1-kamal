<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\GuruController as AdminGuru;
use App\Http\Controllers\Admin\KelasController as AdminKelas;
use App\Http\Controllers\Admin\MataPelajaranController as AdminMatPel;
use App\Http\Controllers\Admin\SiswaController as AdminSiswa;
use App\Http\Controllers\Admin\RoomController as AdminRoom;
use App\Http\Controllers\DownloadMediaController;
use App\Http\Controllers\Guru\AktivitasController as GuruAktivitas;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\MateriController as GuruMateri;
use App\Http\Controllers\Guru\SubmisionController as GuruSubmision;
use App\Http\Controllers\Guru\TugasController as GuruTugas;
use App\Http\Controllers\Siswa\AktivitasController as SiswaAktivitas;
use App\Http\Controllers\Siswa\TugasController as SiswaTugas;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\MateriController as SiswaMateri;
use App\Http\Controllers\Siswa\SubmisionController as SiswaSubmision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $user = Auth::user();

    if ($user) {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin');
            case 'guru':
                return redirect()->route('guru');
            case 'siswa':
                return redirect()->route('siswa');
        }
    } else {
        return redirect()->route('login');
    }
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin', 'activity'])->prefix('admin')->group(function () {
    Route::get('/',[AdminDashboard::class,'index'])->name('admin');
    Route::get('/profile',[AdminDashboard::class,'profile'])->name('profile');
    Route::post('/update-password', [AdminDashboard::class, 'updatePassword'])->name('update-password');
    Route::resource('students',AdminSiswa::class);
    Route::get('students/upload/form',[AdminSiswa::class, 'createImport'])->name('students.upload.form');
    Route::get('student/download-template',[AdminSiswa::class, 'downloadTemplate'])->name('students.download.form');
    Route::post('students/import',[AdminSiswa::class, 'import'])->name('students.import');
    Route::get('teachers/download-template', function() {
        $filePath = 'Template_data_guru.xlsx';
        $fileName = 'Template_data_guru.xlsx';
        $path = Storage::disk('local')->path($filePath);
        if (Storage::disk('local')->exists($filePath)) {
            return response()->download($path, $fileName);
        } else {
            return "File not found.";
        }
    })->name('teachers.download-template');
    Route::resource('teachers',AdminGuru::class);
    Route::get('teachers/upload/form',[AdminGuru::class, 'createImport'])->name('teachers.upload.form');
    Route::post('teachers/import',[AdminGuru::class, 'import'])->name('teachers.import');
    Route::resource('subjects',AdminMatPel::class);
    Route::resource('classes',AdminKelas::class);
    Route::resource('rooms',AdminRoom::class);
    Route::get('admin/rooms/{roomId}/exportAllTasksNilai', [GuruAktivitas::class, 'exportAllTasksNilai'])->name('admin.room.exportAllTasksNilai');
    Route::post('/reset-room-data', [AdminRoom::class, 'reset'])->name('reset.room.data');
});
Route::middleware(['auth', 'role:guru', 'activity'])->prefix('teacher')->group(function () {
    Route::get('/',[GuruDashboard::class,'index'])->name('guru');
    Route::get('/profile',[GuruDashboard::class,'profile'])->name('teacher.profile');
    Route::post('/update-password', [GuruDashboard::class, 'updatePassword'])->name('teacher.update-password');
    Route::get('matapelajaran/{id_room}', [GuruAktivitas::class, 'index'])->name('teacher.matapelajaran.index');
    Route::get('matapelajaran/{id_room}/create', [GuruAktivitas::class, 'create'])->name('teacher.matapelajaran.create');
    Route::resource('matapelajaran', GuruAktivitas::class)->except('index', 'create')->names([
        'index' => 'teacher.matapelajaran.index',
        'create' => 'teacher.matapelajaran.create',
        'store' => 'teacher.matapelajaran.store',
        'show' => 'teacher.matapelajaran.show',
        'edit' => 'teacher.matapelajaran.edit',
        'update' => 'teacher.matapelajaran.update',
        'destroy' => 'teacher.matapelajaran.destroy',
    ]);
    Route::get('materi/create/{id_activity}/{id_room}',[GuruMateri::class,'create'])->name('teacher.materi.create');
    Route::resource('materi', GuruMateri::class)->except('create')->names([
        'index' => 'teacher.materi.index',
        'create' => 'teacher.materi.create',
        'store' => 'teacher.materi.store',
        'show' => 'teacher.materi.show',
        'edit' => 'teacher.materi.edit',
        'update' => 'teacher.materi.update',
        'destroy' => 'teacher.materi.destroy',
    ]);
    Route::get('tugas/create/{id_activity}/{id_room}',[GuruTugas::class,'create'])->name('teacher.tugas.create');
    Route::resource('tugas', GuruTugas::class)->except('create')->names([
        'index' => 'teacher.tugas.index',
        'create' => 'teacher.tugas.create',
        'store' => 'teacher.tugas.store',
        'show' => 'teacher.tugas.show',
        'edit' => 'teacher.tugas.edit',
        'update' => 'teacher.tugas.update',
        'destroy' => 'teacher.tugas.destroy',
    ]);
    Route::get('/teacher/tugas/{task}/pengumpulan', [GuruSubmision::class, 'show'])->name('teacher.tugas.pengumpulan');
    Route::post('/teacher/tugas/{task}/pengumpulan/{submission}/nilai', [GuruSubmision::class, 'store'])->name('teacher.tugas.saveNilai');
    Route::post('/teacher/room/update-description', [GuruAktivitas::class, 'updateDescription'])->name('teacher.room.updateDescription');
    Route::get('/teacher/room/{room}/participant', [GuruAktivitas::class, 'participant'])->name('teacher.room.participant');
    Route::get('teacher/tugas/{task}/export-nilai', [GuruSubmision::class, 'exportNilai'])->name('teacher.tugas.exportNilai');
    Route::get('teacher/room/{roomId}/exportAllTasksNilai', [GuruAktivitas::class, 'exportAllTasksNilai'])->name('teacher.room.exportAllTasksNilai');


});
Route::middleware(['auth', 'role:siswa', 'activity'])->prefix('student')->group(function () {
    Route::get('/', [SiswaDashboard::class,'index'])->name('siswa');
    Route::get('/profile',[SiswaDashboard::class,'profile'])->name('student.profile');
    Route::post('/update-password', [SiswaDashboard::class, 'updatePassword'])->name('student.update-password');
    Route::get('matapelajaran/{id_room}', [SiswaAktivitas::class, 'index'])->name('student.matapelajaran.index');
    Route::resource('tugas', SiswaTugas::class)->except('index', 'create')->names([
        'index' => 'student.tugas.index',
        'create' => 'student.tugas.create',
        'store' => 'student.tugas.store',
        'show' => 'student.tugas.show',
        'edit' => 'student.tugas.edit',
        'update' => 'student.tugas.update',
        'destroy' => 'student.tugas.destroy',
    ]);
    Route::get('pengumpulan/{id_tugas}/create', [SiswaSubmision::class, 'create'])->name('student.pengumpulan.create');
    Route::resource('pengumpulan', SiswaSubmision::class)->except('create')->names([
        'index' => 'student.pengumpulan.index',
        'create' => 'student.pengumpulan.create',
        'store' => 'student.pengumpulan.store',
        'show' => 'student.pengumpulan.show',
        'edit' => 'student.pengumpulan.edit',
        'update' => 'student.pengumpulan.update',
        'destroy' => 'student.pengumpulan.destroy',
    ]);
    Route::resource('materi', SiswaMateri::class)->except('create')->names([
        'index' => 'student.materi.index',
        'create' => 'student.materi.create',
        'store' => 'student.materi.store',
        'show' => 'student.materi.show',
        'edit' => 'student.materi.edit',
        'update' => 'student.materi.update',
        'destroy' => 'student.materi.destroy',
    ]);
    Route::put('/edit-file', [SiswaSubmision::class, 'updateFile'])->name('student.pengumpulan.updateFile');
    Route::delete('/delete-file', [SiswaSubmision::class, 'destroyFile'])->name('student.pengumpulan.deleteFile');
    Route::get('/student/room/{room}/participant', [SiswaAktivitas::class, 'participant'])->name('student.room.participant');


});
Route::get('/download/{mediaItem}', [DownloadMediaController::class, 'show'])->name('download.media');
