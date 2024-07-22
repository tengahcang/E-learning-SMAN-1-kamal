<!-- resources/views/siswa/pengumpulan/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pengumpulan Tugas: {{ $task->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('student.pengumpulan.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <div class="form-group">
            <input type="textarea" name="content" id="content">
        </div>
        <div class="form-group">
            <label for="files">Upload Files:</label>
            <div id="dropzone" class="dropzone">
                <input type="file" name="files[]" id="file" multiple class="form-control">
            </div>
            @error('files')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kumpulkan</button>
    </form>
</div>

<style>
.dropzone {
    border: 2px dashed #007bff;
    padding: 20px;
    text-align: center;
    cursor: pointer;
}
.dropzone.dragover {
    border-color: #28a745;
}
</style>

{{-- <script>
document.addEventListener('DOMContentLoaded', function () {
    let dropzone = document.getElementById('dropzone');
    let fileInput = document.getElementById('file');

    dropzone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', function () {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
    });

    dropzone.addEventListener('click', function () {
        fileInput.click();
    });
});
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let dropzone = document.getElementById('dropzone');
        let fileInput = document.getElementById('file');
        let fileDialogOpen = false;

        dropzone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', function () {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', function (e) {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            fileDialogOpen = false;
        });

        dropzone.addEventListener('click', function () {
            if (!fileDialogOpen) {
                fileInput.click();
                fileDialogOpen = true;
            }
        });

        fileInput.addEventListener('change', function () {
            fileDialogOpen = false;
        });
    });
</script>
@endsection
