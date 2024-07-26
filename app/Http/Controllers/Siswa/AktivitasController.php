<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Room;
use App\Models\Aktivitas;
use App\Models\RoomSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
