<?php

namespace App\Exports;

use App\Models\Pengumpulan;
use App\Models\Room;
use App\Models\Tugas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SemuaPengumpulanExport implements FromCollection, WithHeadings
{
    protected $roomId;

    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $students = Room::find($this->roomId)->students;
        $tasks = Tugas::whereHas('activity', function($query) {
            $query->where('id_room', $this->roomId);
        })->get();

        $data = [];

        foreach ($students as $student) {
            $row = ['NISN' => $student->NISN, 'Name' => $student->name];
            foreach ($tasks as $task) {
                $submission = Pengumpulan::where('id_tugas', $task->id)->where('id_siswa', $student->id)->first();
                $row[$task->name] = $submission ? $submission->nilai : 0;
            }
            $data[] = $row;
        }

        return collect($data);
    }
    /**
     * @param mixed $row
     *
     * @return array
     */
    // public function map($row): array
    // {
    //     return [
    //         $row['NISN'],
    //         $row['name'],
    //         $row['task_name'],
    //         $row['updated_at'],
    //         $row['content'],
    //         $row['nilai'],
    //     ];
    // }
    public function headings(): array
    {
        $tasks = Tugas::whereHas('activity', function($query) {
            $query->where('id_room', $this->roomId);
        })->pluck('name')->toArray();

        return array_merge(['NISN', 'Name'], $tasks);
    }
}
