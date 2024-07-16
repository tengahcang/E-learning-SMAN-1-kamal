@extends('layouts.app')
@section('content')
    <div class="bg-white p-4 rounded-3 shadow-sm mt-3">
        <h6>INPUT MATA PELAJARAN</h6>
        <div class="mt-4">
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="namaMataPelajaran" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control @error('subject_name') is-invalid @enderror"
                            name="subject_name" id="namaMataPelajaran" placeholder="BAHASA INDONESIA">
                        @error('subject_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="guruPengampu" class="form-label">Guru Pengampu</label>
                        <select class="form-select @error('teacher') is-invalid @enderror" name="teacher" id="guruPengampu">
                            <option selected>Hendro Laksono</option>
                            <!-- Add more options as needed -->
                        </select>
                        @error('teacher')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select @error('class') is-invalid @enderror" name="class" id="kelas">
                            <option selected>X - MIPA 2</option>
                            <!-- Add more options as needed -->
                        </select>
                        @error('class')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="tambahSiswa" class="form-label">Tambahkan Siswa</label>
                        <select class="form-select @error('student') is-invalid @enderror" name="student" id="tambahSiswa">
                            <option selected>Cindy Gracya</option>
                            <!-- Add more options as needed -->
                        </select>
                        @error('student')
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
