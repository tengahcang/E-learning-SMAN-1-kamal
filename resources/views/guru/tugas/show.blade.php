@extends('layouts.app')

@section('content')
<div class="container bg-white p-3 shadow-sm">
    <h1>{{ $task->name }}</h1>
    <p>{!! nl2br($task->description) !!}</p>
    <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>

    @if ($task->hasMedia('templates'))
        @foreach ($task->getMedia('templates') as $media)
            <p>Template File: <a href="{{ route('download.media', $media->id) }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
        @endforeach
    @endif
    {{-- <h1>{{ $task->activity->id_room }}</h1> --}}
    <a href="{{route('teacher.tugas.pengumpulan', $task->id)}}"class="btn btn-primary btn-sm">pengumpulan</a>
    <a href="{{ route('teacher.tugas.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('teacher.tugas.destroy', $task->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
    <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $task->activity->id_room]) }}" class="btn btn-secondary btn-sm">Back</a>
</div>
@endsection
