<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    public function room(){
        return $this->belongsTo(Room::class, 'id_room');
    }
    public function tasks(){
        return $this->hasMany(Tugas::class,'id_aktivitas');
    }
    public function subject_matter(){
        return $this->hasMany(Materi::class,'id_aktivitas');
    }
}
