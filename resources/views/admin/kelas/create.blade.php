@extends('layouts.app')
@section('content')
    <div class="bg-white p-4 rounded-3 shadow-sm mt-3">
        <h6>INPUT KELAS</h6>
        <div class="mt-4">
            <form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control @error('class_name') is-invalid @enderror" name="class_name" id="class_name" placeholder="XII MIPA 3" value="{{ old('class_name') }}">
                        @error('class_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger w-100">Batal</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success w-100">Tambahkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
