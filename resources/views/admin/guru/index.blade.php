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
                        <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-create">
                            <i class="bi bi-plus-circle me-1"></i> Create Teacher
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-responsive bg-white p-4 rounded-3 shadow-sm mt-3">
            <h6>Tabel Guru</h6>
            <div>
                <table id="guru" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $index => $teacher)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->NIP }}</td>
                                <td>{{ $teacher->telephone }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form method="POST" style="display:inline-block;">
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

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js
                            "></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#siswa', {
            responsive: true
        });
    </script>
    <script>
        new DataTable('#guru', {
            responsive: true
        });
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection
