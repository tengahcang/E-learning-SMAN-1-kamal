@extends('layouts.app')
@section('content')
    <div class="container-sm mt-5">
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row ">
                <div class="p-5 bg-white shadow-sm rounded-3 ">
                    <h5>INPUT ROOM</h5>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Mata Pelajaran</label>
                            <select name="subject" id="subject" class="form-select">
                                <option value="">pilih salah satu</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="class" class="form-label">Kelas</label>
                            <select name="class" id="class" class="form-select">
                                <option value="">pilih salah satu</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="teacher" class="form-label">Guru</label>
                            <select name="teacher" id="teacher" class="form-select">
                                <option value="">pilih salah satu</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('rooms.index') }}" class="btn btn-danger btn-md mt-3"> Batal</a>
                    <button type="submit" class="btn btn-success btn-md mt-3">
                        Tambahkan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
