@extends('layouts.app')
@section('content')


    <div class="row justify-content-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="p-4 bg-white shadow-sm rounded">
            <div>
                <div>
                    <h4 class="text-center">EDIT PROFILE GURU</h4>
                </div>
                <div>
                    <div class="text-center mb-3">
                        {{-- <i class="bi-person-circle fs-1" width="150"></i> --}}
                        {{-- <img src="{{ asset('img/user.png') }}" class="rounded-circle" alt="Avatar" width="150"> --}}
                    </div>
                    <form method="POST" action="{{ route('teacher.update-password') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="name" value="{{ $profile->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" class="form-control" id="nisn" value="{{ $profile->NIP }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation">
                                    <i class="bi bi-eye-slash" id="togglePasswordConfirmationIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content">
                            {{-- <button type="button" class="btn btn-danger" onclick="window.history.back();">Batal</button> --}}
                            <a href="{{ Route('guru') }}" class="btn btn-danger me-3">Batal</a>
                            <button type="submit" class="btn btn-ijo text-white">Edit Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const passwordFieldType = passwordField.attr('type');
                const toggleIcon = $('#togglePasswordIcon');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordField.attr('type', 'password');
                    toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });

            $('#togglePasswordConfirmation').on('click', function() {
                const passwordConfirmationField = $('#password_confirmation');
                const passwordConfirmationFieldType = passwordConfirmationField.attr('type');
                const toggleIcon = $('#togglePasswordConfirmationIcon');

                if (passwordConfirmationFieldType === 'password') {
                    passwordConfirmationField.attr('type', 'text');
                    toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordConfirmationField.attr('type', 'password');
                    toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });
        });
    </script>
@endpush
