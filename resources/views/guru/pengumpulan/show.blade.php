@extends('layouts.app')

@section('content')
<div class="container bg-white p-3 shadow-sm">
    <h1>Pengumpulan Tugas: {{ $task->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Terakhir diedit</th>
                <th>Content</th>
                <th>File</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->NISN }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        @if(isset($pengumpulans[$student->id]))
                            {{ $pengumpulans[$student->id]->updated_at }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(isset($pengumpulans[$student->id]))
                            {!! nl2br(e($pengumpulans[$student->id]->content)) !!}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(isset($pengumpulans[$student->id]) && $pengumpulans[$student->id]->hasMedia('pengumpulans'))
                            @foreach ($pengumpulans[$student->id]->getMedia('pengumpulans') as $media)
                                <a href="{{ route('download.media', $media->id) }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a><br>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(isset($pengumpulans[$student->id]))
                            <form action="{{ route('teacher.tugas.saveNilai', [$task->id, $pengumpulans[$student->id]->id]) }}" method="POST">
                                @csrf
                                <input type="number" name="nilai" value="{{ $pengumpulans[$student->id]->nilai }}" class="form-control" required>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $task->activity->id_room]) }}" class="btn btn-secondary btn-sm">Back</a>
    <a href="{{ route('teacher.tugas.exportNilai', $task->id) }}" class="btn btn-success btn-sm">Export Nilai</a>
</div>
@endsection
