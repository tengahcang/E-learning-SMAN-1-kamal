@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container bg-white p-4 shadow-sm">
            <h4 style="font-weight: bold">{{ $room->subject->name . ' - ' . $room->class->name }}</h4>
            <h5>Deskripsi:</h5>
            <p id="room-description">{!! nl2br(e($room->description)) !!}</p>
        </div>


            @foreach ($activities as $activity)
            <div class="container bg-white shadow-sm p-4 mt-2 rounded">
                <h4 class="mb-2" style="font-weight: bold">{{ $activity->name }}</h4>

                @if ($activity->subject_matter->isNotEmpty())
                    @foreach ($activity->subject_matter as $matter)
                        <div class="content-item mb-2">
                            <a class="text-dark text-materi-tugas" href="{{ route('student.materi.show', $matter->id) }}">
                                <i class="bi bi-file-earmark-text custom-icon me-2"></i>
                                <span>Materi - {{ $matter->name }}</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada materi yang tersedia.</p>
                @endif

                @if ($activity->tasks->isNotEmpty())
                    @foreach ($activity->tasks as $task)
                        <a class="text-dark text-materi-tugas mb-3" href="{{ route('student.tugas.show', $task->id) }}">
                            <div class="content-item mb-2">
                                <i class="bi bi-pencil custom-icon me-2"></i>
                                <span><span class="text-danger ">Tugas</span> - {{ $task->name }}</span>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>Tidak ada tugas yang tersedia.</p>
                @endif
            </div>
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
@endsection
