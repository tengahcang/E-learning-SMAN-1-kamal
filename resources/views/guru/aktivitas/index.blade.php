@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    {{-- <h1>{{ $room->subject->name." ". $room->class->name }}</h1> --}}
    {{-- <div class="mt-3 mb-3">
            <a href="{{ route('teacher.matapelajaran.create',['id_room'=>$room->id]) }}" class="btn btn-primary">+ Tambah Pertemuan</a>
        </div>
        <div class="list-group">
            {{ $activities }}
            @foreach ($activities as $activity)
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $activity->name }}</h3>
                        <a href="{{ route('teacher.tugas.create', ['id_activity' => $activity->id, 'id_room' => $room->id]) }}"
                            class="btn btn-primary">+ Tambah Tugas</a>
                    </div>
                    <ul class="list-group mt-2">
                        @foreach ($activity->tasks as $task)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>
                                            <a href="{{ route('teacher.tugas.show', $task->id) }}">{{ $task->name }}</a>
                                            <span style="color: red;">(Tugas)</span>
                                        </h5>
                                        <p>{{ $task->description }}</p>
                                        <p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d-m-Y H:i') }}</p>
                                        @if ($task->hasMedia('templates'))
                                            @foreach ($task->getMedia('templates') as $media)
                                                <p>Template File: <a href="{{ $media->getUrl() }}"
                                                        target="_blank">{{ $media->getCustomProperty('original_name') }}</a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('teacher.tugas.show', $task->id) }}"
                                            class="btn btn-secondary btn-sm">show</a>
                                        <a href="{{ route('teacher.tugas.edit', $task->id) }}"
                                            class="btn btn-warning btn-sm">edit</a>
                                        <form action="{{ route('teacher.tugas.destroy', $task->id) }}" method="POST"
                                            class="d-inline">
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
    </div> --}}
    {{-- <style>
        .task-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .task-title {
            color: red;
        }

        .task-button {
            float: right;
        }

        .task-button.submit {
            background-color: orange;
            color: white;
        }

        .task-button.do {
            background-color: purple;
            color: white;
        }

        .task-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
    <div class="container bg-white p-4">
        <div class="justify-content-between d-flex mb-3">
            <h4>{{ $room->subject->name . ' ' . $room->class->name }}</h4>
            <a href="{{ route('matapelajaran.create', ['id_room' => $room->id]) }}" class="btn btn-primary">+ Tambah
                Pertemuan</a>
        </div>


        <div class="task-item">
            <div class="task-header">Pertemuan ke 1</div>
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa fa-file-pdf"></i> Materi Awal - Pengertian IPA (PDF)
                </div>
            </div>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 2</div>
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa fa-pencil-alt"></i> Tugas - Merangkum (<span class="task-title">Tugas</span>)
                </div>
                <button class="btn task-button submit">Kumpulkan</button>
            </div>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 3</div>
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa fa-file"></i> Tulang Manusia (<span class="text-purple">Ulangan</span>)
                </div>

            </div>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 4</div>
            <div class="d-flex justify-content-between">
                <div>
                    <i class="fa fa-file"></i> Ulangan Tengah Semester (<span class="text-purple">Ulangan</span>)
                </div>
                <button class="btn task-button do">Kerjakan</button>
            </div>
        </div>
    </div> --}}
    <div class="container bg-white p-4 shadow-sm mb-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>{{ $room->class->name }}-{{ $room->subject->name }} </h4>
            <div>
                <a href="{{ route('teacher.room.participant', $room->id) }}" class="btn"
                    style="background-color: #FF6D59; color: white;">Lihat Daftar Siswa</a>
                <a href="{{ route('teacher.matapelajaran.create', ['id_room' => $room->id]) }}" class="btn btn-ungu">Tambah
                    Activity</a>
            </div>
        </div>
        <div>
            <h5>Deskripsi:</h5>
            <p id="room-description">{!! nl2br(e($room->description)) !!}</p>
            <div class="justify-content-end d-flex">
                <button id="edit-description" class="btn btn-danger mt-2" data-bs-toggle="modal"
                    data-bs-target="#editDescriptionModal">Edit Deskripsi</button>
            </div>

        </div>

    </div>
    @foreach ($activities as $activity)
        <div class="task-item bg-white  border-0 shadow-sm">
            <div class="task-header">{{ $activity->name }}</div>
            @foreach ($activity->subject_matter as $matter)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="{{ route('teacher.materi.show', $matter->id) }}" class="text-secondary">
                        <i class="bi bi-file-earmark-pdf"></i> {{ $matter->name }}
                    </a>
                    <div class="my-3">
                        {{-- <a href="{{ route('teacher.materi.show', $matter->id) }}" class="icon-btn me-3"><i class="bi bi-eye"></i></a> --}}
                        <a class="icon-btn me-2" href="{{ route('teacher.materi.edit', $matter->id) }}"><i
                                class="bi bi-pencil"></i></a>

                        <form action="{{ route('teacher.materi.destroy', $matter->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach

            @foreach ($activity->tasks as $task)
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('teacher.tugas.show', $task->id) }}" class="text-secondary">
                        <i class="bi bi-pencil"></i> {{ $task->name }} (Tugas)
                    </a>
                    <div>
                        {{-- <a href="{{ route('teacher.tugas.show', $task->id) }}" class="icon-btn me-3"><i
                                class="bi bi-eye"></i></a> --}}
                        <a class="icon-btn me-2" href="{{ route('teacher.tugas.edit', $task->id) }}"><i
                                class="bi bi-pencil"></i></a>

                        <form action="{{ route('teacher.tugas.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="d-flex mt-4 justify-content-between">
                <a href="{{ route('teacher.materi.create', ['id_activity' => $activity->id, 'id_room' => $room->id]) }}"
                    class="btn btn-biru me-3 w-50">+ Tambahkan Materi</a>
                <a href="{{ route('teacher.tugas.create', ['id_activity' => $activity->id, 'id_room' => $room->id]) }}"
                    class="btn btn-ungu w-50">+ Tambahkan Tugas</a>
            </div>

        </div>
    @endforeach
    <div class="modal fade" id="editDescriptionModal" tabindex="-1" aria-labelledby="editDescriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDescriptionModalLabel">Edit Deskripsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-description-form" action="{{ route('teacher.room.updateDescription') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $room->id }}">
                        <textarea id="modal-description" name="description" class="form-control" placeholder="Masukkan deskripsi mata pelajaran"
                            rows="3">{{ $room->description }}</textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="edit-description-form" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#edit-description').on('click', function() {
                var description = $('#room-description').text();
                $('#modal-description').val(description);
            });
        });
    </script>
@endpush
