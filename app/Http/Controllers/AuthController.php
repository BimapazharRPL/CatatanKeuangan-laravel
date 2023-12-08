<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }
    //register form
    public function register()
    {
        return view('auth.register');
    }
    // store register
    public function store(Request $request, User $user, Auth $auth)
    {
        $request->validate([
            'name'  => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email',
            'status'  => 'required|string',
            'password'  => 'required|min:8'
        ]);


        $user->create([
            'name'  => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password'  => Hash::make($request->password)
        ]);


        $credential = $request->only('email', 'password');
        $auth::attempt($credential);
        $request->session()->regenerate();


        return redirect()->route('dashboard')
        ->withSuccess('Anda telah Registrasi dan Login!');
    }

    //login form
    public function login()
   {
        return view('auth.login');
   }
   // authentication
   public function auth(Request $request, Auth $auth)
   {
        // validasi form input
        $request->validate([
            'email'  => 'required|email', 
            'password' => 'required'
        ]);

        // proses authentikasi
        $credential = $request->only('email', 'password');
        if ($auth::attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        // jika proses authentikasi gagal maka akan di redirect ke halaman login
        return back()->withErrors([
            'email' => 'Email atau password tidak ditemukan',
        ])->onlyInput('email');

   }
   // dashboard
   public function dashboard()
   {
    if(Auth::check())
    {
        return view('auth.dashboard');
    }

    return redirect()->route('auth.login');
   }
   // logout
   public function logout(Request $request, Auth $auth)
   {
    $auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('auth.login');
   }
}