<?php

namespace App\Http\Controllers\Siswa;

use Carbon\Carbon;
use App\Models\Tugas;
use App\Models\RoomSiswa;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = Auth::user();
        // $submission = Pengumpulan::where('id_tugas', $id)
        //                             ->where('id_siswa', $user->id_siswa)
        //                             ->first();
        $id_siswa = $user->id_siswa;

        // Cari semua entri RoomSiswa yang terkait dengan siswa ini
        $room_siswas = RoomSiswa::where('id_siswa', $id_siswa)
            ->with(['room.class', 'room.subject', 'room.teacher'])
            ->get();
        try {
            // Periksa apakah kolom benar
            $submission = Pengumpulan::where('id_tugas', $id)
                                    ->where('id_siswa', $user->id_siswa)
                                    ->first();
        } catch (\Illuminate\Database\QueryException $ex) {
            // Jika terjadi error, log error dan set submission ke null
            // Log::error($ex->getMessage());
            $submission = null;
        }

        $task = Tugas::with('activity')->findOrFail($id);
        $isPastDeadline = Carbon::now()->isAfter($task->deadline);

        // dd($isPastDeadline);

        return view('siswa.tugas.show', compact('task', 'submission', 'isPastDeadline','room_siswas'));
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
