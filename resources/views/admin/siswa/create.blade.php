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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" id="namaSiswa" value="{{ old('name') }}" autocomplete="name" placeholder="Hendro Laksono">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ old('nisn') }}" autocomplete="nisn">
                        @error('nisn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" placeholder="X - MIPA 2">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="hendroooo@gmail.com">
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Hendro10mipa2.">
                            <div class="input-group-append">
                                <button id="toggle-password" type="button" class="btn btn-outline-secondary">
                                    <i id="toggle-password-icon" class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-batal ">Batal</button>
                <button type="submit" class="btn btn-success btn-tambah ">Tambahkan</button>
                {{-- <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger w-100">Batal</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success w-100">Tambahkan</button>
                    </div>
                </div> --}}
            </form>
            {{-- <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="p-5 bg-light rounded-3 border col-xl-6">
                        <div class="mb-3 text-center">
                            <i class="bi-person-circle fs-1"></i>
                            <h4>Create Siswa</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Username / NISN') }}</label>

                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>

                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Telepon') }}</label>

                                <input id="telephone" type="number"
                                    class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                    value="{{ old('telephone') }}" autocomplete="telephone" autofocus>
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
                                <a href="{{ route('students.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i
                                        class="bi-arrow-left-circle me-2"></i> Cancel</a>
                            </div>
                            <div class="col-md-6 d-grid">
                                <button type="submit" class="btn btn-dark btn-lg mt-3"><i
                                        class="bi-check-circle me-2"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> --}}
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
