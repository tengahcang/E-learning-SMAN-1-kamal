<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        // dd($user);
        return view('guru.dashboard', compact('user', 'rooms','id_guru'));
    }
    public function profile(){
        $user = Auth::user();
        $id_guru = $user->id_guru;
        $profile = Guru::find($id_guru);
        $rooms = Room::where('id_guru', $id_guru)->with('subject', 'class')->get();
        // dd($profile);
        return view('guru.profile',compact('profile', 'rooms'));
    }
    public function updatePassword(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Periksa apakah password dan konfirmasi password sama
        if ($request->password === $request->password_confirmation) {
            // Dapatkan pengguna yang sedang login
            $user = Auth::user();

            // Ubah password pengguna
            $user->password = Hash::make($request->password);
            $user->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } else {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Password dan konfirmasi password tidak sama.');
        }
    }
}
