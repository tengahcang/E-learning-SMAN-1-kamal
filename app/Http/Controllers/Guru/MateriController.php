<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Materi;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_activity, $id_room)
    {
        //
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        $activity = Aktivitas::findOrFail($id_activity);
        return view('guru.materi.create', compact('activity', 'id_room','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'nullable'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subject_matter = new Materi();
        $subject_matter->id_aktivitas = $request->id_activity;
        $subject_matter->name = $request->name;

        // Debugging to check if file is received
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Ensure file is stored
            $subject_matter->addMedia($file)->usingFileName($generatedFileName)->withCustomProperties(['original_name' => $originalFileName])->toMediaCollection('materi');
        }

        $subject_matter->save();

        return redirect()->route('teacher.matapelajaran.index', ['id_room' => $request->id_room]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        $materi = Materi::with('activity')->find($id);
        // $activity = $task->activity;
        // dd($task);
        return view('guru.materi.show', compact('materi','rooms'));
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
        $materi = Materi::find($id);
        $activity = $materi->activity;
        // dd($activity);
        // return view('guru.tugas.edit', compact('task', 'activity'));
        return view('guru.materi.edit', compact('materi', 'activity','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request);
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'nullable'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subject_matter = Materi::find($id);
        $subject_matter->id_aktivitas = $request->id_activity;
        $subject_matter->name = $request->name;
        // Debugging to check if file is received
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Ensure file is stored
            $subject_matter->addMedia($file)->usingFileName($generatedFileName)->withCustomProperties(['original_name' => $originalFileName])->toMediaCollection('materi');
        }

        $subject_matter->save();
        return redirect()->route('teacher.matapelajaran.index', ['id_room' => $request->id_room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
