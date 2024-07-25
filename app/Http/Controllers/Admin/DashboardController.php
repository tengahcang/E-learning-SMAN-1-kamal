<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Room;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {
        $teachers = Guru::all();
        $teacherCount = $teachers->count();
        $students = Siswa::all();
        $studentCount = $students->count();
        $classes = Kelas::all();
        $matpels  = MataPelajaran::all();
        $rooms = Room::with(['subject', 'class', 'teacher', 'students'])->get();

        // dd($teachers);
        return view('admin.dashboard', [
            'teachers' => $teachers,
            'teacherCount' => $teacherCount,
            'students' => $students,
            'studentCount' => $studentCount,
            'classes' => $classes,
            'matpels' => $matpels,
            'rooms' => $rooms
        ]);
    }
}
