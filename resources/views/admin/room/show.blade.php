@extends('layouts.app')
@section('content')
    <div class="container-sm ">
        <div class="row ">
            <div class="p-5 bg-white rounded  shadow-sm">
                <h5>Detail Room</h5>
                <div class="row mt-4">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <h5>{{ $room->subject->name . ' - ' . $room->class->name }}</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="username" class="form-label">Guru</label>
                        <h5>{{ $room->teacher->name }}</h5>
                    </div>
                    {{-- <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <h5>{{ $teacher->address }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="telephone" class="form-label">Telepon</label>
                    <h5>{{ $teacher->telephone }}</h5>
                </div> --}}
                    <div class="col-md-12 mb-3">
                        <label for="students" class="form-label">Daftar Siswa</label>
                        <table class="table table-bordered table-hover table-striped mb-0 bg-white" id="roomTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Siswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room->students as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $student->NISN }}</td>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <a class="btn btn-danger btn-md mt-3" href="{{ route('rooms.index') }}"><i
                        class="bi-arrow-left-circle me-2"></i>Back</a>
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
