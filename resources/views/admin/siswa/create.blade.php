@extends('layouts.app')
@section('content')
    <div class=" bg-white p-4 rounded-3 shadow-sm mt-3">
        <h6>INPUT SISWA</h6>
        <div class=" mt-4">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namaSiswa" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" id="namaSiswa" value="{{ old('name') }}" autocomplete="name"
                            placeholder="Masukkan Nama Siswa">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" placeholder="Masukkan NISN"
                            id="nisn" value="{{ old('nisn') }}" autocomplete="nisn">
                        @error('nisn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukkan Password">
                            <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                                <i id="toggle-password-icon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <a class="btn btn-danger btn-batal " href="{{ route('students.index') }}"><i
                        class="bi-arrow-left-circle me-2"></i>Batal</a>
                {{-- <button type="button" class="btn btn-danger btn-batal ">Batal</button> --}}
                <button type="submit" class="btn btn-success btn-tambah ">Tambahkan</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function(e) {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('toggle-password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi bi-eye');
                passwordIcon.classList.add('bi bi-eye-slash"');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi bi-eye-slash"');
                passwordIcon.classList.add('bi bi-eye');
            }
        });
    </script>
@endsection
