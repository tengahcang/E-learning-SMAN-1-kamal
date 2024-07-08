<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Room;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rooms = Room::all();
        // dd($rooms);
        return view('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjects = MataPelajaran::all();
        $classes = Kelas::all();
        $teachers = Guru::all();
        return view('admin.room.create',compact('subjects','classes','teachers'));
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
            'subject' => 'required',
            'class' => 'required',
            'teacher' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $room = New Room();
        $room->id_matpel = $request->subject;
        $room->id_kelas = $request->class;
        $room->id_guru = $request->teacher;
        $room->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $room = Room::find($id);
        $room = Room::with('students')->find($id);
        $subjects = MataPelajaran::all();
        $classes = Kelas::all();
        $teachers = Guru::all();
        return view('admin.room.show',compact('room','subjects','classes','teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $room = Room::find($id);
        $subjects = MataPelajaran::all();
        $classes = Kelas::all();
        $teachers = Guru::all();
        $students = Siswa::all();
        $selectedStudents = $room->students->pluck('id')->toArray();
        return view('admin.room.edit',compact('room','subjects','classes','teachers','students','selectedStudents'));
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
            'subject' => 'required',
            'class' => 'required',
            'teacher' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $room = Room::find($id);
        $room->id_matpel = $request->subject;
        $room->id_kelas = $request->class;
        $room->id_guru = $request->teacher;
        $room->save();
        $room->students()->sync($request->students); // Sinkronisasi siswa yang dipilih dengan tabel pivot
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
