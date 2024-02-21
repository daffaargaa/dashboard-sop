<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function register() {
        return view('register');
    }

    public function registerPost (Request $request) {
        $user = new User();
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->inisial = $request->inisial;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dept = $request->dept;

        $user->save();
        Alert::success('Ganteng', '<3');
        return back()->with('success', 'Register Success');

        // $insert = User::create([
        //     'nik' => $request->nik,
        // ]);

        // DB::table('users')->insert([
        //     'nik' => $request->nik,
        //     ''
        // ]);

    }
    
    public function login() {
        return view('loginv2');
    }

    public function loginPost(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password'=> $request->password
        ];

        $user = DB::table('users')->where('email', '=', $request->email)->first();

        if(Auth::attempt($credentials)) {

            $logs = DB::table('logs')->where('nik', $user->nik)->first();
            
            if (!$logs) {
                DB::table('logs')->insert([
                    'nik' => $user->nik,
                    'nama' => $user->name,
                    'count' => 1,
                ]);
            } 
            else {
                DB::table('logs')->where('nik', $user->nik)->update([
                    'count' => $logs->count + 1,
                    'updated_at' => Carbon::now(),
                ]);
            }

            return redirect('/home')->with([
                'success' => 'Login berhasil',
            ]);
        }
        
        return back()->with('error', ' Email atau password salah');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
