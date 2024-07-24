<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teachers = User::where('role','guru')->get();
        $teachers->each(function ($teachers) {
            $teachers->password_length = strlen($teachers->password);
        });
        return view('admin.guru.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => ':Attribute harus diisi.',
            'numeric' => ':Attribute harus diisi dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'NIP' => 'required',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $teacher = New Guru();
        $teacher->NIP = $request->NIP;
        $teacher->name = $request->name;
        $teacher->save();
        $id = $teacher->id;
        $user = New User();
        $user->name = $request->name;
        $user->username = $request->NIP;
        $user->password = bcrypt($request->password);
        $user->role = "guru";
        $user->id_guru = $id;
        $user->save();
        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        $teacher = Guru::find($user->id_guru);
        return view('admin.guru.show', compact('teacher','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $teacher = Guru::find($user->id_guru);
        return view('admin.guru.edit', compact('teacher','user'));
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
            'NIP' => 'required',
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->NIP;
        if ($request->filled('password')){
            $user->password = bcrypt($request->password);
        }
        $user->role = "guru";
        $user->save();
        $teacher = Guru::find($user->id_guru);
        $teacher->NIP = $request->NIP;
        $teacher->name = $request->name;
        $teacher->save();
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $teacher = Guru::find($user->id_guru);
        $user->delete();
        $teacher->delete();
        return redirect()->route('teachers.index');
    }
    public function createImport()
    {
        return view('admin.guru.import');
    }
    public function import(Request $request)
    {
        // dd($request);
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        // return back()->with('success', 'File uploaded successfully.');

        return redirect()->route('teachers.index');
    }
    public function download()
    {
        $filePath = 'Template_data_guru.xlsx';
        $fileName = 'Template_data_guru.xlsx';
        $path = Storage::disk('local')->path($filePath);
        return response()->download($path, $fileName);
    }
}
