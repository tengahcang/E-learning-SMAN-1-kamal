@extends('layouts.app')
@section('content')
    <div class="container-sm py-4 bg-white px-3 shadow-sm rounded">
        <h5 class="font-weight-bold">Detail Guru</h5>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama</label>
                <h5>{{ $user->name }}</h5>
            </div>
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username</label>
                <h5>{{ $user->username }}</h5>
            </div>
            <div class="col-md-3 d-grid">
                <a class="btn btn-danger btn-lg mt-3" href="{{ route('teachers.index') }}"><i
                        class="bi-arrow-left-circle me-2"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
