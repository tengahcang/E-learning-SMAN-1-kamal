<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\RoomSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        foreach ($room_siswas as $room_siswa) {
            $kelas_siswa[] = $room_siswa->room;
        }

        // dd($kelas_siswa);

        return view('siswa.dashboard', compact('user', 'kelas_siswa'));
    }
    public function profile(){
        $user = Auth::user();
        $id_siswa = $user->id_siswa;
        $profile = Siswa::find($id_siswa);
        // dd($profile);
        return view('siswa.profile',compact('profile'));

    }
}
