@extends('layouts.app')
@section('content')
    <div class="bg-white p-4 rounded-3 shadow-sm mt-3">
        <h6>EDIT MATA PELAJARAN</h6>
        <div class="mt-4">
            <form action="{{ route('subjects.update',['subject'=>$subject->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="namaMataPelajaran" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control @error('subject_name') is-invalid @enderror" value="{{ $errors->any() ? old('subject_name') : $subject->name }}"name="subject_name" id="subject_name" placeholder="BAHASA INDONESIA">
                        @error('subject_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-danger w-100" href="{{ route('subjects.index') }}">Batal</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success w-100">Perbarui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
