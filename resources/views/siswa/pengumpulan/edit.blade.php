@extends('layouts.app')

@section('content')
    <div class="container bg-white p-3 shadow-sm">
        <h5 style="font-weight: bold">Edit Pengumpulan Tugas: {{ $task->name }}</h5>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('student.pengumpulan.update', ['pengumpulan' => $submision->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <div class="form-group">
                <input type="text" class="form-control" name="content" id="content"
                    value="{{ $errors->any() ? old('name') : $submision->content }}">
            </div>

            <div class="form-group mt-3">
                <label for="files">Upload Files:</label>
                <div id="dropzone" class="dropzone rounded">
                    <input class="btn btn-ungu" type="file" name="files[]" id="file" multiple class="form-control">
                </div>
                @error('files')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label>Files yang sudah dikumpulkan:</label>
                <div class="uploaded-files">
                    @foreach ($submision->getMedia('pengumpulans') as $media)
                        <button type="button" class="file-item btn btn-light" data-id="{{ $media->id }}"
                            data-name="{{ $media->getCustomProperty('original_name') }}" data-bs-toggle="modal"
                            data-bs-target="#fileModal">
                            <i class="bi bi-file-earmark"></i>
                            <p>{{ $media->getCustomProperty('original_name') }}</p>
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="d-flex  mt-5">
                <a href="{{ url()->previous() }}" class="btn btn-danger me-3">Kembali</a>
                <button type="submit" class="btn btn-ijo text-white">Simpan Pengumpulan</button>
            </div>

        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileModalLabel">Edit File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form id="edit-file-form" method="POST" action="{{ route('student.pengumpulan.updateFile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <input type="hidden" name="idData" id="idData">
                        <input type="hidden" name="idSubmission" id="idSubmission">
                        <label for="files">Upload Files:</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">edit changes</button>
                </form> --}}
                    <form id="delete-file-btn" method="POST" action="{{ route('student.pengumpulan.deleteFile') }}">
                        @csrf
                        @method('delete')
                        <img src="{{ $media->getUrl() }}" alt="{{ $media->getCustomProperty('original_name') }}"
                            class="file-thumbnail">
                        <p>{{ $media->getCustomProperty('original_name') }}</p>
                        <input type="hidden" name="idData" id="idData">
                        <input type="hidden" name="idSubmission" id="idSubmission">
                        <button type="submit" class="btn btn-danger">delete changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        .dropzone {
            border: 2px dashed #28a745;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .dropzone.dragover {
            border-color: #28a745;
        }

        .uploaded-files {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .file-item {

            align-items: center;
            text-align: center;
            cursor: pointer;
        }

        .file-thumbnail {
            width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editForm = document.getElementById('edit-file-form');
            let deleteForm = document.getElementById('delete-file-form');
            let idData = document.getElementById('idData');
            let idSubmission = document.getElementById('idSubmission');
            let deleteIdData = document.getElementById('deleteIdData');
            let deleteIdSubmission = document.getElementById('deleteIdSubmission');

            document.querySelectorAll('.file-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    let submisionId = '{{ $submision->id }}';
                    let fileId = this.getAttribute('data-id');
                    idData.value = fileId;
                    idSubmission.value = submisionId;
                    deleteIdData.value = fileId;
                    deleteIdSubmission.value = submisionId;
                });
            });

            let dropzone = document.getElementById('dropzone');
            let fileInput = document.getElementById('file');

            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                fileInput.files = e.dataTransfer.files;
            });

            dropzone.addEventListener('click', function() {
                fileInput.click();
            });
        });
    </script>
@endsection
