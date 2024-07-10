@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $mataPelajaran->kelas->name }} - {{ $mataPelajaran->name }}</h1>
    <div class="mt-3 mb-3">
        {{-- <a href="{{ route('mata-pelajaran.create-aktivitas', $mataPelajaran->id) }}" class="btn btn-primary">+ Tambah Materi / Tugas / Ulangan</a> --}}
    </div>
    <div class="list-group">
        @foreach($mataPelajaran->aktivitas as $aktivitas)
            <div class="list-group-item">
                <h5>{{ $aktivitas->title }}</h5>
                <p>{{ $aktivitas->description }}</p>
                <div>
                    {{-- <a href="{{ route('mata-pelajaran.edit-aktivitas', $aktivitas->id) }}" class="btn btn-warning">Edit</a> --}}
                    {{-- <form action="{{ route('mata-pelajaran.delete-aktivitas', $aktivitas->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
