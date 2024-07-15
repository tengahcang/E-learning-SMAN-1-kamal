<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_siswas', 'id_siswa', 'id_room');
    }
}
