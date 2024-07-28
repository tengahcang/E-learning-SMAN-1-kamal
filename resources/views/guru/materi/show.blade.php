@extends('layouts.app')

@section('content')
<div class="container bg-white p-3 shadow-sm">
    <h1>{{ $materi->name }}</h1>
    @if ($materi->hasMedia('materi'))
        @foreach ($materi->getMedia('materi') as $media)
            <p>Template File: <a href="{{ route('download.media', $media->id) }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
        @endforeach
    @endif
    {{-- <h1>{{ $task->activity->id_room }}</h1> --}}

    <a href="{{ route('teacher.materi.edit', $materi->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('teacher.materi.destroy', $materi->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
    <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $materi->activity->id_room]) }}" class="btn btn-secondary btn-sm">Back</a>
</div>
@endsection
