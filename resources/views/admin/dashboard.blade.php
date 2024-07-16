@extends('layouts.app')
@section('content')
    <div class="container bg-white p-4 rounded-3 shadow-sm">
        <h6>JUMLAH SISWA DAN GURU</h6>
        <div class="row g-3 column-gap-3 mt-3">
            <div class="col-3 text-white count-object p-4 rounded-3">
                <div class="text-count d-flex flex-column  justify-content-center align-items-center ">
                    <h1>{{ $studentCount }}</h1>
                </div>
                <h5>SISWA</h5>
            </div>
            <div class="col-3 text-white count-object p-4 rounded-3">
                <div class="text-count d-flex flex-column  justify-content-center align-items-center ">
                    <h1>{{ $teacherCount }}</h1>
                </div>
                <h5>GURU</h5>
            </div>
        </div>
    </div>
    <div class="container bg-white p-4 rounded-3 shadow-sm mt-3">
        <h6>Tabel Siswa</h6>
        <div>
            <table id="siswa" class="table table-striped nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->telephone }}</td>
                            <td>
                                <a class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                <a class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <form method="POST"
                                    style="display:inline-block;">
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
    <div class="container bg-white p-4 rounded-3 shadow-sm mt-3">
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
                                <form method="POST"
                                    style="display:inline-block;">
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
