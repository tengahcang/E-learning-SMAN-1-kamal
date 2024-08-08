<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\RoomSiswa;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $id_siswa = $user->id_siswa;

        // Cari semua entri RoomSiswa yang terkait dengan siswa ini
        $room_siswas = RoomSiswa::where('id_siswa', $id_siswa)
            ->with(['room.class', 'room.subject', 'room.teacher'])
            ->get();

        // Ambil informasi dari ruangan yang ditemukan
        $kelas_siswa = [];
        $tasks_due_today = [];
        $tasks_due_7_days = [];
        $tasks_due_30_days = [];
        $today = Carbon::now()->startOfDay();
        $next_7_days = Carbon::now()->addDays(7)->endOfDay();
        $next_30_days = Carbon::now()->addDays(30)->endOfDay();
        // foreach ($room_siswas as $room_siswa) {
        //     $kelas_siswa[] = $room_siswa->room;
        // }
        foreach ($room_siswas as $room_siswa) {
            $kelas_siswa[] = $room_siswa->room;
            $id_room = $room_siswa->room->id;

            // Cari aktivitas yang terkait dengan room ini
            $activities = Aktivitas::where('id_room', $id_room)
                ->with('tasks', 'room.subject')
                ->get();
            // dd($activities);
            foreach ($activities as $activity) {
                // dd($activity->room);
                foreach ($activity->tasks as $task) {
                    $deadline = Carbon::parse($task->deadline);
                    $task->parsed_deadline = $deadline;
                    $task->subject_name = $activity->room->subject->name;
                    if ($deadline->isToday()) {
                        $tasks_due_today[] = $task;
                    } elseif ($deadline->between($today, $next_7_days)) {
                        $tasks_due_7_days[] = $task;
                    } elseif ($deadline->between($today, $next_30_days)) {
                        $tasks_due_30_days[] = $task;
                    }
                }
            }
        }

        // dd($task);

        return view('siswa.dashboard', compact('user', 'kelas_siswa', 'room_siswas', 'tasks_due_today', 'tasks_due_7_days', 'tasks_due_30_days'));
    }
    public function profile(){
        $user = Auth::user();
        $id_siswa = $user->id_siswa;
        $profile = Siswa::find($id_siswa);
        $room_siswas = RoomSiswa::where('id_siswa', $id_siswa)
            ->with(['room.class', 'room.subject', 'room.teacher'])
            ->get();
        // dd($profile);
        return view('siswa.profile',compact('profile', 'room_siswas'));

    }
    public function updatePassword(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Periksa apakah password dan konfirmasi password sama
        if ($request->password === $request->password_confirmation) {
            // Dapatkan pengguna yang sedang login
            $user = Auth::user();

            // Ubah password pengguna
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
