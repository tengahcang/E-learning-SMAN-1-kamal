<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = MataPelajaran::all();
        return view('admin.matapelajaran.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.matapelajaran.create');
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
            'description' => 'nullable'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subject = New MataPelajaran();
        $subject->name = $request->name;
        if ($request->filled('description')){
            $subject->description = $request->address;
        }
        $subject->save();
        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $subject = MataPelajaran::find($id);
        return view('admin.matapelajaran.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subject = MataPelajaran::find($id);
        return view('admin.matapelajaran.edit', compact('subject'));
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
            'description' => 'nullable'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $subject = MataPelajaran::find($id);
        $subject->name = $request->name;
        if ($request->filled('description')){
            $subject->description = $request->description;
        }
        $subject->save();
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subject = MataPelajaran::find($id);
        $subject->delete();
        return redirect()->route('subjects.index');
    }
}
