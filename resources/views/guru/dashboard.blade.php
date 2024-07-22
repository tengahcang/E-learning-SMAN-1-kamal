@extends('layouts.app')
@section('content')

    <style>
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
    {{-- <div class="container">
        <div class="row"> --}}
    {{-- <div class="col-12 mb-3">
                <h2>Overview Pelajaran</h2>
            </div> --}}
    {{-- @foreach ($rooms as $room)
                <div class="col-md-3 mb-3">
                    <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $room->id]) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $room->subject->name . ' ' . $room->class->name }}</h5>
                                <p class="card-text">{{ $room->subject->name }}</p> --}}
    {{-- </div>
                        </div>
                    </a>
                </div>
            @endforeach --}}
    {{-- </div>
    </div> --}}
    <div class="container">

        <div class="bg-white px-3 py-4 shadow-sm rounded">
            <h5>OVERVIEW PELAJARAN</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="dropdown">
                        <select class="form-select" aria-label="Filter options">
                            <option selected><i class="bi bi-funnel"></i> All</option>
                            <option value="1">Action</option>
                            <option value="2">Another action</option>
                            <option value="3">Something else here</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="btn btn-light me-2">Course Name</button>
                    {{-- <button class="btn btn-light">Card</button> --}}
                </div>
            </div>
            <div class="row mt-5">

                @foreach ($rooms as $room)
                    <div class="col-md-3 col-sm-6 mb-3 ">
                        <a href="{{ route('matapelajaran.index', ['id_room' => $room->id]) }}">
                            <div class="card bg-success text-white card-item">
                                <div></div>
                                <div class="text-dark footer-cardpelajaran  rounded-bottom card-text">
                                    {{ $room->class->name }}<br>{{ $room->subject->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-danger text-white card-item">
                        <div></div>
                        <div class="text-dark footer-cardpelajaran  rounded-bottom card-text">X-MIA1<br>MATEMATIKA</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-primary text-white card-item">
                        <div></div>
                        <div class="text-dark footer-cardpelajaran rounded-bottom card-text">X-MIA1<br>MATEMATIKA</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-warning text-white card-item">
                        <div></div>
                        <div class="text-dark footer-cardpelajaran rounded-bottom card-text">X-MIA2<br>MATEMATIKA</div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="schedule bg-white p-3 rounded">
            <h5>JADWAL KELAS</h5>
            <div class="schedule-item mt-5">
                <div>ILMU PENGETAHUAN ALAM - XII MIPA 2</div>
                <div>Senin, 14 Juni 2024</div>
            </div>
            <hr>
            <div class="schedule-item">
                <div>MATEMATIKA - XII MIPA 2</div>
                <div>Senin, 14 Juni 2024</div>
            </div>
        </div>
    </div>
@endsection
