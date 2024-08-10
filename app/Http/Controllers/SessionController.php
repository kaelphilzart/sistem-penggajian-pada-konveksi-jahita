<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;


class SessionController extends Controller
{
    //

    //login

    public function login(){
        return view('login');
    }
    public function login_akun()
    {
        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($attributes)) {
            $user = Auth::user(); // Mendapatkan objek pengguna yang berhasil login
            session()->regenerate();
    
            if ($user->level == 'pemilik') {
                return redirect('dashboard_pemilik')->with(['success' => 'Anda berhasil login sebagai Pemilik.']);
            } elseif ($user->level == 'admin') {
                return redirect('dashboard_admin')->with(['success' => 'Anda berhasil login sebagai Admin.']);
            } elseif ($user->level == 'karyawan') {
                return redirect('dashboard_karyawan')->with(['success' => 'Anda berhasil login sebagai Karyawan.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }


    //register

    public function register(){
        return view('register');
    }

    public function createUser()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'level' => 'required', // validasi level
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
    
        $user = User::create($attributes);
        Auth::login($user);
    
        // Mengarahkan pengguna baru sesuai dengan level
        if ($user->level == "pemilik") {
            return redirect('dashboard_pemilik')->with(['success' => 'Welcome Pemilik.']);
        } else if ($user->level == "admin") {
            return redirect('dashboard_admin')->with(['success' => 'Welcome Admin.']);
        } else if ($user->level == "karyawan") {
            return redirect('dashboard_karyawan')->with(['success' => 'Welcome Karyawan.']);
        } else {
            return redirect('errors.404')->with(['success' => 'tidak punya akun']);
        }
    }
    
   

    //logout

    public function destroyAdmin()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }

    public function destroyPemilik()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }

    public function destroyKaryawan()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
