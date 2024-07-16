<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TugasController extends Controller
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
        $activity = Aktivitas::findOrFail($id_activity);
        return view('guru.tugas.create', compact('activity', 'id_room'));
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
            'description' => 'nullable',
            'deadline' => 'required',
            'file' => 'nullable'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task = new Tugas();
        $task->id_aktivitas = $request->id_activity;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        // Debugging to check if file is received
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Ensure file is stored
            $task->addMedia($file)->usingFileName($generatedFileName)->withCustomProperties(['original_name' => $originalFileName])->toMediaCollection('templates');
        }

        $task->save();

        return redirect()->route('matapelajaran.index', ['id_room' => $request->id_room]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = Tugas::with('activity')->find($id);
        // $activity = $task->activity;
        // dd($task);
        return view('guru.tugas.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tugas = Tugas::find($id);
        $activity = $tugas->activity;
        // dd($activity);
        // return view('guru.tugas.edit', compact('task', 'activity'));
        return view('guru.tugas.edit', compact('tugas', 'activity'));
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
            'description' => 'required',
            'deadline' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $task = Tugas::find($id);
        $task->id_aktivitas = $request->id_activity;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Ensure file is stored
            $task->addMedia($file)->usingFileName($generatedFileName)->withCustomProperties(['original_name' => $originalFileName])->toMediaCollection('templates');
        }

        $task->save();
        $task->save();
        return redirect()->route('matapelajaran.index', ['id_room' => $request->id_room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
