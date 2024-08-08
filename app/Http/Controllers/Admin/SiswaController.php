<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = User::where('role','siswa')->get();
        $students->each(function ($student) {
            $student->password_length = strlen($student->password);
        });
        // dd($students);
        return view('admin.siswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => ':Attribute harus diisi dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nisn' => 'required',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $student = New Siswa();
        $student->NISN = $request->nisn;
        $student->name = $request->name;
        $student->save();
        $id = $student->id;
        $user = New User();
        $user->name = $request->name;
        $user->username = $request->nisn;
        $user->password = bcrypt($request->password);
        $user->role = "siswa";
        $user->id_siswa = $id;
        $user->save();
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        $student = Siswa::find($user->id_siswa);
        return view('admin.siswa.show', compact('student','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $student = Siswa::find($user->id_siswa);
        return view('admin.siswa.edit', compact('student','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => ':Attribute harus diisi dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nisn' => 'required',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->nisn;
        if ($request->filled('password')){
            $user->password = bcrypt($request->password);
        }
        $user->role = "siswa";
        $user->save();
        $student = Siswa::find($user->id_siswa);
        $student->NISN = $request->nisn;
        $student->name = $request->name;
        $student->save();
        // $id = $student->id;
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $student = Siswa::find($user->id_siswa);
        $user->delete();
        $student->delete();
        return redirect()->route('students.index');
    }
    public function createImport()
    {
        return view('admin.siswa.import');
    }
    public function import(Request $request)
    {
        // dd($request);
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        $import = new SiswaImport;
        Excel::import($import, $request->file('file'));
        $failedRows = $import->getFailedRows();

        // return back()->with('success', 'File uploaded successfully.');

        return redirect()->route('students.index')->with('failedRows', $failedRows);
    }
    public function downloadTemplate()
    {
        $filePath = 'Template_data_siswa.xlsx';
        $fileName = 'Template_data_siswa.xlsx';
        $path = Storage::disk('local')->path($filePath);
        return response()->download($path, $fileName);
    }
}
