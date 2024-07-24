<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $guru = Guru::create([
            'name' => $row['nama'],
            'NIP' => $row['nip'],
        ]);

        // Use the ID of the created Siswa record to create the User record
        User::create([
            'name' => $row['nama'],
            'username' => $row['nip'],
            'password' => Hash::make($row['nip']),
            'role' => 'guru',
            'id_guru' => $guru->id,
        ]);

        return $guru;
    }
    public function headingRow(): int
    {
        return 2;
    }
}
