<?php

namespace App\Exports;

use App\Models\Pengumpulan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengumpulanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $taskId;
    protected $students;

    public function __construct($taskId,$students)
    {
        $this->taskId = $taskId;
        $this->students = $students;
    }
    /**
     * @param mixed $pengumpulan
     *
     * @return array
     */
    public function collection()
    {
        $pengumpulans = Pengumpulan::with('siswa')
            ->where('id_tugas', $this->taskId)
            ->get()
            ->keyBy('id_siswa');

        $data = collect();

        foreach ($this->students as $student) {
            $data->push([
                'NISN' => $student->NISN,
                'name' => $student->name,
                'updated_at' => isset($pengumpulans[$student->id]) ? $pengumpulans[$student->id]->updated_at : null,
                'content' => isset($pengumpulans[$student->id]) ? $pengumpulans[$student->id]->content : '',
                'nilai' => isset($pengumpulans[$student->id]) ? $pengumpulans[$student->id]->nilai : 0,
            ]);
        }

        return $data;
    }
    public function map($row): array
    {
        // dd($row);
        return [
            $row['NISN'],
            $row['name'],
            $row['updated_at'],
            $row['content'],
            $row['nilai'] !== null ? $row['nilai'] : 0,
        ];
    }
    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
            'Terakhir diedit',
            'Content',
            'Nilai',
        ];
    }
}
