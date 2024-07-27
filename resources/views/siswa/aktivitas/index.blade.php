@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 c>{{ $room->subject->name . ' - ' . $room->class->name }}</h4>
        <div class="container bg-white shadow-sm p-4 mt-2">
            @foreach ($activities as $activity)
                <h4 class="mb-4" style="font-weight: bold">{{ $activity->name }}</h4>
                @foreach ($activity->subject_matter as $matter)
                    <div class="content-item mb-2">
                        <a class="text-dark text-decoration-none" href="{{ route('student.materi.show', $matter->id) }}">
                            <i class="bi bi-file-earmark-text custom-icon me-3"></i>
                            <span>Materi - {{ $matter->name }}</span>
                        </a>
                    </div>
                @endforeach
            @endforeach
            {{-- <h4>Pertemuan 1: Pancasila sebagai Ideologi dan Dasar Negara</h4> --}}
            @foreach ($activity->tasks as $task)
                <a class="text-dark text-decoration-none mb-3" href="{{ route('student.tugas.show', $task->id) }}">
                    <div class="content-item mb-2">
                        <i class="bi bi-pencil custom-icon me-3"></i>
                        <span><span class="text-danger">Tugas</span> - {{ $task->name }}</span>
                    </div>
                </a>
            @endforeach
            {{-- <div class="content-item">
                <i class="bi bi-file-earmark-text custom-icon me-3"></i>
                <span>Materi Pertama - Pancasila sebagai Ideologi dan Dasar Negara</span>
            </div>
            <div class="content-item ">
                <i class="bi bi-pencil custom-icon me-3"></i>
                <span>Tugas Pertama - Essay Ideologi Pancasila</span>
            </div> --}}
        </div>
    </div>
@endsection
