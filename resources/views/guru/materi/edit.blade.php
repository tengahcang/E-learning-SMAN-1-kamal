@extends('layouts.app')

@section('content')
<div class="container bg-white p-3 shadow-sm">
    <h3 class="mb-4">Edit Tugas untuk {{ $activity->name }}</h3>
    <form action="{{ route('teacher.materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id_activity" value="{{ $activity->id }}">
        <input type="hidden" name="id_room" value="{{ $activity->id_room }}">
        <div class="form-group mb-4">
            <label for="name">Nama Materi</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $materi->name }}" required>
        </div>
        <div class="form-group mb-4">
            <label for="file">Unggah Materi</label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>
        <div class="form-group">
            <label>Files yang sudah dikumpulkan:</label>
            <div class="uploaded-files">
                @foreach ($materi->getMedia('materi') as $media)
                    <button type="button" class="file-item btn btn-light" data-id="{{ $media->id }}" data-name="{{ $media->getCustomProperty('original_name') }}" data-bs-toggle="modal" data-bs-target="#fileModal">
                        <img src="{{ $media->getUrl() }}" alt="{{ $media->getCustomProperty('original_name') }}" class="file-thumbnail">
                        <p>{{ $media->getCustomProperty('original_name') }}</p>
                    </button>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update Materi</button>
    </form>
</div>
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">Edit File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="delete-file-btn" method="POST" action="">
                    @csrf
                    @method('delete')
                    <img src="{{ $media->getUrl() }}" alt="{{ $media->getCustomProperty('original_name') }}" class="file-thumbnail">
                        <p>{{ $media->getCustomProperty('original_name') }}</p>
                    <input type="hidden" name="idData" id="idData">
                    <input type="hidden" name="idSubmission" id="idSubmission">
                    <button type="submit" class="btn btn-danger">delete changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let editForm = document.getElementById('edit-file-form');
        let deleteForm = document.getElementById('delete-file-form');
        let idData = document.getElementById('idData');
        let idSubmission = document.getElementById('idSubmission');
        let deleteIdData = document.getElementById('deleteIdData');
        let deleteIdSubmission = document.getElementById('deleteIdSubmission');

        document.querySelectorAll('.file-item').forEach(function(item) {
            item.addEventListener('click', function() {
                let submisionId = '{{ $materi->id }}';
                let fileId = this.getAttribute('data-id');
                idData.value = fileId;
                idSubmission.value = submisionId;
                deleteIdData.value = fileId;
                deleteIdSubmission.value = submisionId;
            });
        });

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
</script>
