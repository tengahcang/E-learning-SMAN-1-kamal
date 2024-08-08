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

class SiswaImport implements ToModel, WithHeadingRow, ToCollection
{
    // /**
    // * @param Collection $collection
    // */
    private $failedRows = [];
    public function collection(Collection $rows)
    {
        //
        return $rows->skip(2);
    }
    public function model(array $row)
    {
        $existingSiswa = Siswa::where('NISN', $row['nisn'])->first();
        // Create the Siswa record first
        if(is_null($existingSiswa) && !is_null($row['nisn']) && !is_null($row['nama'])){
            $siswa = Siswa::create([
                'name' => $row['nama'],
                'NISN' => $row['nisn'],
            ]);
            // Use the ID of the created Siswa record to create the User record
            User::create([
                'name' => $row['nama'],
                'username' => $row['nisn'],
                'password' => Hash::make($row['nisn']),
                'role' => 'siswa',
                'id_siswa' => $siswa->id,
            ]);
            return $siswa;
        }else{
            $this->failedRows[] = $row;
        }
         // Optionally return the Siswa object
    }
    public function headingRow(): int
    {
        return 3;
    }
    public function getFailedRows()
    {
        return $this->failedRows;
    }
}
