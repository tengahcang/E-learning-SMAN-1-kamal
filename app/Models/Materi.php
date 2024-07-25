<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Materi extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    public function activity(){
        return $this->belongsTo(Aktivitas::class, 'id_aktivitas');
    }
}
