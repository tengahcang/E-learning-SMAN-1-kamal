@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $task->name }}</h1>
    <p>{{ $task->description }}</p>
    <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>

    @if ($task->hasMedia('templates'))
        @foreach ($task->getMedia('templates') as $media)
            <p>Template File: <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
        @endforeach
    @endif
    {{-- <h1>{{ $task->activity->id_room }}</h1> --}}

    <a href="{{ route('tugas.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('tugas.destroy', $task->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
    <a href="{{ route('matapelajaran.index', ['id_room' => $task->activity->id_room]) }}" class="btn btn-secondary btn-sm">Back</a>
</div>
@endsection