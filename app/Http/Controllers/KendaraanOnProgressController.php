<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KendaraanOnProgressController extends Controller
{
    public function index()
    {
        $data = [
            'user' => Auth::user(), 
        ];

        // $kendaraan = DB::table('tbl_kendaraan')->get();
        $kendaraan = Kendaraan::whereNull('tanggal_selesai')->get();

        return view('/backend/kendaraan/kendaraanOnProgress',  [
            'kendaraan' => $kendaraan, 
        ]);

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $kendaraan = Kendaraan::
            where('no_polisi', 'like', "%$search%")
            ->get();

        if ($kendaraan->count() === 0) {
            $kendaraan = Kendaraan::all();
            return view('/backend/kendaraan/kendaraanOnProgress', compact('kendaraan'));

        } else {
            return view('/backend/kendaraan/kendaraanOnProgress', compact('kendaraan'));
        }
    }  
}
