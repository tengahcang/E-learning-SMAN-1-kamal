@extends('layouts.app')
@section('content')
<div class="container-sm my-5">
    <div class="row justify-content-center">
        <div class="p-5 bg-light rounded-3 col-xl-4 border">
            <div class="mb-3 text-center">
                <i class="bi-person-circle fs-1"></i>
                <h4>Detail Siswa</h4>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <h5>{{ $user->name }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <h5>{{ $user->username }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <h5>{{ $teacher->address }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="telephone" class="form-label">Telepon</label>
                    <h5>{{ $teacher->telephone }}</h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 d-grid">
                    <a class="btn btn-outline-dark btn-lg mt-3" href="{{ route('teachers.index') }}"><i class="bi-arrow-left-circle me-2"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
