@extends('layouts.app')

@section('content')
<div class="container">
    <h4 >{{ $room->subject->name." - ". $room->class->name }}</h4>
    <div class="row bg-white p-3 mt-3 ">
        @foreach($activities as $activity)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 style="font-weight: bold">{{ $activity->name }}</h5>

                </div>
                <ul class="list-group mt-2">
                    @foreach($activity->subject_matter as $matter)
                    <li class="list-group-item bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>
                                    <a href="{{ route('student.materi.show', $matter->id) }}">{{ $matter->name }}</a>
                                    {{-- <span style="color: red;">(Tugas)</span> --}}
                                </h5>

                            </div>
                        </div>
                    </li>
                    @endforeach
                    @foreach($activity->tasks as $task)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>
                                    <a href="{{ route('student.tugas.show', $task->id) }}">{{ $task->name }}</a>
                                    <span style="color: red;">(Tugas)</span>
                                </h5>

                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
