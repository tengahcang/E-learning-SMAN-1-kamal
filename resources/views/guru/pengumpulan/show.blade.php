@extends('layouts.app')

@section('content')
<div class="container bg-white p-3 shadow-sm">
    <h1>Pengumpulan Tugas: {{ $task->name }}</h1>
    <h2>Daftar Siswa</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Pengumpulan Tugas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Content</th>
                <th>File</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengumpulans as $index => $pengumpulan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengumpulan->siswa->NISN }}</td>
                    <td>{{ $pengumpulan->siswa->name }}</td>
                    <td>{{ $pengumpulan->content }}</td>
                    <td>
                        @if ($pengumpulan->hasMedia('pengumpulans'))
                            @foreach ($pengumpulan->getMedia('pengumpulans') as $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->getCustomProperty('original_name') }}</a><br>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('teacher.tugas.saveNilai', [$task->id, $pengumpulan->id]) }}" method="POST">
                            @csrf
                            <input type="number" name="nilai" value="{{ $pengumpulan->nilai }}" class="form-control" required>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('teacher.matapelajaran.index', ['id_room' => $task->activity->id_room]) }}" class="btn btn-secondary btn-sm">Back</a>
</div>
@endsection
