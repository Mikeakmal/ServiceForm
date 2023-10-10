<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Crypt;


class kendaraanController extends Controller
{
    public function index()
    {   
        $kendaraan = DB::table('tbl_kendaraan')->get();
        return view('/backend/kendaraan/kendaraan', [
            'tbl_kendaraan' => $kendaraan, 
        ]);
    }

    public function edit($id_kendaraan)
    {   
        $id = Crypt::decrypt($id_kendaraan);
        
        Kendaraan::where('id_kendaraan', $id)->first();
        return view('/backend/kendaraan/kendaraan', compact('Kendaraan'));
    }
    
    public function update()
    {
        $kendaraan = '';
        return view('/backend/kendaraan/kendaraan', compact('kendaraan')
        );
    }

    public function store(Request $request)
    {
        Kendaraan::insert([
            'no_polisi'=> $request->nopol,
            'tanggal_masuk_bengkel' => $request->tglmasuk,
            'tanggal_selesai' => $request-> tglselesai,
        ]);
        return redirect()->back();
    }

    public function delete($id_kendaraan)
    {
        // Kendaraan::destroy($id_kendaraan);
        // return redirect()->back();
        Kendaraan::where('id_kendaraan', $id_kendaraan)->delete();
        return redirect()->back();

    }
}
