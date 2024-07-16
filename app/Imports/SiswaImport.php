<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithHeadingRow, WithStartRow, WithMultipleSheets
{
    // /**
    // * @param Collection $collection
    // */
    // public function collection(Collection $collection)
    // {
    //     //
    // }
    protected $sheetName;
    protected $startRow;
    public function __construct($sheetName, $startRow)
    {
        $this->sheetName = $sheetName;
        $this->startRow = $startRow;
    }
    public function model(array $row)
    {
        // Create the Siswa record first
        $siswa = Siswa::create([
            'name' => $row[4],
            'NISN' => $row[2],
        ]);

        // Use the ID of the created Siswa record to create the User record
        User::create([
            'name' => $row[4],
            'username' => $row[2],
            'password' => Hash::make($row[2]),
            'role' => 'siswa',
            'id_siswa' => $siswa->id,
        ]);

        return $siswa; // Optionally return the Siswa object

    }
    public function startRow(): int
    {
        return $this->startRow;
    }
    public function sheets(): array
    {
        return [
            $this->sheetName => $this,
        ];
    }
}
