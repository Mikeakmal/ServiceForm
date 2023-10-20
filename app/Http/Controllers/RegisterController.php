<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {   
        $register = '';
        return view('register.index', compact('register')
             
        );
    }


    // public function index()
    // {
    //     return view('register.index', [
    //         'title' => 'Register'
    //     ]);
    // }
    
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|max:225',
    //         'username' => ['required', 'min:3', 'max:225', 'unique:users'],
    //         'email' => 'required|email:dns|unique:users',
    //         'password' => 'required|min:5|max:255'
    //     ]);
    //     // $validatedData['password'] = bcrypt($validatedData['password']);
    //     $validatedData['password'] = Hash::make($validatedData['password']);

    //     user:: create($validatedData);
        
    //     return redirect('/login')->with('success', 'Registration successfull! please login');
    //     // dd('registrasi berhasil');
    // }

}
