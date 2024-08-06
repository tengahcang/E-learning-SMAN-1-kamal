<?php

namespace App\Http\Controllers\Guru;

use App\Exports\SemuaPengumpulanExport;
use App\Models\Room;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        //
        // dd($id);
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        $activities = Aktivitas::where('id_room', $id)->with('tasks', 'subject_matter')->get();
        $room = Room::find($id);
        return view('guru.aktivitas.index',compact('activities','room','rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        return view('guru.aktivitas.create',compact('id','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $activity = New Aktivitas();
        $activity->id_room = $request->room;
        $activity->name = $request->name;
        $activity->save();
        return redirect()->route('teacher.matapelajaran.index', ['id_room' => $request->room]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        $activity = Aktivitas::find($id);
        return view('guru.aktivitas.edit',compact('rooms','activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $activity = Aktivitas::find($id);
        $activity->id_room = $request->room;
        $activity->name = $request->name;
        $activity->save();
        return redirect()->route('teacher.matapelajaran.index', ['id_room' => $request->room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $activity = Aktivitas::find($id);
            $room = $activity->id_room;
            $activity->delete();
            return redirect()->route('teacher.matapelajaran.index', ['id_room' => $room]);
        } catch (QueryException $e) {
            return redirect()->route('teacher.matapelajaran.index', ['id_room' => $activity->id_room])
                ->with('error', 'Data aktivitas tidak bisa dihapus karena ada tugas dan materi di dalamnya.');
        }
    }
    public function updateDescription(Request $request)
    {
        // dd($request);
        $room = Room::find($request->id);
        $room->description = $request->description;
        $room->save();
        return redirect()->route('teacher.matapelajaran.index', ['id_room' => $request->id]);
    }
    public function participant(string $id)
    {
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        $participant = Room::where('id', $id)->with('subject', 'class', 'teacher')->first();
        $students_room = Room::with('students')->find($id);
        // dd($participant);
        return view('guru.peserta.index',compact('rooms','participant','students_room'));
    }
    public function exportAllTasksNilai($roomId)
    {
        $room = Room::with('class', 'subject')->findOrFail($roomId);
        $fileName = 'semua_nilai_tugas (' .  $room->subject->name . '_' . $room->class->name . ').xlsx';
        return Excel::download(new SemuaPengumpulanExport($roomId), $fileName);
    }
}
