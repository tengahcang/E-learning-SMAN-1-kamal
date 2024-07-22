@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <hr>
    <div class="table-responsive border p-3 rounded-3">
        <H1>tabel siswa</H1>
        <h2>Siswa (Total: {{ $studentCount }})</h2>
        <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="studentTable">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>No</th>
                    <th>Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $index => $student)
                    <tr>
                        {{-- <td>{{ $student->id }}</td> --}}
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                                <div>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="table-responsive border p-3 rounded-3">
        <H1>tabel guru</H1>
        <h2>Guru (Total: {{ $teacherCount }})</h2>
        <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="teacherTable">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>No</th>
                    <th>Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $index => $teacher)
                    <tr>
                        {{-- <td>{{ $teacher->id }}</td> --}}
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                <a href="" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                                <div>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#studentTable').DataTable();
            $('#teacherTable').DataTable();
        });
    </script>
@endpush
