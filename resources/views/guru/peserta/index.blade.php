@extends('layouts.app')

@section('content')
<div class="container bg-white p-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>{{ $participant->class->name }}-{{ $participant->subject->name }} </h4>
        <div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label for="name">Nama Guru Pengampu:</label>
                <input type="text" class="form-control" id="name" name="name" disabled value="{{ $participant->teacher->name }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-4">
                <label for="name">NIP Guru Pengampu:</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $participant->teacher->NIP}}" disabled required>
            </div>
        </div>
    </div>
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
                @foreach ($students_room->students as $index => $student)
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
</div>
@endsection
@push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('#roomTable').DataTable();
            });
        </script>
    @endpush
