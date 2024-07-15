@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 mb-3">
            <h2>Overview Pelajaran</h2>
        </div>
        @foreach ($rooms as $room)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->class->name }}</h5>
                        <p class="card-text">{{ $room->subject->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
