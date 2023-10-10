<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class peralatanController extends Controller
{
    public function index()
    {   
        $peralatan = '';
        return view('backend.peralatan.form_peralatan', compact('peralatan')
             
        );
    }
}
