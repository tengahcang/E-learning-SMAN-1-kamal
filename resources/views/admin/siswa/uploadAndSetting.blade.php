@extends('layouts.app')
@section('content')
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    @isset($sheetNames)
        <form action="/import" method="POST">
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
@endsection
