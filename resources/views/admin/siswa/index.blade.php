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
                        <a href="{{ route('employees.exportExcel') }}" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i> to Excel
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('employees.exportPdf') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i> to PDF
                        </a>
                    </li> --}}
                    <li class="list-inline-item">|</li>
                    {{-- <li class="list-inline-item">
                        <a href="{{ route('students.import.form') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Add Student Excel
                        </a>
                    </li> --}}
                    <li class="list-inline-item">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Create Student
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-responsive border p-3 rounded-3">
            <H1>tabel siswa</H1>
            {{-- <h2>Siswa (Total: {{ $studentCount }})</h2> --}}
            <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="employeeTable">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>No</th>
                        <th>Nama</th>
                        <th>username</th>
                        <th>password</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            {{-- <td>{{ $student->id }}</td> --}}
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->username }}</td>
                            <td>{{ str_repeat('*', $student->password_length) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('students.show', ['student'=> $student->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                                    <a href="{{ route('students.edit', ['student'=> $student->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                                    <div>
                                        <form action="{{ route('students.destroy', ['student'=> $student->id]) }}" method="POST">
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

    </div>
@endsection
