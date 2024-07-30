<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request
     $request,$user)
    {
        if ($user->hasRole('admin')){
            return redirect()->route('admin');
        }elseif ($user->hasRole('guru')){
            return redirect()->route('guru');
        }elseif ($user->hasRole('siswa')){
            return redirect()->route('siswa');
        }else{
            return redirect($this->redirectTo);
        }
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where($this->username(), $request->{$this->username()})->first();
        if (!$user) {
            $errors = [$this->username() => 'Username tidak ditemukan.'];
        } elseif (!Hash::check($request->password, $user->password)) {
            $errors = ['password' => 'Password salah.'];
        } else {
            $errors = [$this->username() => 'Login gagal.'];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
