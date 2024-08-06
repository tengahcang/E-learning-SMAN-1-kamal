<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Room;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function profile(){
        $user = Auth::user();
        // $id_guru = $user->id_guru;
        // $profile = Guru::find($id_guru);
        // $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        // dd($profile);
        return view('admin.profile',compact('user'));
    }
    public function updatePassword(Request $request)
    {
        // Validasi input dasar
        // dd($request);
        $request->validate([
            'username' => 'required',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Periksa apakah password dan konfirmasi password sama
        if ($request->password === $request->password_confirmation) {
            // Dapatkan pengguna yang sedang login
            $user = Auth::user();

            // Ubah password pengguna
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } else {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Password dan konfirmasi password tidak sama.');
        }
    }
}
