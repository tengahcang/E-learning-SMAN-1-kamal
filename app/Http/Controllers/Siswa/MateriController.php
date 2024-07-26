<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Materi;
use App\Models\RoomSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $materi = Materi::with('activity')->findOrFail($id);
        // $isPastDeadline = Carbon::now()->isAfter($task->deadline);
        $user = Auth::user();
        $id_siswa = $user->id_siswa;

        // Cari semua entri RoomSiswa yang terkait dengan siswa ini
        $room_siswas = RoomSiswa::where('id_siswa', $id_siswa)
            ->with(['room.class', 'room.subject', 'room.teacher'])
            ->get();
        // dd($isPastDeadline);

        return view('siswa.materi.show', compact('materi','room_siswas'));
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
