<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {   
        $login = '';
        return view('login.index', compact('login')
             
        );
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' =>'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user) {
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/loginform');
        }

        return back()->with('loginError', 'Login failed');
    }
 
    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
        request()->session()->regenerateToken();
     
        return redirect('/loginform');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}
