<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Room;
use App\Models\Aktivitas;
use App\Models\RoomSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    //
    public function index(string $id)
    {
        //
        // dd($id);
        $room_siswas = RoomSiswa::where('id_siswa', $id)
        ->with(['room.class', 'room.subject', 'room.teacher'])
        ->get();

        $activities = Aktivitas::where('id_room', $id)->with('tasks', 'subject_matter')->get();
        $room = Room::find($id);
        return view('siswa.aktivitas.index',compact('activities','room' , 'room_siswas'));
    }
    public function participant(string $id)
    {
        $user = Auth::user();
        $id_siswa = $user->id_siswa;
        $room_siswas = RoomSiswa::where('id_siswa', $id_siswa)
        ->with(['room.class', 'room.subject', 'room.teacher'])
        ->get();
        $participant = Room::where('id', $id)->with('subject', 'class', 'teacher')->first();
        $students_room = Room::with('students')->find($id);
        // dd($participant);
        return view('siswa.peserta.index',compact('room_siswas','participant','students_room'));
    }
}
