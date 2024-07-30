@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded-3 shadow-sm mt-3">
    <h6>INPUT GURU</h6>
    <div class="mt-4">
        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="namaGuru" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Raditya Dika" autocomplete="name" >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="nip" class="form-label">NIP (Nomor Induk Pegawai)</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="NIP" id="NIP" value="{{ old('nip') }}" autocomplete="NIP" placeholder="12034020199">
                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Raditguru.">
                    <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                        <i id="toggle-password-icon" class="bi bi-eye"></i>
                    </button>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <a href="{{route('teachers.index')}}" class="btn btn-danger btn-batal">Batal</a>
            {{-- <button  type="button" class="btn btn-danger btn-batal">Batal</button> --}}
            <button type="submit" class="btn btn-success btn-tambah">Tambahkan</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('toggle-password').addEventListener('click', function (e) {
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
