{{-- @extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <form action="{{ route('teachers.update',['teacher'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Edit Siswa</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $errors->any() ? old('name') : $user->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('username') }}</label>

                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $errors->any() ? old('username') : $user->username }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan password baru (Biarkan tetap kosong jika password tidak berubah)" autocomplete="new-password">
                            <div class="input-group-append">
                                <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                                    <i id="toggle-password-icon" class="fa fa-eye"></i>
                                </button>
                            </div>
                             @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>

                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $errors->any() ? old('address') : $teacher->address }}" required autocomplete="address" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Telepon') }}</label>

                            <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $errors->any() ? old('telephone') : $teacher->telephone }}" required autocomplete="telephone" autofocus>
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                    </div>
                    <div class="col-md-6 d-grid">
                        <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    document.getElementById('toggle-password').addEventListener('click', function (e) {
        var passwordInput = document.getElementById('password');
        var passwordIcon = document.getElementById('toggle-password-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });
</script>
@endsection --}}
@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded-3 shadow-sm mt-3">
    <h6>INPUT GURU</h6>
    <div class="mt-4">
        <form action="{{ route('teachers.update',['teacher'=>$user->id]) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="namaGuru" class="form-label">Nama Guru</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $errors->any() ? old('name') : $user->name }}" placeholder="Raditya Dika" autocomplete="name" >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="nip" class="form-label">NIP (Nomor Induk Pegawai)</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" name="NIP" id="NIP"  value="{{ $errors->any() ? old('nip') : $user->username }}" autocomplete="NIP" placeholder="12034020199">
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
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Raditguru.">
                        <div class="input-group-append">
                            <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                                <i id="toggle-password-icon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-batal">Batal</button>
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
