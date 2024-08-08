@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                {{-- <h4 class="mb-3">{{ $pageTitle }}</h4> --}}
            </div>
            <div class="col-lg-3 col-xl-6">
                <ul class="list-inline mb-0 float-end">
                    {{-- <li class="list-inline-item">
                        <a href="{{ route('employees.exportPdf') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i> to PDF
                        </a>
                    </li> --}}
                    <li class="list-inline-item">
                        <a href="{{ route('students.upload.form') }}" class="btn btn-danger" >
                            <i class="bi bi-plus-circle me-1"></i>Add Student Excel
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('students.create') }}" class="btn btn-danger">
                            <i class="bi bi-plus-circle me-1"></i> Create Student
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @if (session('failedRows'))
            <div class="alert alert-warning">
                <h4>Data yang gagal diimpor:</h4>
                <ul>
                    @foreach (session('failedRows') as $row)
                        <li>{{ $row['nisn'] }} - {{ $row['nama'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table-responsive bg-white p-4 rounded-3 shadow-sm mt-3">
            <h6>Tabel Siswa</h6>
            <div>
                <table id="studentTable" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            {{-- <th>Alamat</th> --}}
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ str_repeat('*', $student->password_length) }}</td>
                                {{-- <td>{{ $student->address }}</td> --}}
                                <td>
                                    <a href="{{ route('students.show', ['student' => $student->id]) }}"
                                        class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('students.edit', ['student' => $student->id]) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('students.destroy', ['student' => $student->id]) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
    <hr>

    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js
                            "></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script> --}}
    {{-- <script>
        new DataTable('#siswa', {
            responsive: true
        });
    </script>
    <script>
        new DataTable('#guru', {
            responsive: true
        });
    </script> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#studentTable').DataTable();
        });
    </script>
@endpush
