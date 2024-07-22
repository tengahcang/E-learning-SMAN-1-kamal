@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $room->subject->name." ". $room->class->name }}</h1>
    <div class="mt-3 mb-3">
        <a href="{{ route('teacher.matapelajaran.create',['id_room'=>$room->id]) }}" class="btn btn-primary">+ Tambah Pertemuan</a>
    </div>
    <div class="list-group">
        @foreach($activities as $activity)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $activity->name }}</h3>
                    <a href="{{ route('teacher.tugas.create', ['id_activity' => $activity->id, 'id_room' => $room->id]) }}" class="btn btn-primary">+ Tambah Tugas</a>
                </div>
                <ul class="list-group mt-2">
                    @foreach($activity->tasks as $task)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>
                                    <a href="{{ route('teacher.tugas.show', $task->id) }}">{{ $task->name }}</a>
                                    <span style="color: red;">(Tugas)</span>
                                </h5>
                                {{-- <p>{{ $task->description }}</p>
                                <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>
                                @if ($task->hasMedia('templates'))
                                    @foreach ($task->getMedia('templates') as $media)
                                        <p>Template File: <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
                                    @endforeach
                                @endif --}}
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('teacher.tugas.show', $task->id) }}" class="btn btn-secondary btn-sm">show</a>
                                <a href="{{ route('teacher.tugas.edit', $task->id) }}" class="btn btn-warning btn-sm">edit</a>
                                <form action="{{ route('teacher.tugas.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
