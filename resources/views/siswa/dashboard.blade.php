@extends('layouts.app')

@section('content')    <style>
    .footer-cardpelajaran {
        background-color: #D9D9D9
    }

    .card-item {
        height: 150px;
    }

    .card-item div {
        height: 100%;
        display: flex;
        align-items: flex-end;
        padding: 0.5rem;
    }

    .schedule {
        margin-top: 2rem;
    }

    .schedule-item {
        display: flex;
        justify-content: space-between;

        /* border-bottom: 1px solid #ccc; */
    }

    .schedule-item:last-child {
        border-bottom: none;
    }
    .tasks-container {
            margin-top: 2rem;
        }

        .task-item {
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
        }

        .task-deadline {
            color: red;
        }
</style>

<div class="container">
    <div class="row bg-white p-3 shadow-sm">
        <h5 class="mb-4">Pelajaran saya</h5>
        @foreach ($kelas_siswa as $kelas)
            <div class="col-md-3 col-sm-6 mb-3 ">
                <a href="{{ route('student.matapelajaran.index', ['id_room' => $kelas->id]) }}">
                    <div class="card bg-success border-0 text-white card-item">
                        <div class="mb-5"></div>
                        <div class="text-dark footer-cardpelajaran rounded-bottom card-text">
                            {{ $kelas->subject->name }}<br>{{ $kelas->class->name }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <div class="tasks-container">
        <h5 class="mb-4">Tugas yang harus dikerjakan</h5>

        <h6>Hari ini</h6>
        @forelse ($tasks_due_today as $task)
            <a href="{{ route('student.tugas.show', $task->id) }}">
                <div class="task-item">
                    <div>{{ $task->name }} - {{ $task->subject_name }}</div>
                    <div class="task-deadline">{{ $task->parsed_deadline->format('d M Y H:i') }}</div>
                </div>
            </a>
        @empty
            <div>Tidak ada tugas untuk hari ini.</div>
        @endforelse

        <h6>7 Hari ke Depan</h6>
        @forelse ($tasks_due_7_days as $task)
            <a href="{{ route('student.tugas.show', $task->id) }}">
                <div class="task-item">
                    <div>{{ $task->name }} - {{ $task->subject_name }}</div>
                    <div class="task-deadline">{{ $task->parsed_deadline->format('d M Y H:i') }}</div>
                </div>
            </a>
        @empty
            <div>Tidak ada tugas untuk 7 hari ke depan.</div>
        @endforelse

        <h6>30 Hari ke Depan</h6>
        @forelse ($tasks_due_30_days as $task)
            <a href="{{ route('student.tugas.show', $task->id) }}">
                <div class="task-item">
                    <div>{{ $task->name }} - {{ $task->subject_name }}</div>
                    <div class="task-deadline">{{ $task->parsed_deadline->format('d M Y H:i') }}</div>
                </div>
            </a>
        @empty
            <div>Tidak ada tugas untuk 30 hari ke depan.</div>
        @endforelse
    </div>
</div>
@endsection
