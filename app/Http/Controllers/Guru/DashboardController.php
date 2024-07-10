<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        // var_dump($rooms);
        return view('guru.dashboard', compact('user', 'rooms'));


    }
}
