@extends('layouts.app')
@section('content')
    <div class="container-sm py-4 bg-white px-3 shadow-sm rounded">
        <h5 class="font-weight-bold">Detail Siswa</h5>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama</label>
                <h5>{{ $user->name }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">NISN</label>
                <h5>{{ $user->username }}</h5>
            </div>
            {{-- <div class="col-md-12 mb-3">
            <label for="address" class="form-label">Alamat</label>
            <h5>{{ $student->address }}</h5>
        </div>
        <div class="col-md-12 mb-3">
            <label for="telephone" class="form-label">Telepon</label>
            <h5>{{ $student->telephone }}</h5>
        </div> --}}
            <div class="col-md-3 d-grid">
                <a class="btn btn-danger btn-lg mt-3" href="{{ route('students.index') }}"><i
                        class="bi-arrow-left-circle me-2"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
