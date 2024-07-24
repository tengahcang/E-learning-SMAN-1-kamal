{{-- @extends('layouts.app')
@section('content')
<div class="container">
    <h1>Import Data Siswa</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">INPUT DATA EXCEL GURU</h5>
                <a href="" class="btn btn-success">Download Template Excel</a>
            </div>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="upload-area" style="border: 2px dashed #007bff; padding: 30px; text-align: center;">
                        <label for="file-upload" class="btn btn-primary">Choose File Or Drag Here</label>
                        <input type="file" id="file-upload" name="file" style="display: none;" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>


</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var fileInput = document.getElementById('file-upload');
        var uploadArea = document.querySelector('.upload-area');

        uploadArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.add('dragging');
        });

        uploadArea.addEventListener('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.remove('dragging');
        });

        uploadArea.addEventListener('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.remove('dragging');
            var files = e.dataTransfer.files;
            fileInput.files = files;
        });

        uploadArea.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            // Handle file selection
        });
    });
</script>
@endsection --}}

@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Import Data Siswa</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">INPUT DATA EXCEL GURU</h5>
                <a href="{{ route('teachers.download-template') }}" class="btn btn-success">Download Template Excel</a>
            </div>
            <form action="{{ route('teachers.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="upload-area" style="border: 2px dashed #007bff; padding: 30px; text-align: center; position: relative;">
                        <label for="file-upload" class="btn btn-primary upload-label" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">Choose File Or Drag Here</label>
                        <input type="file" id="file-upload" name="file" style="display: none;" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>
<style>
    .upload-area.dragging {
        border-color: #28a745;
    }

    .upload-label {
        cursor: pointer;
    }

    .upload-area.dragging .upload-label {
        color: #28a745;
    }
    </style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var fileInput = document.getElementById('file-upload');
        var uploadArea = document.querySelector('.upload-area');
        var uploadLabel = document.querySelector('.upload-label');

        uploadArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.add('dragging');
        });

        uploadArea.addEventListener('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.remove('dragging');
        });

        uploadArea.addEventListener('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            uploadArea.classList.remove('dragging');
            var files = e.dataTransfer.files;
            fileInput.files = files;
            updateLabel(files);
        });

        uploadArea.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            var files = fileInput.files;
            updateLabel(files);
        });

        function updateLabel(files) {
            if (files.length > 0) {
                uploadLabel.textContent = 'File Selected: ' + files[0].name;
                uploadLabel.style.color = '#28a745';
                uploadLabel.style.fontWeight = 'bold';
            } else {
                uploadLabel.textContent = 'Choose File Or Drag Here';
                uploadLabel.style.color = '#007bff';
                uploadLabel.style.fontWeight = 'normal';
            }
        }
    });
</script>
@endsection
