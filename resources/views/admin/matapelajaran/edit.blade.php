@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <form action="{{ route('subjects.update',['subject'=>$subject->id]) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Edit mata pelajaran</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $errors->any() ? old('name') : $subject->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi') }}</label>

                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $errors->any() ? old('description') : $subject->description }}"  autocomplete="description">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>
                    {{-- <div class="col-md-6 mb-3">
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
                </div> --}}
                <hr>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('subjects.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
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
@endsection
