<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumpulan;
use App\Models\RoomSiswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SubmisionController extends Controller
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
    public function create(string $id)
    {
        //
        $room_siswas = RoomSiswa::where('id_siswa', $id)
        ->with(['room.class', 'room.subject', 'room.teacher'])
        ->get();
        $task = Tugas::with('activity')->findOrFail($id);
        return view('siswa.pengumpulan.create', compact('task','room_siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'content' => 'nullable',
            'file' => 'nullable'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $submision = new Pengumpulan();
        $submision->id_tugas = $request->task_id;
        $submision->id_siswa = $user->id_siswa;
        $submision->content = $request->content;

        // Debugging to check if file is received
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalFileName = $file->getClientOriginalName();
                $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $submision->addMedia($file)
                    ->usingFileName($generatedFileName)
                    ->withCustomProperties(['original_name' => $originalFileName])
                    ->toMediaCollection('pengumpulans');
            }
        }

        $submision->save();

        return redirect()->route('student.tugas.show', $request->task_id);
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
        $room_siswas = RoomSiswa::where('id_siswa', $id)
        ->with(['room.class', 'room.subject', 'room.teacher'])
        ->get();
        //
        $submision = Pengumpulan::with([ 'media'])->findOrFail($id);
        $task = Tugas::with('activity')->findOrFail($submision->id_tugas);
        // dd($submision);
        return view('siswa.pengumpulan.edit', compact('submision', 'task','room_siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'content' => 'nullable',
            'file' => 'nullable'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $submision = Pengumpulan::find($id);
        $submision->id_tugas = $request->task_id;
        $submision->id_siswa = $user->id_siswa;
        $submision->content = $request->content;

        // Debugging to check if file is received
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalFileName = $file->getClientOriginalName();
                $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

                $submision->addMedia($file)
                    ->usingFileName($generatedFileName)
                    ->withCustomProperties(['original_name' => $originalFileName])
                    ->toMediaCollection('pengumpulans');
            }
        }

        $submision->save();

        return redirect()->back()->with('success', 'pengumpulang telah diupdate');
    }

    public function destroyFile(Request $request)
    {
        $idsubmision = $request->idSubmission;
        $id = $request->idData;
        $file = Pengumpulan::with(['media'])->find($idsubmision);
        if ($file) {
            $mediaItem = $file->getMedia('pengumpulans')->where('id', $id)->first();
            if ($mediaItem) {
                $mediaItem->delete();
                return redirect()->back()->with('success', 'File updated successfully.');
            } else {
                return redirect()->back()->with(['error' => 'File not found.'], 404);
            }
        } else {
            return redirect()->back()->with(['error' => 'Pengumpulan not found.'], 404);
        }

    }
    // public function updateFile(Request $request)
    // {
    //     // dd($request);
    //     $user = Auth::user();
    //     $idsubmision = $request->idSubmission;
    //     $id = $request->idData;
    //     $submision = Pengumpulan::find($idsubmision);
    //     if ($request->hasFile('update')) {
    //         foreach ($request->file('update') as $file) {
    //             $originalFileName = $file->getClientOriginalName();
    //             $generatedFileName = uniqid() . '.' . $file->getClientOriginalExtension();

    //             $submision->addMedia($file)
    //                 ->usingFileName($generatedFileName)
    //                 ->withCustomProperties(['original_name' => $originalFileName])
    //                 ->toMediaCollection('pengumpulans');
    //         }
    //     }
    //     $submision->save();

    //     $data = Pengumpulan::with(['media'])->find($idsubmision);

    //     if ($data) {
    //         // Find and delete the media item by id
    //         $mediaItem = $data->getMedia('pengumpulans')->where('id', $id)->first();

    //         if ($mediaItem) {
    //             $mediaItem->delete();
    //             // Debugging to check if file is received


    //             $data->save(); // Save the updated data
    //             return redirect()->back()->with('success', 'File updated successfully.');
    //         } else {
    //             return response()->json(['error' => 'File not found.'], 404);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Pengumpulan not found.'], 404);
    //     }
    // }

}
