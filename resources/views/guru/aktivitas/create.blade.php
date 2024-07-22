@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <form action="{{ route('teacher.matapelajaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Create Pertemuan</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Pertemuan') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    {{-- <div class="col-md-6 mb-3"> --}}
                        {{-- <label for="room" class="col-md-4 col-form-label text-md-end">{{ __('room') }}</label> --}}
                            <input id="room" type="hidden" class="form-control @error('name') is-invalid @enderror" name="room" value="{{ $id }}" required autocomplete="room" autofocus>
                            {{-- @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                    {{-- </div> --}}
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ Route('teacher.matapelajaran.index',['id_room'=>$id]) }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                    </div>
                    <div class="col-md-6 d-grid">
                        <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
