<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {   
        // $data = [
        //     'user' => Auth::user(), 
        // ];

        // $register = '';
        // return view('register.index', compact('register')
        // );
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => ['required', 'min:3', 'max:225', 'unique:users'],
        //     'email' => 'required|email:dns|unique:users',
        //     'password' => 'required|min:5|max:255'
        // ]);
    
        // // Periksa apakah alamat email sudah ada dalam basis data
        // $existingUser = User::where('email', $request->email)->first();

        // // Jika alamat email belum ada, lanjutkan dengan penyimpanan
        // $validatedData['password'] = Hash::make($validatedData['password']);
        // User::create($validatedData);
    
        // return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');

        // dd('registrasi berhasil');
    }

}
