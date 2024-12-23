@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Admin Edit Profile</h1>
    </div>

    <div class="row justify-content-center">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">PROFILE ADMIN</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        {{-- <i class="bi-person-circle fs-1" width="150"></i> --}}
                        <img src="{{ asset('img/user.png') }}" class="rounded-circle" alt="Avatar" width="150">
                    </div>
                    <form method="POST" action="{{ route('update-password') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" required>
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
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation">
                                    <i class="bi bi-eye-slash" id="togglePasswordConfirmationIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content">
                            {{-- <button type="button" class="btn btn-danger" onclick="window.history.back();">Batal</button> --}}
                            <a href="{{Route('admin')}}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success">Edit Profile</button>
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
