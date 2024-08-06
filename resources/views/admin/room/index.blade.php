@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                {{-- <h4 class="mb-3">{{ $pageTitle }}</h4> --}}
            </div>
            <div class="col-lg-3 col-xl-6">
                <ul class="list-inline mb-0 float-end">
                    <li class="list-inline-item">
                        <a href="{{ route('rooms.create') }}" class="btn btn-danger">
                            <i class="bi bi-plus-circle me-1"></i> Create room
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-responsive bg-white p-4 rounded-3 shadow-sm mt-3">
            <h6>Tabel Siswa</h6>
            <div>
                <table id="roomTable" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama mata pelajaran</th>
                            <th>Nama guru</th>
                            {{-- <th>password</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $index => $room)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>{{ $room->subject->name . ' - ' . $room->class->name }}</td>
                                <td>{{ $room->teacher->name }}</td>
                                {{-- <td>{{ $student->address }}</td> --}}
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('rooms.show', ['room' => $room->id]) }}"
                                            class="btn btn-info btn-sm me-2 "><i class="bi-person-lines-fill"></i></a>
                                        <a href="{{ route('admin.room.exportAllTasksNilai', $room->id) }}" class="btn btn-success btn-sm me-2 ">Export Nilai</a>
                                        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}"
                                            class="btn btn-warning btn-sm me-2"><i class="bi-pencil-square"></i></a>
                                        <div>
                                            <form action="{{ route('rooms.destroy', ['room' => $room->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm me-2"><i
                                                        class="bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>

    </div>
    @push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#roomTable').DataTable();
        });
    </script>
@endpush
@endsection
