<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSiswa extends Model
{
    use HasFactory;
    public function room(){
        return $this->belongsTo(Room::class,'id_room');
    }
    public function student(){
        return $this->belongsTo(Siswa::class,'id_siswa');
    }
}
