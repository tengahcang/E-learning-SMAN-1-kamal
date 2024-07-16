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

    {{-- <form action="{{ route('students.import.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Pilih File Excel:</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form> --}}

    <form action="{{ route('students.upload.form') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Pilih File Excel:</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    @isset($sheetNames)
        <form action="{{ route('students.import') }}" method="POST">
            @csrf
            <input type="hidden" name="file_path" value="{{ $fullPath }}">
            <label for="sheet">Pilih Sheet:</label>
            <select name="sheet" id="sheet">
                @foreach ($sheetNames as $sheetName)
                    <option value="{{ $sheetName }}">{{ $sheetName }}</option>
                @endforeach
            </select>
            <label for="start_row">Mulai dari Baris:</label>
            <input type="number" name="start_row" id="start_row" min="1" required>
            <button type="submit">Impor Data</button>
        </form>
    @endisset
</div>
@endsection
{{-- @extends('layouts.app')
@section('content')
    <H1>Tes</H1>
@endsection --}}
