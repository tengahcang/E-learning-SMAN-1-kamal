<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SemuaPengumpulanExport;
use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Room;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'class' => 'required',
            'teacher' => 'required',
            'students_file' => 'nullable|file|mimes:xlsx,xls'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $room = Room::find($id);
        $room->id_matpel = $request->subject;
        $room->id_kelas = $request->class;
        $room->id_guru = $request->teacher;
        $room->save();
        $missingStudents = [];
        if ($request->hasFile('students_file')) {
            $students = Excel::toCollection(new SiswaImport, $request->file('students_file'))->first();
            // dd($students);
            $studentIds = [];
            foreach ($students as $student) {
                // Misalkan file Excel Anda memiliki kolom 'name'
                if(!is_null($student['nisn']) && !is_null($student['nama'])){
                    $studentRecord = Siswa::where([
                        ['nisn', '=', $student['nisn']],
                        ['name', '=', $student['nama']]
                    ])->first();
                    if ($studentRecord) {
                        $studentIds[] = $studentRecord->id;
                    } else {
                        $missingStudents[] = [
                            'nisn' => $student['nisn'],
                            'nama' => $student['nama']
                        ];
                    }
                }
            }
            $room->students()->sync($studentIds);
        } else {
            $room->students()->sync($request->students);
        }

        return redirect()->route('rooms.index')->with('failedRows', $missingStudents);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('rooms.index');
    }
    public function exportAllTasksNilai($roomId)
    {
        $room = Room::with('class', 'subject')->findOrFail($roomId);
        $fileName = 'semua_nilai_tugas (' .  $room->subject->name . '_' . $room->class->name . ').xlsx';
        return Excel::download(new SemuaPengumpulanExport($roomId), $fileName);
    }
    public function reset()
    {
        try {
            DB::transaction(function () {
                // Delete all related data
                DB::table('pengumpulans')->delete();
                DB::table('tugas')->delete();
                DB::table('materis')->delete();
                DB::table('aktivitas')->delete();
                DB::table('room_siswas')->delete();
                DB::table('rooms')->delete();

                // Clear the media files
                Media::truncate();
            });

            return redirect()->back()->with('status', 'Room data has been reset successfully.');
        } catch (Exception $e) {
            Log::error('Error resetting room data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reset room data: ' . $e->getMessage());
        }
    }
}
