@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 mb-3">
            <h2>Kelas Saya</h2>
        </div>
        @foreach ($kelas_siswa as $kelas)
            <div class="col-md-3 mb-3">
                <a href="{{ route('student.matapelajaran.index', ['id_room' => $kelas->id]) }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kelas->subject->name }} - {{ $kelas->class->name }}</h5>
                            {{-- <p class="card-text">{{ $kelas->keterangan }}</p> --}}
                        </div>
                    </div>
                    {{-- <p>{{$kelas}}</p> --}}
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
