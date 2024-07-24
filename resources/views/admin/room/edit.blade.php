@extends('layouts.app')
@section('content')
<div class="container-sm mt-5">
    <form action="{{ route('rooms.update',['room'=>$room->id]) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-3 text-center">
                    <i class="bi-person-circle fs-1"></i>
                    <h4>Edit room</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <select name="subject" id="subject" class="form-select">
                            <option value="">pilih salah satu</option>
                        @php
                            $selected = "";
                            if ($errors->any())
                                $selected = old('subject');
                            else
                                $selected = $room->id_matpel;
                        @endphp
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $selected == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                        </select>
                        @error('subject')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <select name="class" id="class" class="form-select">
                            <option value="">pilih salah satu</option>
                        @php
                            $selected = "";
                            if ($errors->any())
                                $selected = old('class');
                            else
                                $selected = $room->id_matpel;
                        @endphp
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ $selected == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                        </select>
                        @error('class')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="teacher" class="form-label">Guru</label>
                        <select name="teacher" id="teacher" class="form-select">
                            <option value="">pilih salah satu</option>
                        @php
                            $selected = "";
                            if ($errors->any())
                                $selected = old('teacher');
                            else
                                $selected = $room->id_guru;
                        @endphp
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $selected == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                        </select>
                        @error('teacher')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="students" class="form-label">Siswa</label>
                        <select name="students[]" id="students" class="form-select" multiple>
                            @php
                                $selected = old('students', $selectedStudents);
                            @endphp
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ in_array($student->id, $selected) ? 'selected' : '' }}>{{ $student->name }}</option>
                            @endforeach
                        </select>
                        @error('students')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="students_file" class="form-label">Upload Data Siswa (Excel)</label>
                        <input type="file" name="students_file" id="students_file" class="form-control">
                        @error('students_file')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 d-grid">
                        <a href="{{ route('rooms.index') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
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
