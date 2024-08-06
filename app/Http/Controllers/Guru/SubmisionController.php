<?php

namespace App\Http\Controllers\Guru;

use App\Exports\PengumpulanExport;
use App\Http\Controllers\Controller;
use App\Models\Pengumpulan;
use App\Models\Room;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $taskId, $submissionId)
    {
        //
        $submission = Pengumpulan::findOrFail($submissionId);
        $submission->nilai = $request->nilai;
        $submission->save();

        return redirect()->route('teacher.tugas.pengumpulan', $taskId)->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($taskId)
    {
        // $task = Tugas::findOrFail($taskId);
        // $user = Auth::user();
        // $id_guru = $user->id_guru;
        // $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        // $pengumpulans = Pengumpulan::with('siswa')->where('id_tugas', $taskId)->get();
        // $roomId = $task->activity->id_room;
        // $room = Room::with('students')->find($roomId);
        // $students = $room->students;
        // return view('guru.pengumpulan.show', compact('task', 'pengumpulans', 'students', 'rooms'));
        $task = Tugas::findOrFail($taskId);
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();

        // Ambil pengumpulan terkait tugas ini
        $pengumpulans = Pengumpulan::with('siswa')->where('id_tugas', $taskId)->get()->keyBy('id_siswa');

        // Ambil room id dari activity yang terkait dengan tugas ini
        $roomId = $task->activity->id_room;

        // Ambil room beserta siswa yang terhubung
        $room = Room::with('students')->find($roomId);
        $students = $room->students;

        return view('guru.pengumpulan.show', compact('task', 'pengumpulans', 'students', 'rooms'));
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
    public function exportNilai($taskId)
    {
        $task = Tugas::findOrFail($taskId);
        $roomId = $task->activity->id_room;
        $room = Room::with('students')->find($roomId);
        $students = $room->students;

        return Excel::download(new PengumpulanExport($taskId, $students), 'nilai.xlsx');
    }
}
