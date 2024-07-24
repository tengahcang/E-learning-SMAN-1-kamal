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
                        <a href="{{ route('classes.create') }}" class="btn btn-primary btn-create">
                            <i class="bi bi-plus-circle me-1"></i> Create class
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="table-responsive bg-white p-4 rounded-3 shadow-sm mt-3">
        {{-- <h2>Siswa (Total: {{ $studentCount }})</h2> --}}
        <div class="container ">
            <h6>Tabel Kelas</h6>
            <div>
                <table class="table table-striped nowrap" style="width:100%" id="classTable">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $index => $class)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $class->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('classes.show', ['class' => $class->id]) }}"
                                            class="btn btn-info btn-sm"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ route('classes.edit', ['class' => $class->id]) }}"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                        <div>
                                            <form action="{{ route('classes.destroy', ['class' => $class->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i></button>
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
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css"> --}}
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function(){
            $('#classTable').DataTable();
        })
    </script>
@endpush
