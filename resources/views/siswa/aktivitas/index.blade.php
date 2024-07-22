@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $room->subject->name." ". $room->class->name }}</h1>
    <div class="list-group">
        @foreach($activities as $activity)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>{{ $activity->name }}</h3>

                </div>
                <ul class="list-group mt-2">
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
