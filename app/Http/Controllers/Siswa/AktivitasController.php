<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Room;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    //
    public function index(string $id)
    {
        //
        // dd($id);
        $activities = Aktivitas::where('id_room', $id)->with('tasks')->get();
        $room = Room::find($id);
        return view('siswa.aktivitas.index',compact('activities','room'));
    }
}
