<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public function subject(){
        return $this->belongsTo(MataPelajaran::class,'id_matpel');
    }
    public function class(){
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function teacher(){
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function students(){
        return $this->belongsToMany(Siswa::class, 'room_siswas', 'id_room', 'id_siswa');
    }
    public function activities(){
        return $this->hasMany(Aktivitas::class, 'id_room');
    }
}
