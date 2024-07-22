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
    <style>
        .task-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn-tambah-pertemuan {
            background-color: #57BAAB;
            color: white;
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

        .text-purple {
            color: purple;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
        }
    </style>
    <div class="container bg-white p-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>{{ $room->class->name }}-{{ $room->subject->name }} </h4>
            <a href="{{ route('teacher.matapelajaran.create',['id_room'=>$room->id]) }}" class="btn  btn-tambah-pertemuan">+
                Tambah
                Pertemuan</a>
        </div>
        @foreach ($activities as $activity)
            <div class="task-item">
                <div class="task-header">{{ $activity->name }}</div>

                @foreach ($activity->tasks as $task)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <i class="bi bi-file-earmark-pdf"></i><span> {{ $task->name }}</span>
                        </div>
                        <div>
                            <a href="{{ route('teacher.tugas.show', $task->id) }}" class="icon-btn me-3"><i class="bi bi-eye"></i></a>
                            <a class="icon-btn me-2" href="{{ route('teacher.tugas.edit', $task->id) }}"><i class="bi bi-pencil"></i></a>

                            <form action="{{ route('teacher.tugas.destroy', $task->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('teacher.tugas.create', ['id_activity' => $activity->id, 'id_room' => $room->id]) }}"
                    class="btn btn-outline-secondary w-100">+ Tambahkan Materi / Tugas / Ulangan</a>
            </div>
        @endforeach
        <p>=============UNDERSCONS======================</p>
        <div class="task-item">
            <div class="task-header">Pertemuan ke 1</div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <i class="bi bi-file-earmark-pdf"></i> Materi Awal - Pengertian IPA (PDF)
                </div>
                <div>
                    <button class="icon-btn"><i class="bi bi-eye"></i></button>
                    <button class="icon-btn"><i class="bi bi-pencil"></i></button>
                    <button class="icon-btn"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <button class="btn btn-outline-secondary w-100">+ Tambahkan Materi / Tugas / Ulangan</button>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 2</div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <i class="bi bi-file-earmark-pdf"></i> Materi Kedua - Spesifikasi Makhluk Hidup (PDF)
                </div>
                <div>
                    <button class="icon-btn"><i class="bi bi-eye"></i></button>
                    <button class="icon-btn"><i class="bi bi-pencil"></i></button>
                    <button class="icon-btn"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <i class="bi bi-pencil"></i> Tugas - Merangkum (<span class="task-title">Tugas</span>)
                </div>
            </div>
            <button class="btn btn-outline-secondary w-100">+ Tambahkan Materi / Tugas / Ulangan</button>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 3</div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <i class="bi bi-file-earmark"></i> Tulang Manusia (<span class="text-purple">Ulangan</span>)
                </div>
                <div>
                    <button class="icon-btn"><i class="bi bi-eye"></i></button>
                    <button class="icon-btn"><i class="bi bi-pencil"></i></button>
                    <button class="icon-btn"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <button class="btn btn-outline-secondary w-100">+ Tambahkan Materi / Tugas / Ulangan</button>
        </div>

        <div class="task-item">
            <div class="task-header">Pertemuan ke 4</div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <i class="bi bi-file-earmark"></i> Ulangan Tengah Semester (<span class="text-purple">Ulangan</span>)
                </div>
                <div>
                    <button class="icon-btn"><i class="bi bi-eye"></i></button>
                    <button class="icon-btn"><i class="bi bi-pencil"></i></button>
                    <button class="icon-btn"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            <button class="btn btn-outline-secondary w-100">+ Tambahkan Materi / Tugas / Ulangan</button>
        </div>
    </div>
@endsection
