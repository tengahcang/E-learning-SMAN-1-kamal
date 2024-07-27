@extends('layouts.app')

@section('content')    <style>
    .footer-cardpelajaran {
        background-color: #D9D9D9
    }

    .card-item {
        height: 150px;
    }

    .card-item div {
        height: 100%;
        display: flex;
        align-items: flex-end;
        padding: 0.5rem;
    }

    .schedule {
        margin-top: 2rem;
    }

    .schedule-item {
        display: flex;
        justify-content: space-between;

        /* border-bottom: 1px solid #ccc; */
    }

    .schedule-item:last-child {
        border-bottom: none;
    }
</style>

<div class="container">
    <div class="row bg-white p-3 shadow-sm">
        <h5 class="mb-4">Pelajaran saya</h5>
        @foreach ($kelas_siswa as $kelas)
            <div class="col-md-3 col-sm-6 mb-3 ">
                <a href="{{ route('student.matapelajaran.index', ['id_room' => $kelas->id]) }}">
                    <div class="card bg-success border-0 text-white card-item">
                        <div class="mb-5"></div>
                        <div class="text-dark footer-cardpelajaran rounded-bottom card-text">
                            {{ $kelas->subject->name }}<br>{{ $kelas->class->name }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
</div>
@endsection
