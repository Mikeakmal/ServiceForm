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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:225', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
    
        // Periksa apakah alamat email sudah ada dalam basis data
        $existingUser = User::where('email', $request->email)->first();

        // Jika alamat email belum ada, lanjutkan dengan penyimpanan
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
    
        return redirect('/loginform')->with('success', 'Registrasi berhasil! Silakan login.');
    }

}
