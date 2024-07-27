{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $task->name }}</h1>
    <p>{!! nl2br($task->description) !!}</p>
    <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>
    @if ($task->hasMedia('templates'))
        @foreach ($task->getMedia('templates') as $media)
            <p>Template File: <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
        @endforeach
    @endif
    @if ($submission)
        @if ($submission->hasMedia('pengumpulans'))
            <p>File yang sudah dikumpulkan:</p>
            @foreach ($submission->getMedia('pengumpulans') as $media)
                <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a>
                <hr>
            @endforeach
        @endif
        <a href="{{ route('student.pengumpulan.edit', ['pengumpulan' => $submission->id]) }}" class="btn btn-warning btn-sm">Edit Tugas</a>
    @else
        <a href="{{ route('student.pengumpulan.create', ['id_tugas' => $task->id]) }}" class="btn btn-danger btn-sm">Tambah Tugas</a>
    @endif
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3 shadow-sm rounded">
        <h4 style="font-weight: bold">{{ $task->name }}</h4>
        <hr>
        <p>Description : <br>
        {!! nl2br(e($task->description)) !!}
        </p>

        <p><b>Deadline</b>: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>
        @if ($task->hasMedia('templates'))
            @foreach ($task->getMedia('templates') as $media)
                <p>Template File: <a href="{{ $media->getUrl() }}"
                        target="_blank">{{ $media->getCustomProperty('original_name') }}</a></p>
            @endforeach
        @endif
        @if ($submission)
            @if ($submission->hasMedia('pengumpulans'))
                <p>File yang sudah dikumpulkan:</p>
                @foreach ($submission->getMedia('pengumpulans') as $media)
                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a>
                    <hr>
                @endforeach
            @endif
            @if ($isPastDeadline)
                <a href="{{ route('student.pengumpulan.edit', ['pengumpulan' => $submission->id]) }}"
                    class="btn btn-warning btn-sm">Edit Tugas</a>
            @else
                <p class="text-danger">Deadline telah terlewati, Anda tidak bisa mengedit tugas.</p>
            @endif
        @else
            @if ($isPastDeadline)
                <a href="{{ route('student.pengumpulan.create', ['id_tugas' => $task->id]) }}"
                    class="btn btn-danger btn-sm">Tambah Tugas</a>
            @else
                <p class="text-danger">Deadline telah terlewati, Anda tidak bisa menambahkan tugas.</p>
            @endif
        @endif
    </div>
@endsection
