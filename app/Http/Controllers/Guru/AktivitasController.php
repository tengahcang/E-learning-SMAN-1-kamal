<?php

namespace App\Http\Controllers\Guru;

use App\Models\Room;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
