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
                        <a href="{{ route('subjects.create') }}" class="btn btn-danger">
                            <i class="bi bi-plus-circle me-1"></i> Create Subject
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-responsive bg-white p-4 rounded-3 shadow-sm mt-3">
            {{-- <h2>Siswa (Total: {{ $studentCount }})</h2> --}}
            <div class="container ">
                <h6>Tabel Mata Pelajaran</h6>
                <div>
                    <table id="subject" class="table table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Mata Pelajaran</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $index => $subject)
                                <tr>
                                    {{-- <td>{{ $student->id }}</td> --}}
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->name }}</td>
                                    {{-- <td>{{ $subject->description }}</td> --}}
                                    {{-- <td>{{ $teacher->username }}</td>
                                            <td>{{ str_repeat('*', $teacher->password_length) }}</td> --}}
                                    <td>
                                        <div class="d-flex">
                                            {{-- <a href="{{ route('subjects.show', ['subject' => $subject->id]) }}"
                                                class="btn btn-outline-dark btn-sm me-2"><i
                                                    class="bi-person-lines-fill"></i></a> --}}
                                            <a href="{{ route('subjects.edit', ['subject' => $subject->id]) }}"
                                                class="btn btn-warning btn-sm me-2"><i
                                                    class="bi-pencil-square"></i></a>
                                            <div>
                                                <form action="{{ route('subjects.destroy', ['subject' => $subject->id]) }}"
                                                    method="POST">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js
                        "></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#subject', {
            responsive: true
        });
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"> --}}
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#subject').DataTable();
        })
    </script>
@endpush
