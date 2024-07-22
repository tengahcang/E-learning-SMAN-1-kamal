@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tugas untuk {{ $activity->name }}</h1>
    <form action="{{ route('teacher.tugas.update', $tugas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id_activity" value="{{ $activity->id }}">
        <input type="hidden" name="id_room" value="{{ $activity->id_room }}">
        <div class="form-group">
            <label for="name">Nama Tugas</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tugas->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi Tugas</label>
            <textarea class="form-control" id="description" name="description">{{ $tugas->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="file">Unggah Template Pekerjaan</label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-success">Update Tugas</button>
    </form>
</div>
@endsection
