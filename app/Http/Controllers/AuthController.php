<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() 
    {
        return view('register');
    }

    public function registerPost (Request $request)
    {
        $user = new User();
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->inisial = $request->inisial;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dept = $request->dept;

        $user->save();
        return back()->with('success', 'Register Success');
    }
    
    public function login() 
    {
        return view('loginv2');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password'=> $request->password
        ];

        if(Auth::attempt($credentials)) {

            return redirect('/home')->with([
                'success' => 'Login berhasil',

            ]);
        }

        return back()->with('error', ' Email atau password salah');
    }

    public function logout() 
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
