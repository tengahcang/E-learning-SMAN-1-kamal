@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3 shadow-sm">
        <h3 class="mb-4">Tambah Tugas untuk {{ $activity->name }}</h3>
        <form action="{{ route('teacher.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_activity" value="{{ $activity->id }}">
            <input type="hidden" name="id_room" value="{{ $id_room }}">
            <div class="form-group mb-4">
                <label for="name">Nama Materi</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-4">
                <label for="file">Unggah Materi</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-success">Tambah Materi</button>
        </form>
    </div>
@endsection
