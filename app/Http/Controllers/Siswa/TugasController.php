<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        return view('siswa.tugas.show', compact('task', 'submission', 'isPastDeadline'));
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
