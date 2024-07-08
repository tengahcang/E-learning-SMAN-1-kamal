<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
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
        // dd($teachers);
        return view('admin.dashboard', [
            'teachers' => $teachers,
            'teacherCount' => $teacherCount,
            'students' => $students,
            'studentCount' => $studentCount,
        ]);
    }
}
