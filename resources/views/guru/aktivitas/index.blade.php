@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $room->subject->name." ". $room->class->name }}</h1>
    <div class="mt-3 mb-3">
        <a href="{{ route('matapelajaran.create',['id_room'=>$room->id]) }}" class="btn btn-primary">+ Tambah Pertemuan</a>
    </div>
    <div class="list-group">
        @foreach($activities as $aktivitas)
            <div class="list-group-item">
                <h5>{{ $aktivitas->name }}</h5>
                {{-- <p>{{ $aktivitas->description }}</p> --}}
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
